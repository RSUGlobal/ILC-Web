@php
    $failed = $errors->getBag($bag)->any();
    $title = $failed ? old('title') : ($material?->title ?? '');
    $selectedWeek = $failed ? old('week') : ($material?->week ?? 1);
@endphp
<div class="space-y-2">
    <label
        for="{{ $bag }}-title"
        class="block text-sm font-semibold text-slate-700"
        >Document title</label
    >
    <input
        id="{{ $bag }}-title"
        name="title"
        value="{{ $title }}"
        maxlength="255"
        required
        placeholder="e.g. Class 02 (Slides)"
        class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-[#7D3C98] focus:outline-none focus:ring-2 focus:ring-purple-200"
    />
    @error ('title', $bag)
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
<div class="space-y-2">
    <label
        for="{{ $bag }}-week"
        class="block text-sm font-semibold text-slate-700"
        >Lesson week</label
    >
    <select
        id="{{ $bag }}-week"
        name="week"
        required
        class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-[#7D3C98] focus:outline-none focus:ring-2 focus:ring-purple-200"
    >
        @foreach ($syllabus->schedule as $week)
            <option
                value="{{ $week['week'] }}"
                @selected ((string) $selectedWeek === (string) $week['week'])
            >
                Week {{ $week['week'] }} · {{ $week['topic'] }}
            </option>
        @endforeach
    </select>
    @error ('week', $bag)
        <p class="text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
<x-teacher-pdf-input
    :id="$bag.'-pdf'"
    :bag="$bag"
    :required="! $material"
    :label="$material ? 'Replace PDF (optional)' : 'Lesson PDF'"
/>
