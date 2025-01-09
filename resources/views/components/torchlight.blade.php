@props([
    'language' => 'blade',
    'lightTheme' => 'github-light',
    'darkTheme' => 'material-theme-ocean',
    'content' => null,
])

<div class="min-w-max">
    <x-torchlight-code :$language :theme="$lightTheme" :$content data-torchlight
        {{ $attributes->merge(['class' => 'block min-w-full dark:hidden !bg-transparent whitespace-pre text-base p-6']) }}>
        {{ $slot }}
    </x-torchlight-code>
    <x-torchlight-code :$language :theme="$darkTheme" :$content x-ref="copyCode" data-torchlight
        {{ $attributes->merge(['class' => 'hidden min-w-full dark:block !bg-transparent whitespace-pre text-base p-6']) }}>
        {{ $slot }}
    </x-torchlight-code>
</div>
