<?php

namespace App\Http\Requests;

use App\Models\CourseSyllabus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class UpdateCourseSyllabusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::guard('teacher')->check();
    }

    protected function prepareForValidation(): void
    {
        foreach (['teaching_methods', 'objectives', 'requirements', 'rules'] as $field) {
            if ($this->exists($field) && $this->input($field) === null) {
                $this->merge([$field => []]);
            }
            if (is_string($this->input($field))) {
                $this->merge([$field => array_values(array_filter(array_map('trim', preg_split('/\R/u', $this->input($field))), fn ($line) => $line !== ''))]);
            }
        }
    }

    public function rules(): array
    {
        $rules = [
            'code' => ['required', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'term' => ['required', 'string', 'max:100'],
            'credits' => ['required', 'integer', 'between:0,255'],
            'description' => ['required', 'string', 'max:10000'],
            'eligibility' => ['nullable', 'string', 'max:5000'],
            'resources' => ['nullable', 'string', 'max:5000'],
            'assessments' => ['sometimes', 'array'],
            'assessments.*' => ['required', 'array:label,weight'],
            'assessments.*.label' => ['required', 'string', 'max:255'],
            'assessments.*.weight' => ['required', 'numeric', 'between:0,100', 'decimal:0,2'],
            'grading' => ['sometimes', 'array'],
            'grading.*' => ['required', 'array:range,grade'],
            'grading.*.range' => ['required', 'string', 'max:100'],
            'grading.*.grade' => ['required', 'string', 'max:20'],
            'schedule' => ['sometimes', 'array'],
            'schedule.*' => ['required', 'array:week,dates,topic,tags,homework'],
            'schedule.*.week' => ['required', 'integer', 'min:1', 'distinct'],
            'schedule.*.dates' => ['nullable', 'string', 'max:100'],
            'schedule.*.topic' => ['required', 'string', 'max:500'],
            'schedule.*.tags' => ['nullable', 'string', 'max:255'],
            'schedule.*.homework' => ['nullable', 'string', 'max:2000'],
        ];

        foreach (['manager_name', 'manager_role', 'lecturer_name', 'lecturer_role', 'office_name', 'office_details'] as $field) {
            $rules[$field] = ['nullable', 'string', 'max:255'];
        }

        foreach (['teaching_methods', 'objectives', 'requirements', 'rules'] as $field) {
            $rules[$field] = ['present', 'array', 'max:50'];
            $rules[$field.'.*'] = ['required', 'string', 'max:2000'];
        }

        return $rules;
    }

    public function after(): array
    {
        return [function (Validator $validator) {
            if ($validator->errors()->isNotEmpty()) {
                return;
            }

            $assessments = $this->input('assessments', []);
            $total = array_sum(array_column($assessments, 'weight'));
            if ($assessments && abs($total - 100) > 0.00001) {
                $validator->errors()->add('assessments', 'Assessment weights must add up to 100%.');
            }

            $syllabus = CourseSyllabus::current();
            if ($syllabus) {
                $removedWeeks = $syllabus->materials()->pluck('week')->diff(array_column($this->input('schedule', []), 'week'))->unique();
                if ($removedWeeks->isNotEmpty()) {
                    $validator->errors()->add('schedule', 'Move or remove the lesson PDFs for week '.$removedWeeks->implode(', ').' before removing that week.');
                }
            }
        }];
    }
}
