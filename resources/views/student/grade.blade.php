<x-layout>

    <div class="mx-auto min-h-screen max-w-7xl px-4 py-10 sm:px-6 lg:px-8">


        <div class="mb-8">
            <h1 class="text-2xl font-bold text-[#7D3C98] md:text-3xl">
                My Grades
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                View your grades for each course.
            </p>
        </div>


        @forelse ($grades as $courseGrades)

            <div class="mb-8 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">


                <div class="border-b border-purple-100 bg-purple-50 px-6 py-4">
                    <h2 class="text-lg font-bold text-[#7D3C98]">
                        {{ $courseGrades->first()->course->code }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ $courseGrades->first()->course->title }}
                    </p>
                </div>


                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">

                        <thead class="bg-gray-50 text-xs uppercase tracking-wider text-gray-500">
                            <tr>
                                <th class="px-6 py-4">Term</th>
                                <th class="px-6 py-4">Credits</th>
                                <th class="px-6 py-4">Grade</th>
                                <th class="px-6 py-4">Last Updated</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @foreach ($courseGrades as $grade)
                                <tr class="hover:bg-purple-50/30">

                                     <td class="px-6 py-4">
                                        <span class="rounded-md bg-purple-100 px-3 py-1 font-bold text-[#7D3C98]">
                                            {{ $grade->course->term }}
                                        </span>
                                    </td>
                                     <td class="px-6 py-4">
                                        <span class="rounded-md bg-purple-100 px-3 py-1 font-bold text-[#7D3C98]">
                                            {{ $grade->course->credits }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="rounded-md bg-purple-100 px-3 py-1 font-bold text-[#7D3C98]">
                                            {{ $grade->grade }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-gray-500">
                                        {{ $grade->updated_at->format('d M Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>

        @empty

            <div class="rounded-xl border border-gray-200 bg-white px-6 py-16 text-center shadow-sm">
                <h2 class="text-lg font-semibold text-gray-700">
                    No Grades Available
                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    Your grades have not been added yet.
                </p>
            </div>

        @endforelse

    </div>

</x-layout>
