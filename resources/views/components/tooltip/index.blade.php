@props([
    'id' => null,
    'position' => 'bottom',
    'offset' => 6,
    'content' => null,
    'kbd' => null,
])

@php
    $id = $id ?? 'tooltip-' . Str::random(8);
@endphp

<div {{ $attributes->merge(['id' => $id]) }} x-data="{
    isTooltipOpen: false,
    tooltipTimeout: null,
    openTooltip() {
        this.tooltipTimeout = setTimeout(
            () => (this.isTooltipOpen = true),
            500
        );
    },
    toggleTooltip() {
        clearTimeout(this.tooltipTimeout);
        this.isTooltipOpen = !this.isTooltipOpen;
    },
    closeTooltip() {
        clearTimeout(this.tooltipTimeout);
        this.isTooltipOpen = false;
    },
}" x-ref="tooltip" x-on:click="closeTooltip"
    x-on:click.outside="closeTooltip" x-on:focusin="toggleTooltip" x-on:focusout="closeTooltip"
    x-on:mouseenter="openTooltip" x-on:mouseleave="closeTooltip" x-on:keydown.esc="closeTooltip" data-tooltip>

    {{ $slot }}

    @if ($content !== null)
        <x-tooltip.content :$content :$kbd />
    @endif
</div>
