<x-card variant="subtle" class="space-y-6 w-80 max-w-80">
    <div>
        <x-brand class="mx-auto w-fit" />

        <div class="space-y-2">
            <x-heading :level="1" size="lg" label="{{ __('Log in to your account') }}" class="text-center" />

            <x-subheading label="{{ __('Welcome back.') }}" class="text-center" />
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

    <form wire:submit="login" class="space-y-6">
        <x-input wire:model="email" type="email" label="Email" placeholder="email@example.com" required autofocus
            autocomplete="off" />

        <x-field>
            <x-label text="Password" required class="flex justify-between mb-2">
                @if (Route::has('password.request'))
                    <x-link href="{{ route('password.request') }}" label="Forgot your password?" variant="subtle"
                        wire:navigate />
                @endif
            </x-label>

            <x-input wire:model="password" type="password" placeholder="Your password" required autocomplete="off"
                viewable />
        </x-field>

        <x-checkbox wire:model="remember" label="Remember me" description="Stay signed in on this device" />

        <x-button type="submit" variant="primary" label="Log In" class="w-full" />
    </form>

    <div class="space-y-2">
        @if (Route::has('register'))
            <x-subheading class="text-center">
                First time around here?
                <x-link label="Register" href="{{ route('register') }}" wire:navigate />
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
