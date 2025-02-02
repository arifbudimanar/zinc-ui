@php
    $classes = ZincUi::classes()
        ->add('prose prose-base prose-zinc dark:prose-invert')
        ->add('prose-p:text-sm')
        ->add('prose-h1:text-2xl prose-h1:font-semibold')
        ->add('prose-h2:text-xl')
        ->add('prose-h3:text-lg');
@endphp

<div {{ $attributes->class($classes) }}
    data-markdown>
    {{ $slot }}
</div>
