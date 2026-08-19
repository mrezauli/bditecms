<x-layouts::auth :title="__('Registration Closed')">
    <div class="flex flex-col gap-8">
        <div class="flex flex-col items-center text-center">
            <h1
                class="mb-2 bg-gradient-to-r from-sky-600 to-indigo-600 bg-clip-text text-3xl font-bold text-transparent dark:from-sky-400 dark:to-indigo-400">
                {{ __('Registration Currently Closed') }}
            </h1>
            <p class="text-base text-neutral-500 dark:text-neutral-400">
                {{ __('Registration is not open at this time. Please check back later for the next intake announcement.') }}
            </p>
        </div>

        <div class="space-y-6 p-6">
            <div class="rounded-lg border border-amber-200 bg-amber-50 p-6 text-center dark:border-amber-800 dark:bg-amber-900/20">
                <flux:icon name="calendar-days" class="mx-auto mb-4 size-12 text-amber-500 dark:text-amber-400" />
                <h2 class="mb-2 text-lg font-semibold text-amber-800 dark:text-amber-200">
                    {{ __('Next Intake Coming Soon') }}
                </h2>
                <p class="text-sm text-amber-700 dark:text-amber-300">
                    {{ __('We are preparing for the next examination session. Stay tuned for updates on registration dates.') }}
                </p>
            </div>
        </div>

        <div class="space-x-1 text-center text-sm text-neutral-500 dark:text-neutral-400">
            <span>{{ __('Already have an account?') }}</span>
            <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
        </div>
    </div>
</x-layouts::auth>
