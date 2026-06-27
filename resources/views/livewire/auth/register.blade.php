<x-layouts::auth :title="__('Register')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Create an account')" :description="__('Fill in your details below to register')" />

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6">
            @csrf

            <flux:card class="space-y-4">
                <flux:heading size="lg">{{ __('Exam Information') }}</flux:heading>
                <flux:separator />

                <flux:field>
                    <flux:label>{{ __('Exam') }}</flux:label>
                    <flux:select name="exam_id" required>
                        <option value="">{{ __('Select exam') }}</option>
                        @foreach ($exams as $id => $acronym)
                            <option value="{{ $id }}" @selected(old('exam_id') == $id)>{{ $acronym }}</option>
                        @endforeach
                    </flux:select>
                    <flux:error name="exam_id" />
                </flux:field>

                <flux:field>
                    <flux:label>{{ __('Type') }}</flux:label>
                    <flux:select name="type_id" required>
                        <option value="">{{ __('Select type') }}</option>
                        @foreach ($types as $id => $name)
                            <option value="{{ $id }}" @selected(old('type_id') == $id)>{{ $name }}</option>
                        @endforeach
                    </flux:select>
                    <flux:error name="type_id" />
                </flux:field>

                <flux:field>
                    <flux:label>{{ __('Site') }}</flux:label>
                    <flux:select name="site_id" required>
                        <option value="">{{ __('Select site') }}</option>
                        @foreach ($sites as $id => $name)
                            <option value="{{ $id }}" @selected(old('site_id') == $id)>{{ $name }}</option>
                        @endforeach
                    </flux:select>
                    <flux:error name="site_id" />
                </flux:field>
            </flux:card>

            <flux:card class="space-y-4">
                <flux:heading size="lg">{{ __('Questions') }}</flux:heading>
                <flux:separator />

                @php
                    $answerFields = ['first_answer_id', 'second_answer_id', 'third_answer_id', 'fourth_answer_id', 'fifth_answer_id', 'sixth_answer_id', 'seventh_answer_id', 'eighth_answer_id', 'ninth_answer_id'];
                @endphp
                @foreach ($questions as $index => $question)
                    @php $field = $answerFields[$index] ?? null; @endphp
                    @if ($field)
                        <flux:field>
                            <flux:label>{{ $question->label }}</flux:label>
                            <flux:select name="{{ $field }}" required>
                                <option value="">{{ __('Select answer') }}</option>
                                @foreach (($answers[$question->id] ?? collect()) as $answer)
                                    <option value="{{ $answer->id }}" @selected(old($field) == $answer->id)>{{ $answer->content }}</option>
                                @endforeach
                            </flux:select>
                            <flux:error name="{{ $field }}" />
                        </flux:field>
                    @endif
                @endforeach
            </flux:card>

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

            <div class="flex items-center justify-end">
                <flux:button type="submit" variant="primary" class="w-full" data-test="register-user-button">
                    {{ __('Create account') }}
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            <span>{{ __('Already have an account?') }}</span>
            <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
        </div>
    </div>
</x-layouts::auth>
