<?php if ($errors->any()): ?>
    <div {{ $attributes->class('[:where(&)]:space-y-3') }} data-errors>
        <div class="text-sm font-medium text-red-500 dark:text-red-400">
            {{ __('Whoops! Something went wrong.') }}
        </div>

        <div class="[&>[data-error]]:mt-0">
            @foreach ($errors->all() as $error)
                <x-error :message="$error"/>
            @endforeach
        </div>
    </div>
<?php endif; ?>
