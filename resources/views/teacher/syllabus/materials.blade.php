<x-teacher-layout title="Manage course PDFs" :wide="true">
    @include ('teacher.syllabus._navigation')
    <p class="mb-6 text-sm text-slate-600">Uploaded PDFs are available to everyone on the course page. Replacing a PDF keeps its link working.</p>
    <div class="grid grid-cols-1 items-start gap-6 lg:grid-cols-2">
        <x-course-section
            title="Syllabus PDF"
            subtitle="The main document linked at the top of the course page."
        >
            <div
                class="mb-6 rounded-xl border border-purple-100 bg-purple-50/50 p-4"
            >
                @if ($syllabus->pdf_path)
                    <p class="break-words text-sm font-semibold text-slate-800">{{ $syllabus->pdf_name }}</p>
                    <a
                        href="{{ route('course.pdf') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="mt-2 inline-block text-sm font-semibold text-[#7D3C98] hover:underline"
                        >View current PDF ↗</a
                    >
                @else
                    <p class="text-sm text-slate-600">No syllabus PDF uploaded yet.</p>
                @endif
            </div>
            <form
                method="POST"
                action="{{ route('teacher.syllabus.pdf') }}"
                enctype="multipart/form-data"
                class="space-y-5"
                data-pdf-upload
            >
                @csrf
                @method ('PUT')
                <x-teacher-pdf-input
                    id="syllabus-pdf"
                    bag="syllabusPdf"
                    :label="$syllabus->pdf_path ? 'Replace syllabus PDF' : 'Syllabus PDF'"
                    required
                />
                <button
                    type="submit"
                    class="rounded-lg bg-[#7D3C98] px-5 py-3 text-sm font-semibold text-white hover:bg-[#701b94]"
                >
                    Upload syllabus PDF
                </button>
            </form>
        </x-course-section>
        <x-course-section
            title="Add lesson PDF"
            subtitle="Upload slides, a textbook chapter or another PDF for a scheduled week."
        >
            @if (count($syllabus->schedule))
                <form
                    method="POST"
                    action="{{ route('teacher.materials.store') }}"
                    enctype="multipart/form-data"
                    class="space-y-5"
                    data-pdf-upload
                >
                    @csrf
                    @include ('teacher.syllabus._material-fields', ['bag' => 'newMaterial', 'material' => null])
                    <button
                        type="submit"
                        class="rounded-lg bg-[#7D3C98] px-5 py-3 text-sm font-semibold text-white hover:bg-[#701b94]"
                    >
                        Upload lesson PDF
                    </button>
                </form>
            @else
                <p class="text-sm text-slate-600">Add a week to the course schedule before uploading a lesson PDF.</p>
            @endif
        </x-course-section>
    </div>

    <div class="mt-10">
        <h2 class="mb-5 text-xl font-bold text-slate-900">
            Weekly lesson PDFs
            <span class="text-sm font-medium text-slate-500"
                >({{ $materials->count() }})</span
            >
        </h2>
        <div class="grid grid-cols-1 items-start gap-5 lg:grid-cols-2">
            @forelse ($materials as $material)
                <article
                    class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6"
                >
                    <p class="text-xs font-bold uppercase tracking-wider text-[#7D3C98]">Week {{ $material->week }}</p>
                    <h3
                        class="mt-2 break-words text-lg font-bold text-slate-900"
                    >
                        {{ $material->title }}
                    </h3>
                    <p class="mt-1 break-words text-xs text-slate-500">{{ $material->pdf_name }}</p>
                    <div
                        class="mt-4 flex flex-wrap gap-4 text-sm font-semibold text-[#7D3C98]"
                    >
                        <a
                            href="{{ route('course.materials.pdf', $material) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="hover:underline"
                            >View PDF ↗</a
                        >
                        <a
                            href="{{ route('course.materials.pdf', ['material' => $material, 'download' => 1]) }}"
                            class="hover:underline"
                            >Download</a
                        >
                    </div>
                    <details
                        class="mt-5 border-t border-slate-100 pt-4"
                        @if ($errors->getBag('material'.$material->id)->any()) open @endif
                    >
                        <summary
                            class="cursor-pointer text-sm font-semibold text-[#7D3C98]"
                        >
                            Edit title, week or PDF
                        </summary>
                        <form
                            method="POST"
                            action="{{ route('teacher.materials.update', $material) }}"
                            enctype="multipart/form-data"
                            class="mt-5 space-y-4"
                            data-pdf-upload
                        >
                            @csrf
                            @method ('PUT')
                            @include ('teacher.syllabus._material-fields', ['bag' => 'material'.$material->id])
                            <button
                                type="submit"
                                class="rounded-lg bg-[#7D3C98] px-4 py-2.5 text-sm font-semibold text-white hover:bg-[#701b94]"
                            >
                                Save changes
                            </button>
                        </form>
                    </details>
                    <form
                        method="POST"
                        action="{{ route('teacher.materials.destroy', $material) }}"
                        class="mt-4"
                        onsubmit="
                            return confirm(
                                'Remove this lesson PDF from the course page? This cannot be undone.',
                            );
                        "
                    >
                        @csrf
                        @method ('DELETE')
                        <button
                            type="submit"
                            class="text-xs font-semibold text-red-700 hover:underline"
                        >
                            Remove lesson PDF
                        </button>
                    </form>
                </article>
            @empty
                <p class="rounded-xl border border-dashed border-purple-200 bg-white p-8 text-sm text-slate-500 lg:col-span-2">No lesson PDFs yet. Use the upload form above to add the first one.</p>
            @endforelse
        </div>
    </div>
    @push ('scripts')
        @vite ('resources/js/teacher-syllabus.js')
    @endpush
</x-teacher-layout>
