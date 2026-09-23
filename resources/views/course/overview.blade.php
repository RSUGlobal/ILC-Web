<div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
    @foreach ([['Course Manager', $syllabus->manager_name, $syllabus->manager_role], ['Lecturers', $syllabus->lecturer_name, $syllabus->lecturer_role], ['Office Location', $syllabus->office_name, $syllabus->office_details]] as [$label, $name, $detail])
        <div
            class="rounded-2xl border border-purple-200 bg-white p-5 shadow-sm"
        >
            <h2
                class="text-xs font-bold uppercase tracking-wider text-purple-900"
            >
                {{ $label }}
            </h2>
            <p class="mt-3 text-sm font-extrabold text-slate-900">{{ $name }}</p>
            <p class="mt-1 text-xs font-medium text-slate-600">{{ $detail }}</p>
        </div>
    @endforeach
</div>

<x-course-section
    id="description"
    title="Course Description"
    subtitle="Overview"
>
    <p class="whitespace-pre-line text-sm leading-relaxed text-slate-700 md:text-base">{{ $syllabus->description }}</p>
</x-course-section>

<div class="grid gap-8 md:grid-cols-2">
    <x-course-section
        id="eligibility"
        title="Course Eligibility"
        subtitle="Prerequisites & Enrollment Requirement"
    >
        <p class="whitespace-pre-line rounded-xl border border-amber-200 bg-amber-50 p-5 text-sm leading-relaxed text-amber-950">{{ $syllabus->eligibility }}</p>
    </x-course-section>
    <x-course-section
        title="Pedagogical Methods"
        subtitle="Teaching Methodology"
    >
        <ul
            class="list-disc space-y-3 pl-5 text-sm leading-relaxed text-slate-700 marker:text-[#7D3C98]"
        >
            @foreach ($syllabus->teaching_methods as $method)
                <li>{{ $method }}</li>
            @endforeach
        </ul>
    </x-course-section>
</div>

<x-course-section
    id="objectives"
    title="Course Objectives"
    subtitle="Key Learning Outcomes for Students"
>
    <ol class="space-y-3">
        @foreach ($syllabus->objectives as $objective)
            <li
                class="flex gap-4 rounded-xl border border-purple-100 bg-purple-50/40 px-4 py-3 text-sm leading-relaxed transition hover:border-purple-300 hover:bg-purple-50"
            >
                <span class="font-black text-[#5B2C6F]"
                    >{{ $loop->iteration }}.</span
                >
                <span class="text-slate-700">{{ $objective }}</span>
            </li>
        @endforeach
    </ol>
</x-course-section>
