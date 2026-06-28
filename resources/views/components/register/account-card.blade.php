<flux:card class="space-y-4">
    <flux:heading size="lg">{{ __('Account Information') }}</flux:heading>
    <flux:separator />

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
</flux:card>
