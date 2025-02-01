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
    $id = $id ?? 'dropdown-navlist-' . Str::random(8);
    $expandable = $attributes->has('expandable');
    $expanded = $attributes->has('expanded');
@endphp

<?php if ($expandable): ?>
    <div id="{{ $id }}" {{ $attributes->class('group') }} x-data="{
        isNavlistGroupOpen: {{ $expanded ? 'true' : 'false' }},
        toggleNavlistGroup() {
            this.isNavlistGroupOpen = !this.isNavlistGroupOpen;
        },
    }" data-navlist-group>
        <x-navlist.item :$variant :$active :$icon :$iconLeading :$iconTrailing :$badge :$badgeColor
            x-on:click="toggleNavlistGroup">
            <?php if ($icon == null): ?>
                <x-slot:icon>
                    <x-icon name="o-chevron-right" :attributes="$attributes->class('inline-flex size-5 shrink-0 items-center')->merge(['x-cloak' => $expanded])"
                        x-show="!isNavlistGroupOpen" />
                    <x-icon name="o-chevron-down" :attributes="$attributes->class('inline-flex size-5 shrink-0 items-center')->merge(['x-cloak' => !$expanded])"
                        x-show="isNavlistGroupOpen" />
                </x-slot:icon>
            <?php endif; ?>

            {{ $heading }}
        </x-navlist.item>

        <div {{ $attributes->class('min-h-auto relative flex flex-col pl-8')->merge(['x-cloak' => !$expanded]) }}
            x-show="isNavlistGroupOpen">
            <div class="absolute inset-y-[3px] left-0 ml-[1.3rem] w-px bg-zinc-200 lg:ml-[1.35rem] dark:bg-white/30"></div>

            {{ $slot }}
        </div>
    </div>
<?php else: ?>
    <div id="{{ $id }}" {{ $attributes->class('block space-y-[2px] mt-4') }} data-navlist-group>
        <?php if ($heading): ?>
            <x-navlist.heading>
                {{ $heading }}
            </x-navlist.heading>
        <?php endif; ?>
        <div class="min-h-auto flex flex-col">
            {{ $slot }}
        </div>
    </div>
<?php endif; ?>
