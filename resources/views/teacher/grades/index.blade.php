<x-grade-layout title="Manage Grades">

    <div class="space-y-6">

        {{-- Page Heading --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h1 class="text-2xl font-bold text-[#7D3C98]">
                    Manage Student Grades
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    View and manage your students' grades.
                </p>
            </div>

            <a href="{{ route('teacher.grades.create') }}"
                class="rounded-lg bg-[#7D3C98] px-5 py-2.5 text-center text-sm font-semibold text-white hover:bg-[#692f83]">
                + Add Student Grade
            </a>

        </div>

        @if (session('success'))
            <div
                class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700">
                {{ session('success') }}
            </div>
        @endif
        <div class="overflow-hidden rounded-xl border border-purple-100 bg-white shadow-sm">

            <div class="border-b border-purple-100 px-5 py-4">
                <h2 class="text-lg font-bold text-gray-800">
                    Student Grade Records
                </h2>
            </div>

            @if ($grades->isEmpty())

                <div class="px-6 py-16 text-center">

                    <h3 class="text-lg font-semibold text-gray-800">
                        No Grades Available
                    </h3>

                    <p class="mt-2 text-sm text-gray-500">
                        You haven't added any student grades yet.
                    </p>

                </div>
            @else
                <div class="overflow-x-auto">

                    <table class="w-full text-left text-sm">

                        <thead class="bg-purple-50 text-xs uppercase tracking-wider text-[#7D3C98]">
                            <tr>
                                <th class="px-6 py-4">No.</th>
                                <th class="px-6 py-4">Student ID</th>
                                <th class="px-6 py-4">Course</th>
                                <th class="px-6 py-4">Student Name</th>
                                <th class="px-6 py-4">Grade</th>
                                <th class="px-6 py-4">Last Updated</th>
                                <th class="px-6 py-4 text-center">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @foreach ($grades as $grade)
                                <tr class="hover:bg-purple-50/40">

                                    <td class="px-6 py-4 text-gray-500">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-6 py-4 font-medium">
                                        {{ $grade->student->student_id }}
                                    </td>

                                    <td class="px-6 py-4 font-medium">
                                        {{ $grade->course->code }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $grade->student->user->name ?? 'N/A' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="rounded-md bg-purple-100 px-3 py-1 font-bold text-[#7D3C98]">
                                            {{ $grade->grade }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-gray-500">
                                        {{ $grade->updated_at->format('d M Y') }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex justify-center gap-3">

                                            <a href="{{ route('teacher.grades.edit', $grade->id) }}"
                                                class="font-semibold text-[#7D3C98] hover:underline">
                                                Edit
                                            </a>

                                            <form method="POST"
                                                action="{{ route('teacher.grades.destroy', $grade->id) }}"
                                                onsubmit="return confirm('Delete this grade?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="font-semibold text-red-600 hover:underline">
                                                    Delete
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        </div>

    </div>

</x-grade-layout>
