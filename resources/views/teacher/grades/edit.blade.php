<x-grade-layout title="Edit Student Grade">

    <div class="p-6 sm:p-8">

        <div class="mb-6">
            <h2 class="text-lg font-bold text-gray-800">
                Edit Student Grade
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Update the student's grade.
            </p>
        </div>

        <form action="{{ route('teacher.grades.update', $grade->id) }}"
              method="POST"
              class="space-y-6">

            @csrf
            @method('PUT')


            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Student ID
                </label>

                <input type="text"
                    value="{{ $grade->student->student_id }}"
                    class="w-full rounded-lg border border-gray-300 bg-gray-100 px-4 py-3 text-sm"
                    readonly>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-gray-700">
                    Student Name
                </label>

                <input type="text"
                    value="{{ $grade->student->user->name ?? 'N/A' }}"
                    class="w-full rounded-lg border border-gray-300 bg-gray-100 px-4 py-3 text-sm"
                    readonly>
            </div>

            <div>
                <label for="grade"
                    class="mb-2 block text-sm font-semibold text-gray-700">
                    Grade
                </label>

                <select name="grade" id="grade"
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm outline-none focus:border-[#7D3C98] focus:ring-2 focus:ring-purple-100"
                    required>

                    @foreach (['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'F'] as $option)
                        <option value="{{ $option }}"
                            {{ old('grade', $grade->grade) == $option ? 'selected' : '' }}>
                            {{ $option }}
                        </option>
                    @endforeach

                </select>

                @error('grade')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>


            <div class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 sm:flex-row sm:justify-end">

                <a href="{{ route('teacher.grades.index') }}"
                    class="rounded-lg border border-gray-300 px-5 py-2.5 text-center text-sm font-semibold text-gray-600 hover:bg-gray-50">
                    Cancel
                </a>

                <button type="submit"
                    class="rounded-lg bg-[#7D3C98] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#692f83]">
                    Update Grade
                </button>

            </div>

        </form>

    </div>

</x-grade-layout>
