<x-course-section
    id="schedule"
    title="Course Schedule & Weekly Topics"
    :subtitle="$syllabus->term.' · '.count($syllabus->schedule).' weeks'"
>
    <div class="space-y-4">
        @foreach ($syllabus->schedule as $week)
            <article
                class="space-y-3 rounded-xl border border-purple-200 bg-purple-50/40 p-5 transition hover:border-[#7D3C98] hover:bg-white hover:shadow-md"
            >
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <p class="rounded-md bg-[#5B2C6F] px-3 py-1.5 text-xs font-bold text-white">
                        Week {{ $week['week'] }}
                        @if ($week['dates']) ·{{ $week['dates'] }} @endif
                    </p>
                    @if ($week['tags'])
                        <div class="flex flex-wrap gap-2">
                            @foreach (array_filter(array_map('trim', explode(',', $week['tags']))) as $tag)
                                <span
                                    class="rounded-full bg-amber-100 px-3 py-1 text-xs font-bold text-amber-900"
                                    >{{ $tag }}</span
                                >
                            @endforeach
                        </div>
                    @endif
                </div>
                <h3 class="text-base font-extrabold text-slate-900">
                    {{ $week['topic'] }}
                </h3>
                @if ($week['homework'])
                    <p class="whitespace-pre-line rounded-lg bg-[#5B2C6F] p-3 text-xs font-bold leading-relaxed text-white">{{ $week['homework'] }}</p>
                @endif
                @if ($materials->has($week['week']))
                    <div class="flex flex-wrap gap-3 pt-1">
                        @foreach ($materials->get($week['week']) as $material)
                            <a
                                href="{{ route('course.materials.pdf', $material) }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center gap-2 rounded-xl border border-purple-200 bg-white px-4 py-2.5 text-xs font-bold text-[#5B2C6F] transition hover:bg-purple-100"
                            >
                                {{ $material->title }}
                                <span aria-hidden="true">↗</span
                                ><span class="sr-only"
                                    >(PDF, opens in a new tab)</span
                                >
                            </a>
                        @endforeach
                    </div>
                @endif
            </article>
        @endforeach
    </div>
</x-course-section>
