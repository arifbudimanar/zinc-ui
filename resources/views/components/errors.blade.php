<?php if ($errors->any()): ?>
    <div {{ $attributes }} data-errors>
        <div class="text-sm font-medium text-red-500 dark:text-red-400">
            {{ __('Whoops! Something went wrong.') }}
        </div>
        <ul class="mt-3 text-sm font-medium text-red-500 dark:text-red-400">
            <?php foreach ($errors->all() as $error): ?>
                <li>{{ $error }}</li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
