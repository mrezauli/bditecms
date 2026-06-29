<div class="space-y-6 rounded-2xl border border-sky-100/50 bg-gradient-to-br from-sky-50 via-white to-indigo-50 p-6 shadow-sm dark:border-sky-900/30 dark:from-sky-950/30 dark:via-stone-950 dark:to-indigo-950/30">
    <h2 class="flex items-center gap-2 border-b border-sky-200/50 pb-4 text-lg font-bold text-sky-800 dark:border-sky-800/30 dark:text-sky-200">
        <flux:icon name="user" class="size-5 text-blue-500 dark:text-blue-400" />
        {{ __('Account Information') }}
    </h2>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <flux:field>
            <flux:label>{{ __('Name') }}</flux:label>
            <flux:input name="name" :value="old('name')" type="text" required autofocus autocomplete="name" placeholder="{{ __('Full name') }}" />
            <flux:error name="name" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Email address') }}</flux:label>
            <flux:input name="email" :value="old('email')" type="email" required autocomplete="email" placeholder="email@example.com" />
            <flux:error name="email" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Password') }}</flux:label>
            <flux:input name="password" type="password" required autocomplete="new-password" placeholder="{{ __('Password') }}" viewable />
            <flux:error name="password" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Confirm password') }}</flux:label>
            <flux:input name="password_confirmation" type="password" required autocomplete="new-password" placeholder="{{ __('Confirm password') }}" viewable />
            <flux:error name="password_confirmation" />
        </flux:field>
    </div>
</div>