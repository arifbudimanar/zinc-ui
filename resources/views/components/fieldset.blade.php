<div {{ $attributes->merge([
    'class' =>
        '[&[disabled]_[data-label]]:opacity-50 [&[disabled]_[data-legend]]:opacity-50 [&>[data-field]]:mb-3 [&>[data-field]]:mb-3 [&>[data-field]:has(>[data-description])]:mb-4 [&>[data-field]:last-child]:!mb-0 [&>legend]:mb-4 [&>legend:has(+[data-description])]:mb-2 [&>legend+[data-description]]:mb-4',
]) }}
    data-fieldset>
    {{ $slot }}
</div>
