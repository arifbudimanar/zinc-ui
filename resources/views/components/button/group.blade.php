<div {{ $attributes->merge([
    'class' =>
        'flex group/button [&>[data-group-target]:not(:first-child):not(:last-child)]:rounded-none [&>[data-group-target]:first-child:not(:last-child)]:rounded-r-none [&>[data-group-target]:last-child:not(:first-child)]:rounded-l-none [&>*:not(:first-child):not(:last-child):not(:only-child)_[data-group-target]]:rounded-none [&>*:first-child:not(:last-child)_[data-group-target]]:rounded-r-none [&>*:last-child:not(:first-child)_[data-group-target]]:rounded-l-none',
]) }}
    data-button-group>
    {{ $slot }}
</div>
