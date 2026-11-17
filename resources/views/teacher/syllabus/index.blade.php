<x-teacher-layout title="Course syllabi" :wide="true">
    <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-[#7D3C98]">Teacher</p>
            <h1 class="mt-2 text-2xl font-bold text-slate-900 sm:text-3xl">Course syllabi</h1>
            <p class="mt-2 text-sm text-slate-600">Add and manage each course separately. Every course appears on the home page.</p>
        </div>
        <a href="{{ route('teacher.syllabus.create') }}" class="rounded-lg bg-[#7D3C98] px-5 py-3 text-sm font-bold text-white hover:bg-[#701b94]">+ Add course</a>
    </div>

    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($syllabi as $syllabus)
            <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-xs font-bold uppercase tracking-wider text-[#7D3C98]">{{ $syllabus->code }}</p>
                <h2 class="mt-2 text-xl font-bold text-slate-900">{{ $syllabus->title }}</h2>
                <p class="mt-1 text-sm text-slate-600">{{ $syllabus->term }}</p>
                <div class="mt-5 flex flex-wrap gap-4 text-sm font-semibold text-[#7D3C98]">
                    <a href="{{ route('teacher.syllabus.edit', $syllabus) }}" class="hover:underline">Edit</a>
                    <a href="{{ route('teacher.syllabus.materials', $syllabus) }}" class="hover:underline">PDFs</a>
                    <a href="{{ route('course.show', $syllabus) }}" target="_blank" rel="noopener noreferrer" class="hover:underline">View public page ↗</a>
                </div>
            </article>
        @empty
            <p class="rounded-xl border border-dashed border-purple-200 bg-purple-50 p-6 text-sm text-slate-600">No courses yet. Add your first course syllabus to publish it.</p>
        @endforelse
    </div>
</x-teacher-layout>
