@props (['title', 'id' => null, 'subtitle' => null])

<section
    @if ($id) id="{{ $id }}" @endif
    {{ $attributes->class(['min-w-0 scroll-mt-28 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm md:p-8']) }}
>
    <div class="mb-5 border-b border-slate-100 pb-4">
        <h2 class="text-lg font-extrabold text-[#5B2C6F]">{{ $title }}</h2>
        @if ($subtitle)
            <p class="mt-1 text-xs font-medium text-slate-500">{{ $subtitle }}</p>
        @endif
    </div>
    {{ $slot }}
</section>
