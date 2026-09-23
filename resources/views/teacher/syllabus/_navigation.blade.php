<div class="mb-8 flex flex-wrap items-start justify-between gap-4">
    <div>
        <p class="text-xs font-bold uppercase tracking-widest text-[#7D3C98]">
            Teacher
            @if ($syllabus->exists) ·{{ $syllabus->code }} @endif
        </p>
        <h1 class="mt-2 text-2xl font-bold text-slate-900 sm:text-3xl">
            Course syllabus
        </h1>
    </div>
    @if ($syllabus->exists)
        <a
            href="{{ route('course.show') }}"
            target="_blank"
            rel="noopener noreferrer"
            class="rounded-lg border border-purple-200 bg-white px-4 py-2.5 text-sm font-semibold text-[#7D3C98] hover:bg-purple-50"
            >View public course page ↗</a
        >
    @endif
</div>
<nav
    aria-label="Syllabus management"
    class="mb-8 flex flex-wrap gap-3 border-b border-slate-200 pb-4 text-sm font-semibold"
>
    @foreach (['teacher.syllabus.edit' => 'Course information', 'teacher.syllabus.materials' => 'Syllabus & lesson PDFs'] as $route => $label)
        @if ($route !== 'teacher.syllabus.materials' || $syllabus->exists)
            <a
                href="{{ route($route) }}"
                @if (request()->routeIs($route)) aria-current="page" @endif
                @class (['rounded-lg px-4 py-2.5', 'bg-[#7D3C98] text-white' => request()->routeIs($route), 'bg-white text-[#7D3C98] hover:bg-purple-50' => ! request()->routeIs($route)])
                >{{ $label }}</a
            >
        @endif
    @endforeach
</nav>
@if (session('status'))
    <p class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800" role="status">{{ session('status') }}</p>
@endif
@if ($errors->any())
    <div
        class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800"
        role="alert"
    >
        <p class="font-semibold">Please check the following:</p>
        <ul class="mt-2 list-disc space-y-1 pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
