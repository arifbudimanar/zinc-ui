<div>
    @auth
        <x-heading size="xl" level="1">
            Good afternoon, {{ Auth::user()->first_name }}
        </x-heading>
    @else
        <x-heading size="xl" level="1">
            Hello world ...
        </x-heading>
    @endauth
    <x-subheading size="lg" class="mb-6">
        How are you today?
    </x-subheading>

    <x-separator variant="subtle" />
</div>
