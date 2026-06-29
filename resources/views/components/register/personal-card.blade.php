@props(['genders', 'districts', 'universities'])

<div class="space-y-6 rounded-2xl border border-sky-100/50 bg-gradient-to-br from-sky-50 via-white to-indigo-50 p-6 shadow-sm dark:border-sky-900/30 dark:from-sky-950/30 dark:via-stone-950 dark:to-indigo-950/30">
    <h2 class="flex items-center gap-2 border-b border-sky-200/50 pb-4 text-lg font-bold text-sky-800 dark:border-sky-800/30 dark:text-sky-200">
        <flux:icon name="user" class="size-5 text-purple-500 dark:text-purple-400" />
        {{ __('Personal Information') }}
    </h2>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <flux:field>
            <flux:label>{{ __('Date of birth') }}</flux:label>
            <flux:input name="date_of_birth" :value="old('date_of_birth')" type="date" required />
            <flux:error name="date_of_birth" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Gender') }}</flux:label>
            <flux:select name="gender_id" required>
                <option value="">{{ __('Select gender') }}</option>
                @foreach ($genders as $id => $name)
                    <option value="{{ $id }}" @selected(old('gender_id') == $id)>{{ $name }}</option>
                @endforeach
            </flux:select>
            <flux:error name="gender_id" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Occupation') }}</flux:label>
            <flux:input name="occupation" :value="old('occupation')" type="text" required placeholder="{{ __('Occupation') }}" />
            <flux:error name="occupation" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Mobile number') }}</flux:label>
            <flux:input name="mobile_number" :value="old('mobile_number')" type="number" required placeholder="{{ __('Mobile number') }}" />
            <flux:error name="mobile_number" />
        </flux:field>

        <flux:field class="md:col-span-2">
            <flux:label>{{ __('Present address') }}</flux:label>
            <flux:textarea name="present_address" required placeholder="{{ __('Present address') }}">{{ old('present_address') }}</flux:textarea>
            <flux:error name="present_address" />
        </flux:field>

        <flux:field class="md:col-span-2">
            <flux:label>{{ __('Work address') }}</flux:label>
            <flux:textarea name="work_address" required placeholder="{{ __('Work address') }}">{{ old('work_address') }}</flux:textarea>
            <flux:error name="work_address" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('Post code') }}</flux:label>
            <flux:input name="post_code" :value="old('post_code')" type="number" required placeholder="{{ __('Post code') }}" />
            <flux:error name="post_code" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('District') }}</flux:label>
            <flux:select name="district_id" required>
                <option value="">{{ __('Select district') }}</option>
                @foreach ($districts as $id => $label)
                    <option value="{{ $id }}" @selected(old('district_id') == $id)>{{ $label }}</option>
                @endforeach
            </flux:select>
            <flux:error name="district_id" />
        </flux:field>

        <flux:field>
            <flux:label>{{ __('University') }}</flux:label>
            <flux:select name="university_id" required>
                <option value="">{{ __('Select university') }}</option>
                @foreach ($universities as $id => $acronym)
                    <option value="{{ $id }}" @selected(old('university_id') == $id)>{{ $acronym }}</option>
                @endforeach
            </flux:select>
            <flux:error name="university_id" />
        </flux:field>
    </div>
</div>