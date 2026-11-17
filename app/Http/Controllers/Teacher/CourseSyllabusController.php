<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCourseSyllabusRequest;
use App\Models\CourseMaterial;
use App\Models\CourseSyllabus;
use App\Support\CoursePdf;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Throwable;

class CourseSyllabusController extends Controller
{
    public function index(): View
    {
        return view('teacher.syllabus.index', ['syllabi' => CourseSyllabus::query()->latest()->get()]);
    }

    public function create(): View
    {
        return view('teacher.syllabus.edit', ['syllabus' => CourseSyllabus::blank()]);
    }

    public function store(UpdateCourseSyllabusRequest $request): RedirectResponse
    {
        return $this->save($request, CourseSyllabus::blank(), 'Course syllabus added. It is now visible on the home page.');
    }

    public function edit(CourseSyllabus $syllabus): View
    {
        return view('teacher.syllabus.edit', compact('syllabus'));
    }

    public function update(UpdateCourseSyllabusRequest $request, CourseSyllabus $syllabus): RedirectResponse
    {
        return $this->save($request, $syllabus, 'Course information updated. Your changes are now visible on the course page.');
    }

    private function save(UpdateCourseSyllabusRequest $request, CourseSyllabus $syllabus, string $message): RedirectResponse
    {
        $data = $request->validated();
        $data['schedule'] = collect($data['schedule'] ?? [])->sortBy('week')->values()->all();
        $data['assessments'] = array_values($data['assessments'] ?? []);
        $data['grading'] = array_values($data['grading'] ?? []);
        $syllabus->fill($data)->save();

        return redirect()->route('teacher.syllabus.edit', $syllabus)->with('status', $message);
    }

    public function materials(CourseSyllabus $syllabus): View
    {
        return view('teacher.syllabus.materials', [
            'syllabus' => $syllabus,
            'materials' => $syllabus->materials()->get(),
        ]);
    }

    public function uploadSyllabus(Request $request, CourseSyllabus $syllabus): RedirectResponse
    {
        $request->validateWithBag('syllabusPdf', ['pdf' => ['required', ...CoursePdf::RULES]]);
        $this->replacePdf($syllabus, $request->file('pdf'));

        return redirect()->route('teacher.syllabus.materials', $syllabus)->with('status', 'Syllabus PDF updated.');
    }

    public function storeMaterial(Request $request, CourseSyllabus $syllabus): RedirectResponse
    {
        $data = $request->validateWithBag('newMaterial', $this->materialRules($syllabus, true));
        $path = CoursePdf::store($request->file('pdf'));

        try {
            $syllabus->materials()->create([
                'week' => $data['week'],
                'title' => $data['title'],
                'pdf_path' => $path,
                'pdf_name' => Str::limit($request->file('pdf')->getClientOriginalName(), 255, ''),
            ]);
        } catch (Throwable $exception) {
            Storage::disk('local')->delete($path);
            throw $exception;
        }

        return redirect()->route('teacher.syllabus.materials', $syllabus)->with('status', 'Lesson PDF uploaded.');
    }

    public function updateMaterial(Request $request, CourseSyllabus $syllabus, CourseMaterial $material): RedirectResponse
    {
        abort_unless($material->course_syllabus_id === $syllabus->id, 404);
        $data = $request->validateWithBag('material'.$material->id, $this->materialRules($syllabus, false));
        unset($data['pdf']);

        if ($request->hasFile('pdf')) {
            $this->replacePdf($material, $request->file('pdf'), $data);
        } else {
            $material->update($data);
        }

        return redirect()->route('teacher.syllabus.materials', $syllabus)->with('status', 'Lesson PDF updated.');
    }

    public function destroyMaterial(CourseSyllabus $syllabus, CourseMaterial $material): RedirectResponse
    {
        abort_unless($material->course_syllabus_id === $syllabus->id, 404);
        $path = DB::transaction(function () use ($material) {
            $locked = CourseMaterial::lockForUpdate()->findOrFail($material->id);
            $path = $locked->pdf_path;
            $locked->delete();

            return $path;
        });

        if ($path) {
            Storage::disk('local')->delete($path);
        }

        return redirect()->route('teacher.syllabus.materials', $syllabus)->with('status', 'Lesson PDF removed.');
    }

    private function materialRules(CourseSyllabus $syllabus, bool $new): array
    {
        return [
            'week' => ['required', 'integer', Rule::in(array_column($syllabus->schedule, 'week'))],
            'title' => ['required', 'string', 'max:255'],
            'pdf' => [$new ? 'required' : 'nullable', ...CoursePdf::RULES],
        ];
    }

    private function replacePdf(Model $record, UploadedFile $file, array $data = []): void
    {
        $path = CoursePdf::store($file);

        try {
            $oldPath = DB::transaction(function () use ($record, $file, $data, $path) {
                $locked = $record->newQuery()->lockForUpdate()->findOrFail($record->getKey());
                $oldPath = $locked->pdf_path;
                $locked->fill($data);
                $locked->pdf_path = $path;
                $locked->pdf_name = Str::limit($file->getClientOriginalName(), 255, '');
                $locked->save();

                return $oldPath;
            });
        } catch (Throwable $exception) {
            Storage::disk('local')->delete($path);
            throw $exception;
        }

        if ($oldPath) {
            Storage::disk('local')->delete($oldPath);
        }
    }
}
