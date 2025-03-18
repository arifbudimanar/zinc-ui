@props([
    'variant' => 'default',
])

@php
    $classes = ZincUi::classes()
        ->add('min-w-0')
        ->add('[&:not(:has([data-field])):has([data-control][disabled])>[data-label]]:opacity-50')
        ->add('[&:has(>[data-radio-group][disabled])>[data-label]]:opacity-50')
        ->add('[&:has(>[data-checkbox-group][disabled])>[data-label]]:opacity-50')
        ->add(
            match ($variant) {
                'default' => [
                    'block',
                    '[&>[data-label]]:mb-3',
                    '[&>[data-label]:has(+[data-description])]:mb-2',
                    '[&>[data-label]+[data-description]]:mt-0',
                    '[&>[data-label]+[data-description]]:mb-3',
                    '[&>*:not([data-label])+[data-description]]:mt-3',
                ],
                'inline' => [
                    'grid gap-x-3 gap-y-1.5',
                    'has-[[data-label]~[data-control]]:grid-cols-[1fr_auto]',
                    'has-[[data-control]~[data-label]]:grid-cols-[auto_1fr]',
                    '[&>[data-control]~[data-description]]:row-start-2',
                    '[&>[data-control]~[data-description]]:col-start-2',
                    '[&>[data-control]~[data-error]]:col-span-2',
                    '[&>[data-control]~[data-error]]:mt-1',
                    '[&>[data-label]~[data-control]]:row-start-1',
                    '[&>[data-label]~[data-control]]:col-start-2',
                ],
            },
        );
@endphp

<div {{ $attributes->class($classes) }} data-field>
    {{ $slot }}
</div>
