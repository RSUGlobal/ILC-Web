<x-teacher-layout title="Edit course syllabus" :wide="true">
    @include ('teacher.syllabus._navigation')
    <p class="mb-6 text-sm text-slate-600">Changes appear on the public course page when you save. Fields marked * are required.</p>

    <form
        id="syllabus-form"
        method="POST"
        action="{{ route('teacher.syllabus.update') }}"
        class="space-y-6"
    >
        @csrf
        @method ('PUT')
        <x-course-section title="Course information">
            <div class="grid gap-5 sm:grid-cols-2">
                <x-teacher-field
                    name="code"
                    label="Course code"
                    :value="$syllabus->code"
                    maxlength="100"
                    required
                />
                <x-teacher-field
                    name="title"
                    label="Course title"
                    :value="$syllabus->title"
                    maxlength="255"
                    required
                />
                <x-teacher-field
                    name="term"
                    label="Term"
                    :value="$syllabus->term"
                    maxlength="100"
                    required
                />
                <x-teacher-field
                    name="credits"
                    label="Credits"
                    type="number"
                    :value="$syllabus->credits"
                    min="0"
                    max="255"
                    required
                />
                <div class="sm:col-span-2">
                    <x-teacher-field
                        name="subtitle"
                        label="Subtitle"
                        :value="$syllabus->subtitle"
                        maxlength="255"
                    />
                </div>
                <div class="sm:col-span-2">
                    <x-teacher-field
                        name="description"
                        label="Course description"
                        type="textarea"
                        :value="$syllabus->description"
                        rows="5"
                        maxlength="10000"
                        required
                    />
                </div>
            </div>
        </x-course-section>
        <x-course-section title="Teaching team & location">
            <div class="grid gap-5 sm:grid-cols-2">
                @foreach (['manager_name' => 'Course manager', 'manager_role' => 'Manager title / department', 'lecturer_name' => 'Lecturer(s)', 'lecturer_role' => 'Lecturer title / department', 'office_name' => 'Office', 'office_details' => 'Office details / contact'] as $field => $label)
                    <x-teacher-field
                        :name="$field"
                        :label="$label"
                        :value="$syllabus->$field"
                        maxlength="255"
                    />
                @endforeach
            </div>
        </x-course-section>
        <x-course-section title="Eligibility & learning">
            <div class="space-y-5">
                <x-teacher-field
                    name="eligibility"
                    label="Eligibility requirements"
                    type="textarea"
                    :value="$syllabus->eligibility"
                    rows="3"
                    maxlength="5000"
                />
                <x-teacher-field
                    name="teaching_methods"
                    label="Teaching methods"
                    type="textarea"
                    :value="$syllabus->teaching_methods"
                    help="One method per line."
                />
                <x-teacher-field
                    name="objectives"
                    label="Course objectives"
                    type="textarea"
                    :value="$syllabus->objectives"
                    help="One objective per line."
                    rows="5"
                />
            </div>
        </x-course-section>

        @foreach (['assessments' => 'Assessment weights', 'grading' => 'Grading criteria'] as $group => $title)
            <x-course-section :title="$title">
                <div data-repeater="{{ $group }}">
                    <div data-rows class="space-y-4">
                        @foreach (is_array(old($group)) ? array_filter(old($group), 'is_array') : $syllabus->$group as $index => $row)
                            @include ('teacher.syllabus._row')
                        @endforeach
                    </div>
                    <template data-template>
                        @include ('teacher.syllabus._row', ['index' => '__INDEX__', 'row' => []])
                    </template>
                    <button
                        type="button"
                        data-add-row
                        class="mt-4 rounded-lg border border-purple-200 px-4 py-2 text-sm font-semibold text-[#7D3C98] hover:bg-purple-50"
                    >
                        + Add {{ $group === 'assessments' ? 'assessment' : 'grade' }}
                    </button>
                    @if ($group === 'assessments')
                        <p class="mt-4 text-sm font-semibold text-[#5B2C6F]" data-assessment-total aria-live="polite">If you add assessments, weights must add up to 100%.</p>
                    @endif
                </div>
            </x-course-section>
        @endforeach

        <x-course-section title="Requirements, rules & resources">
            <div class="space-y-5">
                <x-teacher-field
                    name="requirements"
                    label="Course requirements"
                    type="textarea"
                    :value="$syllabus->requirements"
                    help="One requirement per line."
                />
                <x-teacher-field
                    name="rules"
                    label="Rules & regulations"
                    type="textarea"
                    :value="$syllabus->rules"
                    help="One rule per line."
                    rows="6"
                />
                <x-teacher-field
                    name="resources"
                    label="References & resources"
                    type="textarea"
                    :value="$syllabus->resources"
                    rows="3"
                    maxlength="5000"
                />
            </div>
        </x-course-section>
        <x-course-section
            title="Weekly schedule"
            subtitle="Edit dates, topics, activity labels and homework. Manage lesson PDFs on the PDFs tab."
        >
            <div data-repeater="schedule">
                <div data-rows class="space-y-4">
                    @foreach (is_array(old('schedule')) ? array_filter(old('schedule'), 'is_array') : $syllabus->schedule as $index => $row)
                        @include ('teacher.syllabus._row', ['group' => 'schedule'])
                    @endforeach
                </div>
                <template data-template>
                    @include ('teacher.syllabus._row', ['group' => 'schedule', 'index' => '__INDEX__', 'row' => []])
                </template>
                <button
                    type="button"
                    data-add-row
                    class="mt-4 rounded-lg border border-purple-200 px-4 py-2 text-sm font-semibold text-[#7D3C98] hover:bg-purple-50"
                >
                    + Add week
                </button>
            </div>
        </x-course-section>
        <div
            class="sticky bottom-0 flex flex-wrap items-center justify-between gap-3 rounded-xl border border-purple-200 bg-white p-4 shadow-lg"
        >
            <p class="text-sm text-slate-500" data-save-status>Changes are published when saved.</p>
            <button
                type="submit"
                class="rounded-lg bg-[#7D3C98] px-6 py-3 text-sm font-bold text-white hover:bg-[#701b94] focus:outline-none focus:ring-2 focus:ring-purple-300 focus:ring-offset-2"
            >
                Save course information
            </button>
        </div>
    </form>
    @push ('scripts')
        @vite ('resources/js/teacher-syllabus.js')
    @endpush
</x-teacher-layout>
