<div role="status" id="toaster" x-data="toasterHub(@js($toasts), @js($config))" @class([
    'fixed z-50 w-full flex flex-col pointer-events-none p-6 lg:px-8',
    'bottom-0' => $alignment->is('bottom'),
    'top-1/2 -translate-y-1/2' => $alignment->is('middle'),
    'top-0' => $alignment->is('top'),
    'items-start rtl:items-end' => $position->is('left'),
    'items-center' => $position->is('center'),
    'items-end rtl:items-start' => $position->is('right'),
])>
    <template x-for="toast in toasts" :key="toast.id">
        <div x-show="toast.isVisible" x-init="$nextTick(() => toast.show($el))" @if ($alignment->is('bottom'))
            x-transition:enter-start="translate-y-12 opacity-0"
            x-transition:enter-end="translate-y-0 opacity-100"
        @elseif($alignment->is('top'))
            x-transition:enter-start="-translate-y-12 opacity-0"
            x-transition:enter-end="translate-y-0 opacity-100"
        @else
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            @endif
            x-transition:leave-end="opacity-0 scale-90"
            @class([
                'relative duration-300 transform transition p-2 ease-in-out sm:max-w-sm w-full text-zinc-800 dark:text-white pointer-events-auto font-medium text-sm rounded-xl shadow-lg',
                'text-center' => $position->is('center'),
                'bg-white border border-zinc-200 border-b-zinc-300/80 dark:bg-zinc-700 dark:border-zinc-600',
                $alignment->is('bottom') ? 'mt-3' : 'mb-3',
            ])>
            <div class="flex items-start gap-4">
                <div class="flex-1 py-1.5 pl-2.5 flex gap-2">
                    <x-icon name="c-check-circle" x-show="toast.select({ success: true })"
                        class="shrink-0 mt-0.5 size-4 text-lime-600 dark:text-lime-400" />
                    <x-icon name="c-exclamation-circle" x-show="toast.select({ error: true })"
                        class="shrink-0 mt-0.5 size-4 text-rose-500 dark:text-rose-400" />
                    <x-icon name="c-exclamation-triangle" x-show="toast.select({ warning: true })"
                        class="shrink-0 mt-0.5 size-4 text-amber-500 dark:text-amber-400" />
                    <x-icon name="c-information-circle" x-show="toast.select({ info: true })"
                        class="shrink-0 mt-0.5 size-4 text-zinc-500 dark:text-zinc-300" />

                    <div>
                        <div class="text-sm font-medium text-zinc-800 dark:text-white" x-text="toast.message"></div>
                    </div>
                </div>

                @if ($closeable)
                    <button type="button" x-on:click="toast.dispose()"
                        class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 gap-2 text-sm font-medium truncate bg-transparent rounded-md disabled:opacity-50 dark:disabled:opacity-75 disabled:cursor-default hover:bg-zinc-800/5 dark:hover:bg-white/15 text-zinc-400 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-white">
                        <x-icon name="o-x-mark" class="size-5 shrink-0" />
                    </button>
                @endif
            </div>
        </div>
    </template>
</div>
