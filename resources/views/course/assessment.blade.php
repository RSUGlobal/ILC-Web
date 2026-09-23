<div id="assessment" class="grid scroll-mt-28 gap-8 md:grid-cols-2">
    <x-course-section
        title="Class Assessment"
        subtitle="Weight Distribution (100%)"
    >
        <div class="space-y-5">
            @foreach ($syllabus->assessments as $assessment)
                <div>
                    <div
                        class="flex justify-between gap-4 text-sm font-semibold"
                    >
                        <span>{{ $assessment['label'] }}</span>
                        <span class="text-[#7D3C98]"
                            >{{ $assessment['weight'] }}%</span
                        >
                    </div>
                    <div
                        class="mt-2 h-2.5 overflow-hidden rounded-full bg-slate-100"
                        aria-hidden="true"
                    >
                        <div
                            class="h-full rounded-full bg-[#7D3C98]"
                            style="width: {{ (float) $assessment['weight'] }}%"
                        ></div>
                    </div>
                </div>
            @endforeach
        </div>
        <div
            class="mt-6 flex justify-between rounded-xl border border-purple-200 bg-purple-50 p-4 text-sm font-bold text-[#5B2C6F]"
        >
            <span>Total Score Weight</span
            ><span
                >{{ array_sum(array_column($syllabus->assessments, 'weight')) }}%</span
            >
        </div>
    </x-course-section>
    <x-course-section title="Grading Criteria" subtitle="Letter Grade Scale">
        <div class="overflow-hidden rounded-xl border border-slate-200">
            <table class="w-full text-left text-sm">
                <thead
                    class="bg-slate-100 text-xs font-bold uppercase text-slate-700"
                >
                    <tr>
                        <th scope="col" class="px-4 py-3">Score Range</th>
                        <th scope="col" class="px-4 py-3 text-center">Grade</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($syllabus->grading as $grade)
                        <tr class="odd:bg-slate-50/60">
                            <td class="px-4 py-2.5">{{ $grade['range'] }}</td>
                            <td class="px-4 py-2.5 text-center font-bold">
                                {{ $grade['grade'] }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-course-section>
</div>

<div id="requirements" class="grid scroll-mt-28 gap-8 md:grid-cols-2">
    <x-course-section title="Course Requirements">
        <ul
            class="list-disc space-y-3 pl-5 text-sm leading-relaxed text-slate-700 marker:text-emerald-600"
        >
            @foreach ($syllabus->requirements as $requirement)
                <li>{{ $requirement }}</li>
            @endforeach
        </ul>
    </x-course-section>
    <x-course-section title="Rules & Regulations" class="border-rose-200">
        <ul
            class="list-disc space-y-3 pl-5 text-sm leading-relaxed text-slate-700 marker:text-rose-600"
        >
            @foreach ($syllabus->rules as $rule)
                <li>{{ $rule }}</li>
            @endforeach
        </ul>
    </x-course-section>
</div>
