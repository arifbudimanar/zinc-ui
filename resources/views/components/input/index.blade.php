@props([
    'type' => 'text',
    'variant' => 'outline',
    'size' => 'base',
    'icon' => null,
    'iconLeading' => null,
    'iconTrailing' => null,
    'label' => null,
    'badge' => null,
    'badgeColor' => 'default',
    'description' => null,
])

@php
    $id = $attributes->whereStartsWith('wire:model')->first() ?? ($attributes->get('name') ?? Str::random(8));
    $badge = $badge ?? ($attributes->has('required') ? 'Required' : null);
    $iconLeading = $icon ??= $iconLeading;

    $required = $attributes->has('required') ? true : false;
    $disabled = $attributes->has('disabled') ? true : false;
    $readonly = $attributes->has('readonly') ? true : false;

    $viewable = $attributes->has('viewable') ? true : false;
    $clearable = $attributes->has('clearable') ? true : false;
    $copyable = $attributes->has('copyable') ? true : false;

    $backgroundClass = [
        'outline' => 'bg-white dark:bg-white/10',
        'filled' => 'bg-zinc-800/5 dark:bg-white/10',
    ][$variant];
    $textClass = [
        'outline' => 'text-zinc-700 dark:text-zinc-300',
        'filled' => 'text-zinc-700 dark:text-zinc-300',
    ][$variant];
    $placeholderClass = [
        'outline' => 'placeholder-zinc-400 dark:placeholder-zinc-400',
        'filled' => 'placeholder-zinc-500 dark:placeholder-white/60',
    ][$variant];
    $shadowClass = [
        'outline' => 'shadow-sm dark:shadow-none',
        'filled' => 'dark:shadow-none',
    ][$variant];
    $outlineClass = [
        'outline' =>
            'border-zinc-200 dark:border-white/10 border-b-zinc-300/80 disabled:border-b-zinc-200 dark:disabled:border-white/5',
        'filled' => 'border-0',
    ][$variant];
    $sizeClass = [
        'base' => 'h-10',
        'sm' => 'h-8',
    ][$size];
    $iconSizeClass = [
        'base' => 'h-8 w-8',
        'sm' => 'h-6 w-8',
    ][$size];
    $actionButtonHeightClass = [
        'base' => '!h-8',
        'sm' => '!h-6',
    ][$size];
    $paddingLeftClass = isset($icon) ? 'pl-10' : 'pl-3';
    $paddingRightClass = isset($iconTrailing) || $viewable || $clearable || $copyable ? 'pr-10' : 'pr-3';
    $disabledClass = [
        'outline' =>
            'disabled:shadow-none dark:disabled:bg-white/[7%] disabled:text-zinc-500 dark:disabled:text-zinc-400 disabled:placeholder-zinc-400/70 dark:disabled:placeholder-zinc-500',
        'filled' =>
            'disabled:shadow-none dark:disabled:bg-white/[7%] disabled:text-zinc-500 dark:disabled:text-zinc-400 disabled:placeholder-zinc-400/70 dark:disabled:placeholder-zinc-500',
    ][$variant];
    $class =
        'block w-full py-2 text-sm leading-6 border rounded-lg appearance-none' .
        ' ' .
        $backgroundClass .
        ' ' .
        $textClass .
        ' ' .
        $placeholderClass .
        ' ' .
        $shadowClass .
        ' ' .
        $outlineClass .
        ' ' .
        $sizeClass .
        ' ' .
        $paddingLeftClass .
        ' ' .
        $paddingRightClass .
        ' ' .
        $disabledClass;
@endphp

<x-field>
    @isset($label)
        <x-label>
            {{ $label }}
            @isset($badge)
                <x-badge label="{{ $badge }}" color="{{ $badgeColor }}" class="ml-1.5 -my-2.5" />
            @endisset
        </x-label>
    @endisset

    @isset($description)
        <x-description>
            {{ $description }}
        </x-description>
    @endisset

    {{-- Default input --}}
    @if (!$viewable && !$clearable && !$copyable)
        <div class="relative block w-full" data-input>
            @if (is_string($iconLeading))
                <div
                    class="{{ 'absolute left-1 top-1 flex items-center justify-center text-zinc-400 dark:text-zinc-400' . ' ' . $iconSizeClass }}">
                    <x-icon :name="$iconLeading" class="shrink-0 size-5" />
                </div>
            @else
                {{ $iconLeading }}
            @endif
            <input
                {{ $attributes->merge([
                    'id' => $id,
                    'type' => $type,
                    'class' => $class,
                    'required' => $required,
                    'disabled' => $disabled,
                    'readonly' => $readonly,
                ]) }}
                data-control data-group-target>
            @if (is_string($iconTrailing))
                <div
                    class="{{ 'absolute right-1 top-1 flex items-center justify-center text-zinc-400 dark:text-zinc-400' . ' ' . $iconSizeClass }}">
                    <x-icon :name="$iconTrailing" class="shrink-0 size-5" />
                </div>
            @else
                {{ $iconTrailing }}
            @endif
        </div>
    @endif

    {{-- Clearable input --}}
    @if ($clearable)
        <div class="relative block w-full" data-input x-data="{
            clearInput() {
                this.$refs.input.value = '';
                this.$refs.input.focus();
            }
        }" x-on:keydown.alt.x="clearInput()">

            @if (is_string($iconLeading))
                <div
                    class="{{ 'absolute left-1 top-1 flex items-center justify-center text-zinc-400 dark:text-zinc-400' . ' ' . $iconSizeClass }}">
                    <x-icon :name="$iconLeading" class="shrink-0 size-5" />
                </div>
            @else
                {{ $iconLeading }}
            @endif

            <input x-ref="input"
                {{ $attributes->merge([
                    'id' => $id,
                    'type' => $type,
                    'class' => $class,
                    'disabled' => $disabled,
                    'readonly' => $readonly,
                ]) }}
                data-control data-group-target>

            @if (!$disabled)
                <x-button variant="subtle" size="sm" icon="o-x-mark" x-on:click="clearInput()"
                    class="{{ '!absolute right-1 top-1' . ' ' . $actionButtonHeightClass }}" />
            @endif
        </div>
    @endif

    {{-- Viewable input --}}
    @if ($viewable)
        <div class="relative block w-full" data-input x-data="{
            isRevealed: false,
            viewInput() {
                this.isRevealed = !this.isRevealed;
                this.$refs.input.type = this.isRevealed ? 'text' : 'password';
                this.$refs.input.focus();
            }
        }" x-on:keydown.alt.v="viewInput()">
            @if (is_string($iconLeading))
                <div
                    class="{{ 'absolute left-1 top-1 flex items-center justify-center text-zinc-400 dark:text-zinc-400' . ' ' . $iconSizeClass }}">
                    <x-icon :name="$iconLeading" class="shrink-0 size-5" />
                </div>
            @else
                {{ $iconLeading }}
            @endif

            <input x-ref="input"
                {{ $attributes->merge([
                    'id' => $id,
                    'type' => 'password',
                    'class' => $class,
                    'disabled' => $disabled,
                    'readonly' => $readonly,
                ]) }}
                data-control data-group-target />

            @if (!$disabled)
                <x-button variant="subtle" size="sm" x-on:click="viewInput()"
                    class="{{ '!absolute right-1 top-1' . ' ' . $actionButtonHeightClass }}">
                    <x-slot:iconLeading>
                        <x-icon name="o-eye" x-show="!isRevealed" class="shrink-0 size-5" />
                        <x-icon name="o-eye-slash" x-show="isRevealed" x-cloak class="shrink-0 size-5" />
                    </x-slot:iconLeading>
                </x-button>
            @endif
        </div>
    @endif

    {{-- Copyable input --}}
    @if ($copyable)
        <div class="relative block w-full" data-input x-data="{
            isCopied: false,
            copyInput() {
                this.$refs.input.select();
                document.execCommand('copy');
                this.isCopied = true;
                setTimeout(() => this.isCopied = false, 1500);
            }
        }" x-on:keydown.alt.c="copyInput()">
            @if (is_string($iconLeading))
                <div
                    class="{{ 'absolute left-1 top-1 flex items-center justify-center text-zinc-400 dark:text-zinc-400' . ' ' . $iconSizeClass }}">
                    <x-icon :name="$iconLeading" class="shrink-0 size-5" />
                </div>
            @else
                {{ $iconLeading }}
            @endif

            <input x-ref="input"
                {{ $attributes->merge([
                    'id' => $id,
                    'type' => $type,
                    'class' => $class,
                    'disabled' => $disabled,
                    'readonly' => $readonly,
                ]) }}
                data-control data-group-target />

            @if (!$disabled)
                <x-button variant="subtle" size="sm" x-on:click="copyInput()"
                    class="{{ '!absolute right-1 top-1' . ' ' . $actionButtonHeightClass }}">
                    <x-slot:iconLeading>
                        <x-icon name="o-clipboard" x-show="!isCopied" class="shrink-0 size-5" />
                        <x-icon name="o-clipboard-document" x-show="isCopied" x-cloak class="shrink-0 size-5" />
                    </x-slot:iconLeading>
                </x-button>
            @endif
        </div>
    @endif

    <x-error name="{{ $id }}" />
</x-field>
