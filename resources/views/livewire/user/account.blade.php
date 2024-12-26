<div class="w-full space-y-6">
    <div class="max-w-lg">
        <x-heading>Account details</x-heading>

        <x-subheading>Update your profile information.</x-subheading>
    </div>

    <form wire:submit="updateProfile" class="max-w-lg space-y-4">
        <x-input wire:model="name" type="text" label="Name" description="Name description." placeholder="Your name" />

        <x-input wire:model="email" type="email" label="Email" description="Email description."
            placeholder="example@mail.com" />

        <x-button type="submit" variant="primary">Update</x-button>
    </form>

    <x-separator variant="subtle" />

    <div class="max-w-lg">
        <x-heading>Update Password</x-heading>

        <x-subheading>You can change your password if you'd like.</x-subheading>
    </div>

    <form wire:submit="updatePassword" class="max-w-lg space-y-4">
        <x-input wire:model="currentPassword" type="password" label="Current Password"
            placeholder="Your current password" viewable disabled />

        <x-input wire:model="newPassword" type="password" label="New Password" placeholder="Your new password" viewable
            disabled />

        <x-input wire:model="newPasswordConfirmation" type="password" label="New Password Confirmation"
            placeholder="Your new password confirmation" viewable disabled />

        <x-button type="submit" variant="primary" disabled>Update</x-button>
    </form>

    <x-separator variant="subtle" />

    <div class="max-w-lg">
        <x-heading>Delete Account</x-heading>

        <x-subheading>Permanently delete your account.</x-subheading>
    </div>

    <x-subheading class="max-w-lg">
        Once your account is deleted, all of its resources and data will be permanently deleted. Before
        deleting your account, please download any data or information that you wish to retain.
    </x-subheading>

    <x-button variant="danger" disabled>Delete</x-button>
</div>
