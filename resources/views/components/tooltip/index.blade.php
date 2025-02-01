@props([
    'id' => null,
    'position' => 'top',
    'offset' => 6,
    'content' => null,
    'kbd' => null,
    'toggleable' => false,
])

@php
    $id = $id ?? 'tooltip-' . Str::random(8);
@endphp

<?php if ($toggleable): ?>
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

        <?php if ($content !== null): ?>
            <x-tooltip.content :$content :$kbd />
        <?php endif; ?>
    </div>
<?php else: ?>
    <div {{ $attributes->merge(['id' => $id]) }} x-data="{
        isTooltipOpen: false,
        touchTimeout: null,
        isTouchDevice: false,
        openTooltip() {
            if (!this.isTouchDevice) {
                this.isTooltipOpen = true;
            }
        },
        toggleTooltip() {
            if (!this.isTouchDevice) {
                this.isTooltipOpen = !this.isTooltipOpen;
            }
        },
        closeTooltip() {
            this.isTooltipOpen = false;
            if (this.touchTimeout) {
                clearTimeout(this.touchTimeout);
                this.touchTimeout = null;
            }
        },
        handleTouchStart(e) {
            this.isTouchDevice = true;
            this.touchTimeout = setTimeout(() => {
                this.isTooltipOpen = true;
            }, 500);
        },
        handleTouchEnd(e) {
            if (this.touchTimeout) {
                clearTimeout(this.touchTimeout);
                this.touchTimeout = null;
            }
        },
        init() {
            this.isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
        }
    }" x-ref="tooltip" x-init="init()"
        x-on:click="closeTooltip" x-on:click.outside="closeTooltip" x-on:focusin="openTooltip" x-on:focusout="closeTooltip"
        x-on:mouseenter="openTooltip" x-on:mouseleave="closeTooltip" x-on:keydown.esc="closeTooltip"
        x-on:touchstart="handleTouchStart" x-on:touchend="handleTouchEnd" x-on:touchcancel="closeTooltip"
        x-on:touchmove="closeTooltip" data-tooltip>

        {{ $slot }}

        <?php if ($content !== null): ?>
            <x-tooltip.content :$content :$kbd />
        <?php endif; ?>
    </div>
<?php endif; ?>
