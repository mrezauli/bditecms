<section class="w-full">
    @include('partials.settings-heading')

    <flux:heading class="sr-only">{{ __('Profile settings') }}</flux:heading>

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name, email address, and profile details')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus autocomplete="name" />

            <div>
                <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" />

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
                <flux:input wire:model="date_of_birth" :label="__('Date of birth')" type="date" max="{{ now()->subYears(20)->format('Y-m-d') }}" />

                <flux:input wire:model="mobile_number" :label="__('Mobile number')" type="number" />

                <flux:select wire:model="gender_id" :label="__('Gender')" placeholder="Select gender">
                    @foreach ($this->genders as $gender)
                        <flux:select.option :value="$gender->id">{{ $gender->name }}</flux:select.option>
                    @endforeach
                </flux:select>

                <flux:select wire:model="district_id" :label="__('District')" placeholder="Select district">
                    @foreach ($this->districts as $district)
                        <flux:select.option :value="$district->id">{{ $district->name }}</flux:select.option>
                    @endforeach
                </flux:select>

                <flux:select wire:model="university_id" :label="__('University')" placeholder="Select university">
                    @foreach ($this->universities as $university)
                        <flux:select.option :value="$university->id">{{ $university->name.' ('.$university->acronym.')' }}</flux:select.option>
                    @endforeach
                </flux:select>

                <flux:input wire:model="occupation" :label="__('Occupation')" type="text" maxlength="20" />

                <flux:input wire:model="post_code" :label="__('Post code')" type="number" />
            </div>

            <flux:textarea wire:model="present_address" :label="__('Present address')" />

            <flux:textarea wire:model="work_address" :label="__('Work address')" />

            <div class="flex items-center gap-4">
                <flux:button variant="primary" type="submit">{{ __('Save') }}</flux:button>
            </div>
        </form>

        @if ($this->showDeleteUser)
            <livewire:settings.delete-user-form />
        @endif
    </x-settings.layout>
</section>
