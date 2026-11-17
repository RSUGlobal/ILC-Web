<x-grade-layout title="Add Student Grade">

    <div class="p-6 sm:p-8">

        {{-- Page Heading --}}
        <div class="mb-6">
            <h2 class="text-lg font-bold text-gray-800">
                Add New Student Grade
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Enter the student's ID and assign their grade.
            </p>
        </div>


        <form action="{{ route('teacher.grades.store') }}" method="POST" class="space-y-6">
            @csrf


            <div>
                <label for="student_id" class="mb-2 block text-sm font-semibold text-gray-700">
                    Student ID
                </label>

                <input type="text" name="student_id" id="student_id" value="{{ old('student_id') }}"
                    placeholder="Enter student ID"
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-[#7D3C98] focus:ring-2 focus:ring-purple-100"
                    required>

                @error('student_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="course_syllabus_id" class="mb-2 block text-sm font-semibold text-gray-700">
                    Course
                </label>

                <select name="course_syllabus_id" id="course_syllabus_id"
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm" required>

                    <option value="">Select Course</option>

                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}"
                            {{ old('course_syllabus_id') == $course->id ? 'selected' : '' }}>
                            {{ $course->code }} - {{ $course->title }}
                        </option>
                    @endforeach

                </select>

                @error('course_syllabus_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="grade" class="mb-2 block text-sm font-semibold text-gray-700">
                    Grade
                </label>

                <select name="grade" id="grade"
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-[#7D3C98] focus:ring-2 focus:ring-purple-100"
                    required>

                    <option value="">Select Grade</option>

                    @foreach (['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'F'] as $grade)
                        <option value="{{ $grade }}" {{ old('grade') == $grade ? 'selected' : '' }}>
                            {{ $grade }}
                        </option>
                    @endforeach
                </select>

                @error('grade')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 sm:flex-row sm:justify-end">

                <a href="{{ route('teacher.grades.index') }}"
                    class="rounded-lg border border-gray-300 px-5 py-2.5 text-center text-sm font-semibold text-gray-600 transition hover:bg-gray-50">
                    Cancel
                </a>

                <button type="submit"
                    class="rounded-lg bg-[#7D3C98] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#692f83]">
                    Save Grade
                </button>

            </div>

        </form>

    </div>

</x-grade-layout>
