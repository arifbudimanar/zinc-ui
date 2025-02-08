@props([
    'sortable' => false,
    'sorted' => null,
    'direction' => 'desc',
])

<th {{ $attributes->class('py-3 px-3 first:pl-0 last:pr-0 text-left text-sm font-medium text-zinc-800 dark:text-white last:[&_[data-table-sortable]]:mr-0') }} data-column>
    <div class="flex group-[]/right-align:justify-end">
        <?php if ($sortable): ?>
            <button type="button"
                class="group/sortable flex items-center gap-1 -my-1 -ml-2 -mr-2 px-2 py-1  group-[]/right-align:flex-row-reverse group-[]/right-align:-mr-2 group-[]/right-align:-ml-8"
                data-table-sortable>
                {{ $slot }}
                <div class="rounded text-zinc-400 group-hover/sortable:text-zinc-800 dark:group-hover/sortable:text-white">
                    <?php if ($sorted): ?>
                        <?php if ($direction == 'desc'): ?>
                            <x-icon name="m-chevron-down" class="shrink-0 size-5" />
                        <?php elseif ($direction = 'asc'): ?>
                            <x-icon name="m-chevron-up" class="shrink-0 size-5" />
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="opacity-0 group-hover/sortable:opacity-100">
                            <x-icon name="m-chevron-down" class="shrink-0 size-5" />
                        </div>
                    <?php endif; ?>
                </div>
            </button>
        <?php else: ?>
            {{ $slot }}
        <?php endif; ?>
    </div>
</th>
