<x-card variant="subtle" class="space-y-6 w-80 max-w-80">
    <div>
        <x-brand class="mx-auto w-fit" />

        <div class="space-y-2">
            <x-heading :level="1" size="lg" label="{{ __('Create an account') }}" class="text-center" />

            <x-subheading label="{{ __('Welcome to the club.') }}" class="text-center" />
        </div>
    </div>

    @if (Route::has('oauth.redirect.github', 'oauth.callback.github') ||
            Route::has('oauth.redirect.google', 'oauth.callback.google'))
        <div class="space-y-3">
            @if (Route::has('oauth.redirect.github', 'oauth.callback.github'))
                <x-button href="/" variant="outline" icon="github" label="{{ __('Continue with Github') }}"
                    class="w-full" />
            @endif

            @if (Route::has('oauth.redirect.google', 'oauth.callback.google'))
                <x-button href="/" variant="outline" icon="mail" label="{{ __('Continue with Google') }}"
                    class="w-full" />
            @endif

            <x-subheading class="text-center !text-xs"
                label="{{ __('By continuing, I agree to the Terms of Service and Privacy Policy.') }}" />
        </div>

        <x-separator label="{{ __('or') }}" />
    @endif

    <form wire:submit="register" class="space-y-6">
        <x-input wire:model="name" label="{{ __('Name') }}" placeholder="{{ __('Your name') }}" required autofocus
            autocomplete="off" />

        <x-input wire:model="email" type="email" label="{{ __('Email') }}"
            placeholder="{{ __('email@example.com') }}" required autocomplete="off" />

        <x-input wire:model="password" type="password" label="{{ __('Password') }}"
            placeholder="{{ __('Your password') }}" required autocomplete="off" viewable />

        <x-input wire:model="password_confirmation" type="password" label="{{ __('Confirm Password') }}"
            placeholder="{{ __('Confirm your password') }}" required autocomplete="off" viewable />

        @if (Route::has('termsofservice', 'privacypolicy'))
            <x-checkbox wire:model="terms" label="{{ __('Accept Terms and Policy') }}" required>
                <x-slot:description>
                    {{ __('I agree to the') }}
                    <x-link href="{{ route('termsofservice') }}" target="_blank">{{ __('Terms of Service') }}</x-link>
                    {{ __('and the') }}
                    <x-link href="{{ route('privacypolicy') }}" target="_blank">{{ __('Privacy Policy') }}</x-link>
                    .
                </x-slot:description>
            </x-checkbox>
        @endif

        <x-button type="submit" variant="primary" label="Register" class="w-full" />
    </form>

    <div class="space-y-2">
        @if (Route::has('login'))
            <x-subheading class="text-center">
                Already have an account?
                <x-link label="Log in" href="{{ route('login') }}" wire:navigate />
            </x-subheading>
        @endif

        @if (Route::has('home'))
            <x-subheading class="text-center">
                {{ __('Go back to') }}
                <x-link label="{{ __('Homescreen') }}" href="{{ route('home') }}" wire:navigate />
            </x-subheading>
        @endif
    </div>
</x-card>
