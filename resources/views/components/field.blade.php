@props(['variant' => 'default'])

@php
    $classes = [
        'default' =>
            'min-w-0 block [&:not(:has([data-field])):has([data-control][disabled])>[data-label]]:opacity-50 [&:not(:has([data-field])):has([data-control][disabled])>[data-description]]:opacity-50 [&:has(>[data-radio-group][disabled])>[data-label]]:opacity-50 [&:has(>[data-checkbox-group][disabled])>[data-label]]:opacity-50 [&>[data-label]]:mb-3 [&>[data-label]:has(+[data-description])]:mb-2 [&>[data-label]+[data-description]]:mt-0 [&>[data-label]+[data-description]]:mb-3 [&>*:not([data-label])+[data-description]]:mt-3',
        'inline' => 'relative min-w-0 [&:not(:has([data-field])):has([data-control][disabled])>[data-label]]:opacity-50
            [&:has(>[data-radio-group][disabled])>[data-label]]:opacity-50
            [&:has(>[data-checkbox-group][disabled])>[data-label]]:opacity-50
            grid gap-x-3 gap-y-1.5 has-[[data-label]~[data-control]]:grid-cols-[1fr_auto] has-[[data-control]~[data-label]]:grid-cols-[auto_1fr] [&>[data-control]~[data-description]]:row-start-2 [&>[data-control]~[data-description]]:col-start-2 [&>[data-control]~[data-error]]:col-span-2 [&>[data-control]~[data-error]]:mt-1 [&>[data-label]~[data-control]]:row-start-1 [&>[data-label]~[data-control]]:col-start-2',
    ][$variant];
@endphp

<div {{ $attributes->merge([
    'class' => $classes,
]) }} data-field>
    {{ $slot }}
</div>
