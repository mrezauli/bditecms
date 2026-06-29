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

            <div class="flex flex-col gap-8">
                <x-register.exam-card :exams="$exams" :types="$types" :sites="$sites" />
                <x-register.account-card />
                <x-register.questions-card :questions="$questions" :answers="$answers" />
                <x-register.personal-card :genders="$genders" :districts="$districts" :universities="$universities" />
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
