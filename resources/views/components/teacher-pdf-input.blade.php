@props (['id', 'bag', 'required' => false, 'label' => 'PDF file'])
<div class="space-y-2">
    <label
        for="{{ $id }}"
        class="block text-sm font-semibold text-slate-700"
        >{{ $label }}</label
    >
    <input
        id="{{ $id }}"
        name="pdf"
        type="file"
        accept="application/pdf,.pdf"
        @required ($required)
        aria-describedby="{{ $id }}-help {{ $id }}-error"
        aria-invalid="{{ $errors->getBag($bag)->has('pdf') ? 'true' : 'false' }}"
        class="block w-full rounded-lg border border-gray-300 p-2 text-sm text-slate-600 file:mr-3 file:rounded-md file:border-0 file:bg-purple-50 file:px-3 file:py-2 file:font-semibold file:text-[#7D3C98] focus:outline-none focus:ring-2 focus:ring-purple-200"
    />
    <p
        id="{{ $id }}-help"
        class="text-xs text-slate-500"
    >PDF only, up to 10 MB. {{ $required ? '' : 'Leave empty to keep the current file.' }}</p>
    @error ('pdf', $bag)
        <p id="{{ $id }}-error" class="text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
