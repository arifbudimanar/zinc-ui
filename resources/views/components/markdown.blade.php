<div {{ $attributes->merge(['class' => 'prose prose-base prose-zinc dark:prose-invert prose-p:text-sm prose-h1:text-2xl prose-h1:font-semibold prose-h2:text-xl prose-h3:text-lg']) }}
    data-markdown>
    {{ $slot }}
</div>
