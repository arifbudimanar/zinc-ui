<x-card variant="subtle" class="space-y-4">
    <div class="max-w-lg space-y-2">
        <x-heading :level="1">Toaster</x-heading>
        <x-subheading>
            A beautiful and customizable toast notification that can trigger from frontend and backend.
        </x-subheading>
    </div>
    <x-heading>
        Frontend
    </x-heading>
    <div class="flex flex-wrap gap-1">
        <x-button x-on:click="Toaster.success('Success!')" label="Success" />
        <x-button x-on:click="Toaster.error('Error!')" label="Error" />
        <x-button x-on:click="Toaster.warning('Warning!')" label="Warning" />
        <x-button x-on:click="Toaster.info('Info!')" label="Info" />
    </div>
    <x-heading>
        Backend
    </x-heading>
    <div class="flex flex-wrap gap-1">
        <x-button wire:click="toastSuccess" label="Success" />
        <x-button wire:click="toastError" label="Error" />
        <x-button wire:click="toastWarning" label="Warning" />
        <x-button wire:click="toastInfo" label="Info" />
    </div>
    <x-heading>
        Text Length
    </x-heading>
    <div class="flex flex-wrap gap-1">
        <x-button x-on:click="Toaster.info('Short text!')" label="Short Text" />
        <x-button
            x-on:click="Toaster.info('Lorem ipsum dolor, sit amet consectetur adipisicing elit. Est numquam vel excepturi cumque exercitationem possimus nulla dolores, corporis nobis voluptatibus?')"
            label="Long Text" />
    </div>
    <x-heading>
        Duration
    </x-heading>
    <div class="flex flex-wrap gap-1">
        <x-button wire:click="toast3Second" label="3 Second (Default)" />
        <x-button wire:click="toast5Second" label="5 Second" />
        <x-button wire:click="toast10Second" label="10 Second" />
    </div>
    <x-heading>
        Redirect Toaster
    </x-heading>
    <div class="flex flex-wrap gap-1">
        <x-button wire:click="toastRedirect" label="Redirect" />
        <form wire:submit="submitForm">
            <x-button type="submit" label="Submit" />
        </form>
        <form wire:submit="submitFormAndRedirect">
            <x-button type="submit" label="Submit and Redirect" />
        </form>
    </div>
</x-card>
