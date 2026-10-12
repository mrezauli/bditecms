<section class="w-full">
    @include('partials.settings-heading')

    <flux:heading class="sr-only">{{ __('Profile settings') }}</flux:heading>

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name, email address, and profile details')">
        @if ($this->isProfileLocked)
            <div
                class="mt-6 rounded-lg border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800 dark:border-amber-800 dark:bg-amber-900/20 dark:text-amber-200">
                {{ __('Registration is closed. Your profile can no longer be edited.') }}
            </div>
        @endif

        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus autocomplete="name" :disabled="$this->isProfileLocked" />

            <div>
                <flux:input wire:model="email" :label="__('Email')" type="email" disabled />

                @if ($this->hasUnverifiedEmail)
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Your email address is unverified.') }}

                            <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send the verification email.') }}
                            </flux:link>
                        </flux:text>

                    </div>
                @endif
            </div>

            <flux:separator :text="__('Additional Information')" />

            <div class="grid gap-6 md:grid-cols-2">
                <flux:input wire:model="date_of_birth" :label="__('Date of birth')" type="date" max="{{ now()->subYears(20)->format('Y-m-d') }}" :disabled="$this->isProfileLocked" />

                <flux:field>
                    <flux:label>{{ __('Mobile number') }}</flux:label>
                    <flux:input.group>
                        <flux:input.group.prefix>+8801</flux:input.group.prefix>
                        <flux:input wire:model="mobile_number" type="number" disabled />
                    </flux:input.group>
                </flux:field>

                <flux:select wire:model="gender_id" :label="__('Gender')" placeholder="Select gender" :disabled="$this->isProfileLocked">
                    @foreach ($this->genders as $gender)
                        <flux:select.option :value="$gender->id">{{ $gender->name }}</flux:select.option>
                    @endforeach
                </flux:select>

                <flux:select wire:model="district_id" :label="__('District')" placeholder="Select district" :disabled="$this->isProfileLocked">
                    @foreach ($this->districts as $district)
                        <flux:select.option :value="$district->id">{{ $district->name }}</flux:select.option>
                    @endforeach
                </flux:select>

                <flux:select wire:model.live="university_id" :label="__('University')" placeholder="Select university" :disabled="$this->isProfileLocked">
                    <flux:select.option value="other">{{ __('Not Listed') }}</flux:select.option>
                    @foreach ($this->universities as $university)
                        <flux:select.option :value="$university->id">{{ $university->name.' ('.$university->acronym.')' }}</flux:select.option>
                    @endforeach
                </flux:select>

                @if (($university_id ?? null) === 'other')
                    <flux:input wire:model="other_university_name" :label="__('Other University Name')" type="text" placeholder="{{ __('Enter your university name') }}" :disabled="$this->isProfileLocked" />
                @endif

                <flux:input wire:model="occupation" :label="__('Occupation')" type="text" maxlength="20" :disabled="$this->isProfileLocked" />

                <flux:input wire:model="post_code" :label="__('Post code')" type="number" :disabled="$this->isProfileLocked" />
            </div>

            <flux:textarea wire:model="present_address" :label="__('Present address')" :disabled="$this->isProfileLocked" />

            <flux:textarea wire:model="work_address" :label="__('Work address')" :disabled="$this->isProfileLocked" />

            @unless ($this->isProfileLocked)
                <div class="flex items-center gap-4">
                    <flux:button variant="primary" type="submit">{{ __('Save') }}</flux:button>
                </div>
            @endunless
        </form>

        @if ($this->showDeleteUser)
            <livewire:settings.delete-user-form />
        @endif
    </x-settings.layout>
</section>
