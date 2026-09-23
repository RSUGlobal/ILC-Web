<x-layout>
    @if (! $syllabus)
        <div class="mx-auto max-w-4xl px-4 py-20 text-center sm:px-6">
            <h1 class="text-3xl font-bold text-[#5B2C6F]">
                Course syllabus unavailable
            </h1>
            <p class="mt-4 text-slate-600">No course information has been published yet.</p>
            <a
                href="{{ route('guest') }}"
                class="mt-8 inline-block rounded-xl bg-[#7D3C98] px-5 py-3 text-sm font-semibold text-white hover:bg-[#701b94]"
                >Return home</a
            >
        </div>
    @else
        <div
            class="border-b-4 border-[#7D3C98] bg-[#5B2C6F] py-10 text-white shadow-lg"
        >
            <div
                class="mx-auto flex max-w-7xl flex-col gap-6 px-4 sm:px-6 md:flex-row md:items-center md:justify-between lg:px-8"
            >
                <div class="min-w-0 space-y-3 break-words">
                    <nav
                        aria-label="Breadcrumb"
                        class="flex flex-wrap items-center gap-2 text-xs font-bold uppercase tracking-widest text-purple-200"
                    >
                        <a
                            href="{{ route('guest') }}"
                            class="hover:text-white hover:underline"
                            >Home</a
                        >
                        <span aria-hidden="true">/</span><span>Courses</span>
                        <span aria-hidden="true">/</span
                        ><span class="text-white">{{ $syllabus->code }}</span>
                    </nav>
                    <h1
                        class="text-3xl font-black tracking-tight sm:text-4xl lg:text-5xl"
                    >
                        {{ $syllabus->code }}: {{ $syllabus->title }}
                    </h1>
                    @if ($syllabus->subtitle)
                        <p class="max-w-3xl text-sm font-medium text-purple-100 sm:text-base">{{ $syllabus->subtitle }}</p>
                    @endif
                </div>
                <div class="flex shrink-0 flex-col gap-3">
                    <div class="flex flex-wrap gap-2 text-xs font-bold">
                        <span
                            class="rounded-xl border border-purple-300/40 bg-purple-950/40 px-4 py-3"
                            >{{ $syllabus->term }}</span
                        >
                        <span
                            class="rounded-xl border border-emerald-300/40 bg-emerald-900 px-4 py-3"
                            >{{ $syllabus->credits }} {{ Str::plural('Credit', $syllabus->credits) }}</span
                        >
                    </div>
                    @if ($syllabus->pdf_path)
                        <a
                            href="{{ route('course.pdf', ['download' => 1]) }}"
                            class="rounded-xl bg-amber-600 px-5 py-3 text-center text-sm font-bold text-white shadow-md transition hover:bg-amber-700"
                            >Download PDF</a
                        >
                    @endif
                </div>
            </div>
        </div>

        <div class="bg-slate-100/70">
            <div
                class="mx-auto grid max-w-7xl grid-cols-1 gap-10 px-4 py-12 sm:px-6 lg:grid-cols-12 lg:px-8"
            >
                <div class="space-y-8 lg:col-span-8">
                    @include ('course.overview')
                    @include ('course.assessment')
                    @include ('course.schedule')

                    <section
                        class="flex flex-col justify-between gap-4 rounded-2xl border border-slate-200 bg-white p-6 text-sm shadow-sm sm:flex-row"
                    >
                        <div>
                            <h2
                                class="text-xs font-bold uppercase tracking-wider text-slate-900"
                            >
                                References & Resources
                            </h2>
                            <p class="mt-2 whitespace-pre-line text-slate-600">{{ $syllabus->resources }}</p>
                        </div>
                        <div class="shrink-0 sm:text-right">
                            <p class="font-bold text-[#5B2C6F]">{{ $syllabus->manager_name }}</p>
                            <p class="mt-1 text-xs text-slate-600">{{ $syllabus->manager_role }}</p>
                        </div>
                    </section>
                </div>

                <aside class="lg:col-span-4">
                    <div class="space-y-8 lg:sticky lg:top-24">
                        <section
                            class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm"
                        >
                            <h2
                                class="mb-4 border-b border-slate-100 pb-3 text-xs font-black uppercase tracking-wider"
                            >
                                Quick Navigation
                            </h2>
                            <nav
                                aria-label="Course sections"
                                class="space-y-2 text-sm font-semibold"
                            >
                                @foreach (['description' => 'Course Description', 'eligibility' => 'Eligibility & Pedagogy', 'objectives' => 'Course Objectives', 'assessment' => 'Assessment & Grading', 'requirements' => 'Requirements & Rules', 'schedule' => count($syllabus->schedule).'-Week Schedule'] as $anchor => $label)
                                    <a
                                        href="#{{ $anchor }}"
                                        class="flex items-center justify-between rounded-xl border border-slate-100 px-4 py-3 text-slate-700 transition hover:border-purple-200 hover:bg-purple-50 hover:text-[#5B2C6F]"
                                    >
                                        {{ $label }}
                                        <span aria-hidden="true">→</span>
                                    </a>
                                @endforeach
                            </nav>
                        </section>
                        @if ($syllabus->pdf_path)
                            <section
                                class="overflow-hidden rounded-2xl border-2 border-[#5B2C6F] bg-white shadow-lg"
                            >
                                <div
                                    class="space-y-3 bg-[#5B2C6F] p-6 text-white"
                                >
                                    <p class="text-xs font-bold uppercase tracking-wider text-purple-100">Official Syllabus · {{ $syllabus->term }}</p>
                                    <h2 class="text-xl font-black">
                                        Course Syllabus PDF
                                    </h2>
                                    <p class="text-sm text-purple-100">{{ $syllabus->code }}: {{ $syllabus->title }}</p>
                                </div>
                                <div class="space-y-5 bg-purple-50/40 p-6">
                                    <a
                                        href="{{ route('course.pdf', ['download' => 1]) }}"
                                        class="block rounded-xl bg-amber-600 px-5 py-4 text-center text-sm font-bold text-white shadow-sm transition hover:bg-amber-700"
                                        >Download Syllabus (PDF)</a
                                    >
                                    <a
                                        href="{{ route('course.pdf') }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="block text-center text-sm font-semibold text-[#5B2C6F] underline-offset-4 hover:underline"
                                        >Open PDF in New Tab ↗</a
                                    >
                                </div>
                            </section>
                        @endif
                    </div>
                </aside>
            </div>
        </div>
    @endif
</x-layout>
