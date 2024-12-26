@props([
    'type' => 'button',
    'current' => null,
    'href' => null,
    'as' => null,
])

@if ($as === 'div')
    <div {{ $attributes }}>
        {{ $slot }}
    </div>
@elseif ($as === 'a' || $href)
    <a {{ $attributes->merge(['href' => $href]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => $type]) }}>
        {{ $slot }}
    </button>
@endif
