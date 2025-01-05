@props([
    'id' => null,
    'position' => 'bottom',
    'offset' => 6,
    'content' => null,
    'kbd' => null,
    'toggleable' => false,
])

@php
    $id = $id ?? 'tooltip-' . Str::random(8);
@endphp

@if ($toggleable)
    <div {{ $attributes->merge(['id' => $id]) }} x-data="{
        isTooltipOpen: false,
        openTooltip() {
            this.isTooltipOpen = true;
        },
        toggleTooltip() {
            this.isTooltipOpen = !this.isTooltipOpen;
        },
        closeTooltip() {
            this.isTooltipOpen = false;
        },
    }" x-ref="tooltip" x-on:click="toggleTooltip"
        x-on:click.outside="closeTooltip" data-tooltip>

        {{ $slot }}

        @if ($content !== null)
            <x-tooltip.content :$content :$kbd />
        @endif
    </div>
@else
    <div {{ $attributes->merge(['id' => $id]) }} x-data="{
        isTooltipOpen: false,
        openTooltip() {
            this.isTooltipOpen = true;
        },
        toggleTooltip() {
            this.isTooltipOpen = !this.isTooltipOpen;
        },
        closeTooltip() {
            this.isTooltipOpen = false;
        },
    }" x-ref="tooltip" x-on:click="closeTooltip"
        x-on:click.outside="closeTooltip" x-on:focusin="openTooltip" x-on:focusout="closeTooltip"
        x-on:mouseenter="openTooltip" x-on:mouseleave="closeTooltip" x-on:keydown.esc="closeTooltip" data-tooltip>

        {{ $slot }}

        @if ($content !== null)
            <x-tooltip.content :$content :$kbd />
        @endif
    </div>
@endif
