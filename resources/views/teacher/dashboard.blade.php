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
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold">Course syllabi</h2>
                <p class="mt-1 text-sm text-gray-600">{{ $syllabi->count() }} {{ Str::plural('course', $syllabi->count()) }} published.</p>
            </div>
            <a href="{{ route('teacher.syllabus.create') }}" class="rounded-lg bg-[#7D3C98] px-4 py-2 text-sm font-semibold text-white hover:bg-[#701b94]">+ Add course</a>
        </div>
        <a href="{{ route('teacher.syllabi.index') }}" class="mt-5 inline-block text-sm font-semibold text-[#7D3C98] hover:underline">Manage all courses →</a>
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
