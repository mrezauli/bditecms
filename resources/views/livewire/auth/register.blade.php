<x-layouts::auth :title="__('Register')" wide>
    <div class="flex flex-col gap-8">
        <div class="flex flex-col items-center text-center">

            <h1 class="mb-2 bg-gradient-to-r from-sky-600 to-indigo-600 bg-clip-text text-3xl font-bold text-transparent dark:from-sky-400 dark:to-indigo-400">
                {{ __('Create Your Account') }}
            </h1>
            <p class="text-base text-neutral-500 dark:text-neutral-400">
                {{ __('Fill in your details below to register for exams') }}
            </p>
        </div>

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-8">
            @csrf

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <flux:field>
                    <flux:label>{{ __('Name') }} <span class="text-red-500">*</span></flux:label>
                    <flux:input name="name" :value="old('name')" type="text" required autofocus autocomplete="name" placeholder="{{ __('Full name') }}" />
                    <flux:error name="name" />
                </flux:field>

                <flux:field>
                    <flux:label>{{ __('Email address') }} <span class="text-red-500">*</span></flux:label>
                    <flux:input name="email" :value="old('email')" type="email" required autocomplete="email" placeholder="email@example.com" />
                    <flux:error name="email" />
                </flux:field>

                <flux:field>
                    <flux:label>{{ __('Password') }} <span class="text-red-500">*</span></flux:label>
                    <flux:input name="password" type="password" required autocomplete="new-password" placeholder="{{ __('Password') }}" viewable />
                    <flux:error name="password" />
                </flux:field>

                <flux:field>
                    <flux:label>{{ __('Confirm password') }} <span class="text-red-500">*</span></flux:label>
                    <flux:input name="password_confirmation" type="password" required autocomplete="new-password" placeholder="{{ __('Confirm password') }}" viewable />
                    <flux:error name="password_confirmation" />
                </flux:field>
            </div>

            <div class="flex items-center justify-center">
                <flux:button type="submit" variant="primary" class="w-full max-w-md bg-gradient-to-r from-sky-600 to-indigo-600 py-4 text-base font-bold tracking-wide shadow-lg transition-all hover:scale-[1.01] hover:from-sky-500 hover:to-indigo-500 hover:shadow-sky-500/25 active:scale-[0.99]" data-test="register-user-button">
                    {{ __('Create account') }}
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-neutral-500 dark:text-neutral-400">
            <span>{{ __('Already have an account?') }}</span>
            <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
        </div>
    </div>
</x-layouts::auth>
