@props([
    'id' => null,
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
    $id = $id ?? ($label ?? ($attributes->whereStartsWith('wire:model')->first() ?? ($attributes->get('name') ?? Str::random(8))));
    $error = $attributes->whereStartsWith('wire:model')->first() ?? ($attributes->get('name') ?? null);
    $badge ??= $attributes->has('required') ? __('Required') : null;
    $iconLeading = $icon ??= $iconLeading;

    $viewable = $attributes->has('viewable');
    $clearable = $attributes->has('clearable');
    $copyable = $attributes->has('copyable');

    $classes = ZincUi::classes()
        ->add('block w-full py-2 text-sm leading-6 border rounded-lg appearance-none')
        ->add(
            // Background ...
            match ($variant) {
                'outline' => 'bg-white dark:bg-white/10',
                'filled' => 'bg-zinc-800/5 dark:bg-white/10',
            },
        )
        ->add(
            // Text ...
            match ($variant) {
                'outline' => 'text-zinc-700 dark:text-zinc-300',
                'filled' => 'text-zinc-700 dark:text-zinc-300',
            },
        )
        ->add(
            // Shadow ...
            match ($variant) {
                'outline' => 'shadow-xs dark:shadow-none',
                'filled' => 'dark:shadow-none',
            },
        )
        ->add(
            // Border ...
            match ($variant) {
                'outline' => 'border-zinc-200 dark:border-white/10 border-b-zinc-300/80 disabled:border-b-zinc-200 dark:disabled:border-white/5',
                'filled' => 'border-0',
            },
        )
        ->add(
            // Height ...
            match ($size) {
                'base' => 'h-10',
                'sm' => 'h-8',
            },
        )
        ->add(
            // File ...
            $type == 'file'
                ? match ($variant) {
                    'outline'
                        => '!py-0 file:px-3 file:h-full file:-ml-3 file:mr-3 file:bg-zinc-100 file:dark:bg-zinc-100/5 file:text-zinc-700 file:dark:text-zinc-300 file:rounded-l-md file:border-none file:cursor-pointer file:disabled:cursor-default file:disabled:text-zinc-500 file:dark:disabled:text-zinc-400 file:outline file:outline-1 file:outline-zinc-200 file:dark:outline-white/10 file:disabled:dark:outline-white/5 ',
                    'filled'
                        => '!py-0 file:px-3 file:h-full file:-ml-3 file:mr-3 file:bg-zinc-500/5 file:dark:bg-white/5 file:text-zinc-700 file:dark:text-zinc-300 file:rounded-l-md file:border-none file:cursor-pointer file:disabled:cursor-default file:disabled:text-zinc-500 file:dark:disabled:text-zinc-400 ',
                }
                : null,
        )
        ->add(
            // Placeholder ...
            match ($variant) {
                'outline' => 'placeholder-zinc-400 dark:placeholder-zinc-400',
                'filled' => 'placeholder-zinc-500 dark:placeholder-white/60',
            },
        )
        ->add($type === 'file' ? 'pl-3' : (isset($icon) || isset($iconLeading) ? 'pl-10' : 'pl-3'))
        ->add($type === 'file' ? 'pr-3' : (isset($iconTrailing) || $viewable || $clearable || $copyable ? 'pr-10' : 'pr-3'))
        ->add(
            // Disabled ...
            match ($variant) {
                'outline' => 'disabled:shadow-none dark:disabled:bg-white/[7%] disabled:text-zinc-500 dark:disabled:text-zinc-400 disabled:placeholder-zinc-400/70 dark:disabled:placeholder-zinc-500',
                'filled' => 'disabled:shadow-none dark:disabled:bg-white/[7%] disabled:text-zinc-500 dark:disabled:text-zinc-400 disabled:placeholder-zinc-400/70 dark:disabled:placeholder-zinc-500',
            },
        );

    $iconLeadingClasses = ZincUi::classes()
        ->add('absolute left-0 top-1 flex items-center justify-center text-zinc-400 dark:text-zinc-400')
        ->add(
            match ($size) {
                'base' => 'h-8 w-8',
                'sm' => 'h-6 w-8',
            },
        );
    $iconTrailingClasses = ZincUi::classes()
        ->add('absolute right-0 top-1 flex items-center justify-center text-zinc-400 dark:text-zinc-400')
        ->add(
            match ($size) {
                'base' => 'h-8 w-8',
                'sm' => 'h-6 w-8',
            },
        );
@endphp

<x-with-field :$id :$error :$label :$description :$badge :$badgeColor>
    <?php if ($type == 'file'): ?>
    <div {{ $attributes->class('group relative block w-full') }} data-input>
        <input {{ $attributes->class($classes)->merge(['id' => $id, 'type' => 'file']) }} data-control data-group-target>
    </div>
    <?php else: ?>
    <?php if (!$clearable && !$viewable && !$copyable): ?>
    <div {{ $attributes->class('group relative block w-full') }} data-input>
        <?php if (is_string($iconLeading)): ?>
        <div class="{{ $iconLeadingClasses }}">
            <x-icon :name="$iconLeading" class="ml-2 size-5 shrink-0" />
        </div>
        <?php elseif($iconLeading): ?>
        <div class="{{ $iconLeadingClasses }}">
            {{ $iconLeading }}
        </div>
        <?php endif; ?>

        <input {{ $attributes->class($classes)->merge(['id' => $id, 'type' => $type]) }} data-control data-group-target>

        <?php if (is_string($iconTrailing)): ?>
        <div class="{{ $iconTrailingClasses }}">
            <x-icon :name="$iconTrailing" class="mr-2 size-5 shrink-0" />
        </div>
        <?php elseif($iconTrailing): ?>
        <div class="{{ $iconTrailingClasses }}">
            {{ $iconTrailing }}
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <?php if ($clearable): ?>
    <div {{ $attributes->class('group relative block w-full') }}
        x-data="{
            wireModel: '{{ $attributes->whereStartsWith('wire:model')->first() }}',
            clearInput() {
                if (this.wireModel) {
                    $wire.set(this.wireModel, '');
                }
                this.$refs.input.value = '';
                this.$refs.input.focus();
            }
        }" x-on:keydown.alt.x="clearInput()" data-input>
        <?php if (is_string($iconLeading)): ?>
        <div class="{{ $iconLeadingClasses }}">
            <x-icon :name="$iconLeading" class="ml-2 size-5 shrink-0" />
        </div>
        <?php elseif($iconLeading): ?>
        <div class="{{ $iconLeadingClasses }}">
            {{ $iconLeading }}
        </div>
        <?php endif; ?>

        <input x-ref="input" {{ $attributes->class($classes)->merge(['id' => $id, 'type' => $type]) }} data-control data-group-target>

        <div class="{{ $iconTrailingClasses }}">
            <x-button size="sm" variant="subtle" icon="o-x-mark" x-on:click="clearInput()" class="{{ $size == 'sm' ? 'mr-2 !h-6' : 'mr-2' }}" data-action />
        </div>
    </div>
    <?php endif; ?>

    <?php if ($viewable): ?>
    <div {{ $attributes->class('group relative block w-full') }}
        x-data="{
            isRevealed: false,
            viewInput() {
                this.isRevealed = !this.isRevealed;
                this.$refs.input.type = this.isRevealed ? 'text' : 'password';
                this.$refs.input.focus();
            }
        }" x-on:keydown.alt.v="viewInput()" data-input>
        <?php if (is_string($iconLeading)): ?>
        <div class="{{ $iconLeadingClasses }}">
            <x-icon :name="$iconLeading" class="ml-2 size-5 shrink-0" />
        </div>
        <?php elseif($iconLeading): ?>
        <div class="{{ $iconLeadingClasses }}">
            {{ $iconLeading }}
        </div>
        <?php endif; ?>

        <input x-ref="input" {{ $attributes->class($classes)->merge(['id' => $id, 'type' => 'password']) }} data-control data-group-target />

        <div class="{{ $iconTrailingClasses }}">
            <x-button size="sm" variant="subtle" icon="o-x-mark" class="{{ $size == 'sm' ? 'mr-2 !h-6' : 'mr-2' }}"
                x-on:click="viewInput()">
                <x-slot:icon>
                    <x-icon name="o-eye" x-show="!isRevealed" class="size-5 shrink-0" />
                    <x-icon name="o-eye-slash" x-show="isRevealed" x-cloak class="size-5 shrink-0" />
                </x-slot:icon>
            </x-button>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($copyable): ?>
    <div {{ $attributes->class('group relative block w-full') }}
        x-data="{
            isCopied: false,
            copyInput() {
                this.$refs.input.select();
                document.execCommand('copy');
                this.isCopied = true;
                setTimeout(() => this.isCopied = false, 1500);
            }
        }" x-on:keydown.alt.c="copyInput()" data-input>
        <?php if (is_string($iconLeading)): ?>
        <div class="{{ $iconLeadingClasses }}">
            <x-icon :name="$iconLeading" class="ml-2 size-5 shrink-0" />
        </div>
        <?php elseif($iconLeading): ?>
        <div class="{{ $iconLeadingClasses }}">
            {{ $iconLeading }}
        </div>
        <?php endif; ?>

        <input x-ref="input" {{ $attributes->class($classes)->merge(['id' => $id, 'type' => $type]) }} data-control data-group-target />

        <div class="{{ $iconTrailingClasses }}">
            <x-button size="sm" variant="{{ $variant == 'filled' ? 'outline' : 'filled' }}"
                class="{{ $size == 'sm' ? 'mr-2 !h-6' : 'mr-2' }}" x-on:click="copyInput()">
                <x-slot:iconLeading>
                    <x-icon name="o-clipboard" x-show="!isCopied" class="size-5 shrink-0" />
                    <x-icon name="o-clipboard-document" x-show="isCopied" x-cloak class="size-5 shrink-0" />
                </x-slot:iconLeading>
            </x-button>
        </div>
    </div>
    <?php endif; ?>
    <?php endif; ?>
</x-with-field>
