<?php

namespace App\Http\Controllers;

use App\Models\CourseMaterial;
use App\Models\CourseSyllabus;
use App\Support\CoursePdf;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CourseSyllabusController extends Controller
{
    public function show(): View
    {
        $syllabus = CourseSyllabus::current();

        return view('course.show', [
            'syllabus' => $syllabus,
            'materials' => $syllabus?->materials()->get()->groupBy('week') ?? collect(),
        ]);
    }

    public function pdf(Request $request): BinaryFileResponse
    {
        $syllabus = CourseSyllabus::current();

        abort_unless($syllabus?->pdf_path, 404);

        return CoursePdf::respond($syllabus->pdf_path, $syllabus->code.' Course Syllabus', $request->boolean('download'));
    }

    public function material(Request $request, CourseMaterial $material): BinaryFileResponse
    {
        abort_unless($material->course_syllabus_id === CourseSyllabus::current()?->id && $material->pdf_path, 404);

        return CoursePdf::respond($material->pdf_path, $material->title, $request->boolean('download'));
    }
}
