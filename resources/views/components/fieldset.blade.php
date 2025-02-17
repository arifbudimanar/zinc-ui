@php
    $classes = ZincUi::classes()
        ->add('[&>[data-field]]:mb-3 [&>[data-field]:has(>[data-description])]:mb-4 [&>[data-field]:last-child]:!mb-0')
        ->add('[&>legend]:mb-4 [&>legend:has(+[data-description])]:mb-2 [&>legend+[data-description]]:mb-4')
        ->add('[&[disabled]_[data-label]]:opacity-50 [&[disabled]_[data-legend]]:opacity-50');
@endphp

<div {{ $attributes->class($classes) }}data-fieldset>
    {{ $slot }}
</div>
