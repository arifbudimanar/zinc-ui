@props([
    'id' => null,
    'heading' => null,
    'variant' => 'outline',
    'active' => false,
    'icon' => null,
    'iconLeading' => null,
    'iconTrailing' => null,
    'badge' => null,
    'badgeColor' => 'zinc',
])

@aware(['variant' => $variant])

@php
    $expandable = $attributes->has('expandable') ? true : false;

    $expanded = $attributes->has('expanded') ? true : false;

    $id = $id ?? 'dropdown-navlist-' . Str::random(8);
@endphp

@if ($expandable == false)
    <div {{ $attributes->merge(['id' => $id, 'class' => 'block space-y-1']) }} data-navlist-group>
        @if ($heading)
            <x-navlist.heading>
                {{ $heading }}
            </x-navlist.heading>
        @endif
        <div class="flex flex-col min-h-auto">
            {{ $slot }}
        </div>
    </div>
@else
    <div {{ $attributes->merge(['id' => $id, 'class' => 'group']) }} x-data="{
        isNavlistGroupOpen: {{ $active || $expanded ? 'true' : 'false' }},
        toggleNavlistGroup() {
            this.isNavlistGroupOpen = !this.isNavlistGroupOpen;
        },
    }" data-navlist-group>
        <x-navlist.item :$variant :$active :$icon :$iconLeading :$iconTrailing :$badge :$badgeColor
            x-on:click="toggleNavlistGroup">
            @if ($icon == null)
                <x-slot:icon>
                    <x-icon name="o-chevron-right" class="inline-flex items-center shrink-0 size-5"
                        x-show="!isNavlistGroupOpen"
                        {{ $attributes->merge(['x-cloak' => $active || $expanded == true]) }}></x-icon>
                    <x-icon name="o-chevron-down" class="inline-flex items-center shrink-0 size-5"
                        x-show="isNavlistGroupOpen"
                        {{ $attributes->merge(['x-cloak' => $active || $expanded == false]) }}></x-icon>
                </x-slot:icon>
            @endif

            {{ $heading }}
        </x-navlist.item>

        <div class="relative flex flex-col pl-8 min-h-auto" x-show="isNavlistGroupOpen"
            {{ $attributes->merge(['x-cloak' => $active || $expanded == false]) }}>
            <div class="absolute inset-y-[3px] w-px bg-zinc-200 dark:bg-white/30 left-0 ml-[1.3rem] lg:ml-[1.35rem]">
            </div>
            {{ $slot }}
        </div>
    </div>
@endif
