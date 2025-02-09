<div role="status" id="toaster"
    x-data="toasterHub(@js($toasts), @js($config))"
    @class([
        'fixed z-50 w-full flex flex-col pointer-events-none p-6 lg:px-8',
        'bottom-0' => $alignment->is('bottom'),
        'top-1/2 -translate-y-1/2' => $alignment->is('middle'),
        'top-0' => $alignment->is('top'),
        'items-start rtl:items-end' => $position->is('left'),
        'items-center' => $position->is('center'),
        'items-end rtl:items-start' => $position->is('right'),
    ])>
    <template x-for="toast in toasts" :key="toast.id">
        <div x-show="toast.isVisible" x-init="$nextTick(() => toast.show($el))"
            <?php if ($alignment->is('bottom')): ?>
                x-transition:enter="ease-out duration-200"
                x-transition:enter-start="translate-y-3 opacity-0"
                x-transition:enter-end="translate-y-0 opacity-100"
                x-transition:leave="ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="translate-y-3 opacity-0"
            <?php elseif ($alignment->is('top')): ?>
                x-transition:enter="ease-out duration-200"
                x-transition:enter-start="-translate-y-3 opacity-0"
                x-transition:enter-end="translate-y-0 opacity-100"
                x-transition:leave="ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="-translate-y-3 opacity-0"
            <?php else: ?>
                x-transition:enter="ease-out duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            <?php endif; ?>
            @class([
                'relative duration-300 transform transition p-2 ease-in-out w-full sm:max-w-sm text-zinc-800 dark:text-white pointer-events-auto font-medium text-sm rounded-xl shadow-lg',
                'text-center' => $position->is('center'),
                'bg-white border border-zinc-200 border-b-zinc-300/80 dark:bg-zinc-700 dark:border-zinc-600',
                $alignment->is('bottom') ? 'mt-3' : 'mb-3',
            ])
            x-data="{ touchStartX: 0, touchCurrentX: 0, swiping: false, touchStartY: 0, touchCurrentY: 0, isSwiped: false }"
            x-on:touchstart="
                swiping = true;
                touchStartX = $event.touches[0].clientX;
                touchStartY = $event.touches[0].clientY;
            "
            x-on:touchmove="
                if (swiping) { touchCurrentX = $event.touches[0].clientX; touchCurrentY = $event.touches[0].clientY;
                if (Math.abs(touchCurrentX - touchStartX) > Math.abs(touchCurrentY - touchStartY)) {
                    isSwiped = true;
                    $el.style.transition = 'transform 0.3s ease';
                    $el.style.transform = `translateX(${touchCurrentX - touchStartX}px)`;
                } else {
                    isSwiped = false;
                }}
            "
            x-on:touchend="
                swiping = false;
                if (isSwiped && Math.abs(touchCurrentX - touchStartX) > 50) {
                    toast.dispose();
                } else {
                    $el.style.transition = 'transform 0.3s ease';
                    $el.style.transform = '';
                }
            ">
            <div class="flex items-start gap-2.5">
                <div class="flex-1 py-1.5 pl-2.5 flex gap-2 {{ $closeable ? '' : 'pr-2.5' }}">
                    <x-icon name="c-check-circle" x-show="toast.select({ success: true })"
                        class="shrink-0 mt-0.5 size-4 text-lime-600 dark:text-lime-400" />
                    <x-icon name="c-exclamation-circle" x-show="toast.select({ error: true })"
                        class="shrink-0 mt-0.5 size-4 text-rose-500 dark:text-rose-400" />
                    <x-icon name="c-exclamation-triangle" x-show="toast.select({ warning: true })"
                        class="shrink-0 mt-0.5 size-4 text-amber-500 dark:text-amber-400" />
                    <x-icon name="c-information-circle" x-show="toast.select({ info: true })"
                        class="shrink-0 mt-0.5 size-4 text-zinc-500 dark:text-zinc-300" />

                    <x-heading x-text="toast.message" />
                </div>

                @if ($closeable)
                    <x-button variant="subtle" size="sm" icon="o-x-mark" x-on:click="toast.dispose()" />
                @endif
            </div>
        </div>
    </template>
</div>
