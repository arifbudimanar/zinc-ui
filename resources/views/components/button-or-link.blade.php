@props([
    'type' => 'button',
    'current' => null,
    'href' => null,
    'as' => null,
])

<?php if ($as == 'div'): ?>
    <div {{ $attributes }}>
        {{ $slot }}
    </div>
<?php elseif ($as == 'a' || $href): ?>
    <a {{ $attributes->merge(['href' => $href]) }}>
        {{ $slot }}
    </a>
<?php else: ?>
    <button {{ $attributes->merge(['type' => $type]) }}>
        {{ $slot }}
    </button>
<?php endif; ?>
