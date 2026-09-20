<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        <flux:heading size="xl">{{ __('Dashboard') }}</flux:heading>

        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            <a href="{{ route('applied.exams') }}"
                class="group flex flex-col gap-3 rounded-xl border border-neutral-200 bg-white p-6 transition-all hover:border-sky-300 hover:shadow-md dark:border-neutral-700 dark:bg-neutral-900 dark:hover:border-sky-600">
                <flux:icon name="academic-cap" class="size-8 text-sky-500 dark:text-sky-400" />
                <div>
                    <flux:heading size="lg">{{ __('Applied Exams') }}</flux:heading>
                    <flux:text class="text-sm">{{ __('View and manage your exam applications') }}</flux:text>
                </div>
            </a>

            <a href="{{ route('issues') }}"
                class="group flex flex-col gap-3 rounded-xl border border-neutral-200 bg-white p-6 transition-all hover:border-sky-300 hover:shadow-md dark:border-neutral-700 dark:bg-neutral-900 dark:hover:border-sky-600">
                <flux:icon name="chat-bubble-left-right" class="size-8 text-emerald-500 dark:text-emerald-400" />
                <div>
                    <flux:heading size="lg">{{ __('Issues') }}</flux:heading>
                    <flux:text class="text-sm">{{ __('Raise and track support issues') }}</flux:text>
                </div>
            </a>

            <a href="{{ route('profile.edit') }}"
                class="group flex flex-col gap-3 rounded-xl border border-neutral-200 bg-white p-6 transition-all hover:border-sky-300 hover:shadow-md dark:border-neutral-700 dark:bg-neutral-900 dark:hover:border-sky-600">
                <flux:icon name="cog-6-tooth" class="size-8 text-purple-500 dark:text-purple-400" />
                <div>
                    <flux:heading size="lg">{{ __('Settings') }}</flux:heading>
                    <flux:text class="text-sm">{{ __('Manage your account settings') }}</flux:text>
                </div>
            </a>
        </div>
    </div>
</x-layouts::app>
