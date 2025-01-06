<div class="min-w-full px-6 py-16 overflow-auto">
    <div {{ $attributes->merge(['class' => 'min-w-max']) }}>
        {{ $slot }}
    </div>
</div>
