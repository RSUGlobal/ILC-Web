<x-teacher-layout title="Teacher account">
    <h1 class="mb-2 text-center text-2xl font-bold text-[#7D3C98]">
        Teacher account
    </h1>

    @if (session('status'))
        <p class="mt-6 rounded-md bg-green-50 p-4 text-sm text-green-800" role="status">{{ session('status') }}</p>
    @endif

    <p class="mt-6 text-center text-sm text-gray-600">You are logged in as</p>
    <p class="mt-1 break-words text-center font-medium">{{ $teacher->email }}</p>

    <div class="mt-8 rounded-xl border border-purple-200 bg-purple-50/50 p-5">
        @if ($syllabus)
            <p class="text-xs font-bold uppercase tracking-wider text-[#7D3C98]">{{ $syllabus->code }}</p>
            <h2 class="mt-2 text-lg font-bold">{{ $syllabus->title }}</h2>
            <p class="mt-1 text-sm text-gray-600">{{ $syllabus->term }}</p>
        @else
            <h2 class="text-lg font-bold">No course syllabus yet</h2>
            <p class="mt-1 text-sm text-gray-600">Add course information to get started.</p>
        @endif
        <div
            class="mt-5 flex flex-col gap-3 text-sm font-semibold text-[#7D3C98]"
        >
            <a
                href="{{ route('teacher.syllabus.edit') }}"
                class="hover:underline"
                >{{ $syllabus ? 'Edit' : 'Add' }} course information →</a
            >
            @if ($syllabus)
                <a
                    href="{{ route('teacher.syllabus.materials') }}"
                    class="hover:underline"
                    >Manage syllabus & lesson PDFs →</a
                >
                <a
                    href="{{ route('course.show') }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="hover:underline"
                    >View public course page ↗</a
                >
            @endif
        </div>
    </div>

    <form method="POST" action="{{ route('teacher.logout') }}" class="mt-8">
        @csrf
        <button
            type="submit"
            class="w-full rounded-md bg-[#7D3C98] py-3 font-medium text-white transition hover:bg-[#701b94] focus:outline-none focus:ring-2 focus:ring-[#b085c2] focus:ring-offset-2"
        >
            Log Out
        </button>
    </form>
</x-teacher-layout>
