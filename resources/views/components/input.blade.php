@props([
    'type' => 'text',
    'variant' => 'outline',
    'size' => 'base',
    'icon' => null,
    'iconLeading' => null,
    'iconTrailing' => null,
    'label' => null,
    'badge' => null,
    'badgeColor' => 'zinc',
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
    $paddingLeftClass = $type === 'file' ? 'pl-3' : (isset($icon) || isset($iconLeading) ? 'pl-10' : 'pl-3');
    $paddingRightClass =
        $type === 'file' ? 'pr-3' : (isset($iconTrailing) || $viewable || $clearable || $copyable ? 'pr-10' : 'pr-3');
    $disabledClass = [
        'outline' =>
            'disabled:shadow-none dark:disabled:bg-white/[7%] disabled:text-zinc-500 dark:disabled:text-zinc-400 disabled:placeholder-zinc-400/70 dark:disabled:placeholder-zinc-500',
        'filled' =>
            'disabled:shadow-none dark:disabled:bg-white/[7%] disabled:text-zinc-500 dark:disabled:text-zinc-400 disabled:placeholder-zinc-400/70 dark:disabled:placeholder-zinc-500',
    ][$variant];
    $fileClass = [
        'outline' => '
            !py-0 file:px-3 file:h-full file:-ml-3 file:mr-3
            file:bg-zinc-100 file:dark:bg-zinc-100/5
            file:text-zinc-700 file:dark:text-zinc-300 file:rounded-l-md
            file:border-none
            file:cursor-pointer file:disabled:cursor-default
            file:disabled:text-zinc-500 file:dark:disabled:text-zinc-400
            file:outline file:outline-1 file:outline-zinc-200 file:dark:outline-white/10 file:disabled:dark:outline-white/5
            ',
        'filled' => '
            !py-0 file:px-3 file:h-full file:-ml-3 file:mr-3
            file:bg-zinc-500/5 file:dark:bg-white/5
            file:text-zinc-700 file:dark:text-zinc-300 file:rounded-l-md
            file:border-none
            file:cursor-pointer file:disabled:cursor-default
            file:disabled:text-zinc-500 file:dark:disabled:text-zinc-400
            ',
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

<x-with-field :$id :$label :$description :$badge :$badgeColor>
    @if ($type == 'file')
        <div class="relative block w-full group/input" data-input>
            <input
                {{ $attributes->merge([
                    'id' => $id,
                    'type' => 'file',
                    'class' => $class . ' ' . $fileClass,
                    'required' => $required,
                    'disabled' => $disabled,
                    'readonly' => $readonly,
                ]) }}
                data-control data-group-target>

        </div>
    @else
        {{-- Default input --}}
        @if (!$clearable && !$viewable && !$copyable)
            <div class="relative block w-full group/input" data-input>
                @if (is_string($iconLeading))
                    <div
                        class="{{ 'absolute left-0 top-1 flex items-center justify-center text-zinc-400 dark:text-zinc-400' . ' ' . $iconSizeClass }}">
                        <x-icon :name="$iconLeading" class="ml-2 shrink-0 size-5" />
                    </div>
                @elseif($iconLeading)
                    <div
                        class="{{ 'absolute left-0 top-1 flex items-center justify-center text-zinc-400 dark:text-zinc-400' . ' ' . $iconSizeClass }}">
                        {{ $iconLeading }}
                    </div>
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
                        class="{{ 'absolute right-0 top-1 flex items-center justify-center text-zinc-400 dark:text-zinc-400' . ' ' . $iconSizeClass }}">
                        <x-icon :name="$iconTrailing" class="mr-2 shrink-0 size-5" />
                    </div>
                @elseif($iconTrailing)
                    <div
                        class="{{ 'absolute right-0 top-1 flex items-center justify-center text-zinc-400 dark:text-zinc-400' . ' ' . $iconSizeClass }}">
                        {{ $iconTrailing }}
                    </div>
                @endif
            </div>
        @endif

        {{-- Clearable input --}}
        @if ($clearable)
            <div class="relative block w-full group/input" data-input x-data="{
                wireModel: '{{ $attributes->whereStartsWith('wire:model')->first() }}',
                clearInput() {
                    if (this.wireModel) {
                        $wire.set(this.wireModel, '');
                    }
                    this.$refs.input.value = '';
                    this.$refs.input.focus();
                }
            }"
                x-on:keydown.alt.x="clearInput()">

                @if (is_string($iconLeading))
                    <div
                        class="{{ 'absolute left-0 top-1 flex items-center justify-center text-zinc-400 dark:text-zinc-400' . ' ' . $iconSizeClass }}">
                        <x-icon :name="$iconLeading" class="ml-2 shrink-0 size-5" />
                    </div>
                @elseif($iconLeading)
                    <div
                        class="{{ 'absolute left-0 top-1 flex items-center justify-center text-zinc-400 dark:text-zinc-400' . ' ' . $iconSizeClass }}">
                        {{ $iconLeading }}
                    </div>
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
                    <div
                        class="{{ 'absolute right-0 top-1 flex items-center justify-center text-zinc-400 dark:text-zinc-400' . ' ' . $iconSizeClass }}">
                        @if ($size == 'base')
                            <x-button size="sm" variant="subtle" icon="o-x-mark" class="mr-2"
                                x-on:click="clearInput()" />
                        @endif
                        @if ($size == 'sm')
                            <x-button size="sm" variant="subtle" icon="o-x-mark" class="!h-6 mr-2"
                                x-on:click="clearInput()" />
                        @endif
                    </div>
                @endif
            </div>
        @endif

        {{-- Viewable input --}}
        @if ($viewable)
            <div class="relative block w-full group/input" data-input x-data="{
                isRevealed: false,
                viewInput() {
                    this.isRevealed = !this.isRevealed;
                    this.$refs.input.type = this.isRevealed ? 'text' : 'password';
                    this.$refs.input.focus();
                }
            }"
                x-on:keydown.alt.v="viewInput()">
                @if (is_string($iconLeading))
                    <div
                        class="{{ 'absolute left-0 top-1 flex items-center justify-center text-zinc-400 dark:text-zinc-400' . ' ' . $iconSizeClass }}">
                        <x-icon :name="$iconLeading" class="ml-2 shrink-0 size-5" />
                    </div>
                @elseif($iconLeading)
                    <div
                        class="{{ 'absolute left-0 top-1 flex items-center justify-center text-zinc-400 dark:text-zinc-400' . ' ' . $iconSizeClass }}">
                        {{ $iconLeading }}
                    </div>
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
                    <div
                        class="{{ 'absolute right-0 top-1 flex items-center justify-center text-zinc-400 dark:text-zinc-400' . ' ' . $iconSizeClass }}">
                        @if ($size == 'base')
                            <x-button size="sm" variant="subtle" icon="o-x-mark" class="mr-2"
                                x-on:click="viewInput()">
                                <x-slot:icon>
                                    <x-icon name="o-eye" x-show="!isRevealed" class="shrink-0 size-5" />
                                    <x-icon name="o-eye-slash" x-show="isRevealed" x-cloak class="shrink-0 size-5" />
                                </x-slot:icon>
                            </x-button>
                        @endif
                        @if ($size == 'sm')
                            <x-button size="sm" variant="subtle" icon="o-x-mark" class="!h-6 mr-2"
                                x-on:click="viewInput()">
                                <x-slot:icon>
                                    <x-icon name="o-eye" x-show="!isRevealed" class="shrink-0 size-5" />
                                    <x-icon name="o-eye-slash" x-show="isRevealed" x-cloak class="shrink-0 size-5" />
                                </x-slot:icon>
                            </x-button>
                        @endif
                    </div>
                @endif
            </div>
        @endif

        {{-- Copyable input --}}
        @if ($copyable)
            <div class="relative block w-full group/input" data-input x-data="{
                isCopied: false,
                copyInput() {
                    this.$refs.input.select();
                    document.execCommand('copy');
                    this.isCopied = true;
                    setTimeout(() => this.isCopied = false, 1500);
                }
            }"
                x-on:keydown.alt.c="copyInput()">
                @if (is_string($iconLeading))
                    <div
                        class="{{ 'absolute left-0 top-1 flex items-center justify-center text-zinc-400 dark:text-zinc-400' . ' ' . $iconSizeClass }}">
                        <x-icon :name="$iconLeading" class="ml-2 shrink-0 size-5" />
                    </div>
                @elseif($iconLeading)
                    <div
                        class="{{ 'absolute left-0 top-1 flex items-center justify-center text-zinc-400 dark:text-zinc-400' . ' ' . $iconSizeClass }}">
                        {{ $iconLeading }}
                    </div>
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
                    <div
                        class="{{ 'absolute right-0 top-1 flex items-center justify-center text-zinc-400 dark:text-zinc-400' . ' ' . $iconSizeClass }}">
                        @if ($size == 'base')
                            <x-button size="sm" variant="{{ $variant == 'filled' ? 'outline' : 'filled' }}"
                                class="mr-2" x-on:click="copyInput()">
                                <x-slot:iconLeading>
                                    <x-icon name="o-clipboard" x-show="!isCopied" class="shrink-0 size-5" />
                                    <x-icon name="o-clipboard-document" x-show="isCopied" x-cloak
                                        class="shrink-0 size-5" />
                                </x-slot:iconLeading>
                            </x-button>
                        @endif
                        @if ($size == 'sm')
                            <x-button size="sm" variant="{{ $variant == 'filled' ? 'outline' : 'filled' }}"
                                class="!h-6 mr-2" x-on:click="copyInput()">
                                <x-slot:iconLeading>
                                    <x-icon name="o-clipboard" x-show="!isCopied" class="shrink-0 size-5" />
                                    <x-icon name="o-clipboard-document" x-show="isCopied" x-cloak
                                        class="shrink-0 size-5" />
                                </x-slot:iconLeading>
                            </x-button>
                        @endif
                    </div>
                @endif
            </div>
        @endif
    @endif
</x-with-field>
