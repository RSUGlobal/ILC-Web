@props (['name', 'label', 'value' => '', 'type' => 'text', 'help' => null, 'required' => false, 'rows' => 4])
@php
    $inputName = preg_replace('/\.([^.]+)/', '[$1]', $name);
    $inputId = str_replace('.', '-', $name);
    $inputValue = old($name, $value);
    if (is_array($inputValue)) $inputValue = implode("\n", array_filter($inputValue, 'is_scalar'));
    $describedBy = implode(' ', array_filter([$help ? $inputId.'-help' : null, $errors->has($name) ? $inputId.'-error' : null]));
@endphp
<div class="space-y-2">
    <label
        for="{{ $inputId }}"
        class="block text-sm font-semibold text-slate-700"
        >{{ $label }}
        @if ($required)
            <span class="text-[#7D3C98]" aria-hidden="true">*</span>
        @endif
    </label>
    @if ($type === 'textarea')
        <textarea
            id="{{ $inputId }}"
            name="{{ $inputName }}"
            rows="{{ $rows }}"
            @required ($required)
            aria-invalid="{{ $errors->has($name) ? 'true' : 'false' }}"
            @if ($describedBy) aria-describedby="{{ $describedBy }}" @endif
            {{ $attributes->class(['w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-[#7D3C98] focus:outline-none focus:ring-2 focus:ring-purple-200']) }}
            >{{ $inputValue }}</textarea
        >
    @else
        <input
            id="{{ $inputId }}"
            name="{{ $inputName }}"
            type="{{ $type }}"
            value="{{ $inputValue }}"
            @required ($required)
            aria-invalid="{{ $errors->has($name) ? 'true' : 'false' }}"
            @if ($describedBy) aria-describedby="{{ $describedBy }}" @endif
            {{ $attributes->class(['w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-[#7D3C98] focus:outline-none focus:ring-2 focus:ring-purple-200']) }}
        />
    @endif
    @if ($help)
        <p
            id="{{ $inputId }}-help"
            class="text-xs text-slate-500"
        >{{ $help }}</p>
    @endif
    @error ($name)
        <p
            id="{{ $inputId }}-error"
            class="text-sm text-red-600"
        >{{ $message }}</p>
    @enderror
</div>
