<div class="space-y-16">
    <div>
        <x-heading size="xl" level="1" class="!mb-4">Button</x-heading>

        <x-subheading size="lg" class="mb-6">
            A powerful and composable button component for your application.
        </x-subheading>

        <div
            class="overflow-hidden bg-white border divide-y rounded-md border-zinc-200 dark:border-white/10 dark:bg-zinc-900 divide-zinc-200 dark:divide-white/10">
            <div class="min-w-full px-6 overflow-auto py-14">
                <div class="min-w-fit">
                    <div class="flex justify-center gap-4">
                        <x-button>Button</x-button>
                    </div>
                </div>
            </div>
            <div class="max-h-full min-w-full text-sm bg-zinc-50 dark:bg-zinc-800">
                <div class="max-h-full min-w-full overflow-auto">
                    <div class="p-6">
                        <pre><code class="language-html">&lt;x-button&gt;Button&lt;/x-button&gt;</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <x-heading size="lg" level="1" class="!mb-4">Variant</x-heading>

        <x-subheading size="lg" class="mb-6">
            Use the variant prop to change the visual style of the button.
        </x-subheading>

        <div
            class="overflow-hidden bg-white border divide-y rounded-md border-zinc-200 dark:border-white/10 dark:bg-zinc-900 divide-zinc-200 dark:divide-white/10">
            <div class="min-w-full px-6 overflow-auto py-14">
                <div class="min-w-fit">
                    <div class="flex justify-center gap-4">
                        <x-button variant="outline">Default</x-button>
                        <x-button variant="primary">Primary</x-button>
                        <x-button variant="filled">Filled</x-button>
                        <x-button variant="danger">Danger</x-button>
                        <x-button variant="ghost">Ghost</x-button>
                        <x-button variant="subtle">Subtle</x-button>
                    </div>
                </div>
            </div>
            <div class="max-h-full min-w-full text-sm bg-zinc-50 dark:bg-zinc-800">
                <div class="max-h-full min-w-full overflow-auto">
                    <div class="p-6 min-w-fit">
                        <pre><code class="language-html">&lt;x-button variant="outline"&gt;Default&lt;/x-button&gt; <br/>&lt;x-button variant="primary"&gt;Primary&lt;/x-button&gt; <br/>&lt;x-button variant="filled"&gt;Filled&lt;/x-button&gt; <br/>&lt;x-button variant="danger"&gt;Danger&lt;/x-button&gt; <br/>&lt;x-button variant="ghost"&gt;Ghost&lt;/x-button&gt; <br/>&lt;x-button variant="subtle"&gt;Subtle&lt;/x-button&gt;</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-separator variant="subtle" />

    <div class="flex flex-col flex-wrap gap-1 mt-6">
        <div class="flex gap-1">
            <x-button wire:navigate :href="route('header')">Header</x-button>
            <x-button wire:navigate :href="route('header-sidebar')">Header with Sidebar</x-button>
        </div>
        <div class="flex gap-1">
            <x-button wire:navigate :href="route('sidebar')">Sidebar</x-button>
            <x-button wire:navigate :href="route('sidebar-header')">Sidebar with Header</x-button>
        </div>
        <div class="flex gap-1">
            <x-button wire:navigate :href="route('documentation')">Doc</x-button>
        </div>
    </div>
</div>
