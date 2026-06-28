@props(['genders', 'districts', 'universities'])

<flux:card class="space-y-4">
    <flux:heading size="lg">{{ __('Personal Information') }}</flux:heading>
    <flux:separator />

    <flux:field>
        <flux:label>{{ __('Date of birth') }}</flux:label>
        <flux:input name="date_of_birth" :value="old('date_of_birth')" type="date" required />
        <flux:error name="date_of_birth" />
    </flux:field>

    <flux:field>
        <flux:label>{{ __('Gender') }}</flux:label>
        <div class="flex gap-4">
            @foreach ($genders as $id => $name)
                <label class="flex items-center gap-2">
                    <flux:radio name="gender_id" value="{{ $id }}" @checked(old('gender_id') == $id) />
                    <span>{{ $name }}</span>
                </label>
            @endforeach
        </div>
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

    <flux:field>
        <flux:label>{{ __('Present address') }}</flux:label>
        <flux:textarea name="present_address" required placeholder="{{ __('Present address') }}">{{ old('present_address') }}</flux:textarea>
        <flux:error name="present_address" />
    </flux:field>

    <flux:field>
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
</flux:card>
