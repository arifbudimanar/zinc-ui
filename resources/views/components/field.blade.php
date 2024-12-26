<div {{ $attributes->merge([
    'class' =>
        'min-w-0 block [&:not(:has([data-field])):has([data-control][disabled])>[data-label]]:opacity-50 [&:has(>[data-radio-group][disabled])>[data-label]]:opacity-50 [&:has(>[data-checkbox-group][disabled])>[data-label]]:opacity-50 [&>[data-label]]:mb-3 [&>[data-label]:has(+[data-description])]:mb-2 [&>[data-label]+[data-description]]:mt-0 [&>[data-label]+[data-description]]:mb-3 [&>*:not([data-label])+[data-description]]:mt-3',
]) }}
    data-field>
    {{ $slot }}
</div>
