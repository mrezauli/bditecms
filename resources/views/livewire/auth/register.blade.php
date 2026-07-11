<x-layouts::auth :title="__('Register')" wide>
    <div
        class="flex flex-col gap-8">
        <div class="flex flex-col items-center text-center">

            <h1
                class="mb-2 bg-gradient-to-r from-sky-600 to-indigo-600 bg-clip-text text-3xl font-bold text-transparent dark:from-sky-400 dark:to-indigo-400">
                {{ __('Create Your Account') }}
            </h1>
            <p class="text-base text-neutral-500 dark:text-neutral-400">
                {{ __('Fill in your details below to register for exams') }}
            </p>
        </div>

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-8">
            @csrf

            {{-- Account Information --}}
            <div class="space-y-6 p-6">
                <h2
                    class="flex items-center gap-2 border-b border-sky-200/50 pb-4 text-lg font-bold text-sky-800 dark:border-sky-800/30 dark:text-sky-200">
                    <flux:icon name="user" class="size-5 text-blue-500 dark:text-blue-400" />
                    {{ __('Account Information') }}
                </h2>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <flux:field>
                        <flux:label>{{ __('Name') }} <span class="text-red-500">*</span></flux:label>
                        <flux:input name="name" :value="old('name')" type="text" required autofocus autocomplete="name"
                            placeholder="{{ __('Full name') }}" />
                        <flux:error name="name" />
                    </flux:field>

                    <flux:field>
                        <flux:label>{{ __('Email address') }} <span class="text-red-500">*</span></flux:label>
                        <flux:input name="email" :value="old('email')" type="email" required autocomplete="email"
                            placeholder="email@example.com" />
                        <flux:error name="email" />
                    </flux:field>

                    <flux:field>
                        <flux:label>{{ __('Password') }} <span class="text-red-500">*</span></flux:label>
                        <flux:input name="password" type="password" required autocomplete="new-password"
                            placeholder="{{ __('Password') }}" viewable />
                        <flux:error name="password" />
                    </flux:field>

                    <flux:field>
                        <flux:label>{{ __('Confirm password') }} <span class="text-red-500">*</span></flux:label>
                        <flux:input name="password_confirmation" type="password" required autocomplete="new-password"
                            placeholder="{{ __('Confirm password') }}" viewable />
                        <flux:error name="password_confirmation" />
                    </flux:field>
                </div>
            </div>

            {{-- Exam Information --}}
            <div data-fe-exam-id="{{ $feExamId }}" data-fe-both-type-id="{{ $feBothTypeId }}" x-data="{
                    examId: '{{ old('exam_id') }}',
                    passedBefore: '{{ old('passed_before') }}',
                    examineeId: '{{ old('examinee_id') }}',
                    validationStatus: null,
                    validationMessage: '',
                    validatedTypeId: null,
                    isFE: false,
                    selectedTypeId: null,

                    init() {
                        this.isFE = this.examId == this.$el.dataset.feExamId;
                        this.$watch('examId', value => this.isFE = value == this.$el.dataset.feExamId);
                        this.$watch('passedBefore', value => {
                            if (value === 'no') this.selectedTypeId = this.$el.dataset.feBothTypeId;
                            else this.selectedTypeId = null;
                        });
                        this.$watch('validationStatus', value => {
                            if (value === 'valid') this.selectedTypeId = this.validatedTypeId;
                        });
                    },

                    validateExaminee() {
                        if (this.examineeId.length < 4) return;
                        this.validationStatus = 'loading';
                        this.validationMessage = '';
                        fetch('{{ url('examinee/validate') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                            },
                            body: JSON.stringify({ examinee_id: this.examineeId, exam_id: this.examId }),
                        })
                        .then(r => r.json())
                        .then(data => {
                            this.validationStatus = data.status;
                            this.validationMessage = data.message;
                            if (data.status === 'valid') this.validatedTypeId = data.type_id;
                        });
                    },
                }"
                class="space-y-6 p-6">
                <h2
                    class="flex items-center gap-2 border-b border-sky-200/50 pb-4 text-lg font-bold text-sky-800 dark:border-sky-800/30 dark:text-sky-200">
                    <flux:icon name="trophy" class="size-5 text-yellow-500 dark:text-yellow-400" />
                    {{ __('Exam Information') }}
                </h2>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <flux:field>
                        <flux:label>{{ __('Exam') }} <span class="text-red-500">*</span></flux:label>
                        <flux:select name="exam_id" x-model="examId">
                            <option value="">{{ __('Select exam') }}</option>
                            @foreach ($exams as $id => $label)
                                <option value="{{ $id }}" @selected(old('exam_id') == $id)>{{ $label }}</option>
                            @endforeach
                        </flux:select>
                        <flux:error name="exam_id" />
                    </flux:field>

                    <flux:field>
                        <flux:label>{{ __('Site') }} <span class="text-red-500">*</span></flux:label>
                        <flux:select name="site_id" required>
                            <option value="">{{ __('Select site') }}</option>
                            @foreach ($sites as $id => $name)
                                <option value="{{ $id }}" @selected(old('site_id') == $id)>{{ $name }}</option>
                            @endforeach
                        </flux:select>
                        <flux:error name="site_id" />
                    </flux:field>

                    <input type="hidden" name="type_id" :value="selectedTypeId">

                    <template x-if="isFE">
                        <flux:field class="md:col-span-2">
                            <flux:label>{{ __('Have you passed either Morning (AM) exam or Afternoon (PM) Exam?') }}
                                <span class="text-red-500">*</span>
                            </flux:label>
                            <flux:select name="passed_before" x-model="passedBefore">
                                <option value="">{{ __('Select') }}</option>
                                <option value="yes" @selected(old('passed_before') === 'yes')>{{ __('Yes') }}</option>
                                <option value="no" @selected(old('passed_before') === 'no')>{{ __('No') }}</option>
                            </flux:select>
                            <flux:error name="passed_before" />
                        </flux:field>
                    </template>

                    <template x-if="isFE && passedBefore === 'yes'">
                        <flux:field>
                            <flux:label>{{ __('Examinee Number/ID (Example: FE00-0000)') }} <span
                                    class="text-red-500">*</span></flux:label>
                            <flux:input name="examinee_id" x-model="examineeId"
                                x-on:input.debounce.500ms="validateExaminee" type="text" placeholder="FE00-0000" />
                            <template x-if="validationStatus === 'loading'">
                                <p class="mt-1 text-sm text-neutral-500">{{ __('Validating...') }}</p>
                            </template>
                            <template x-if="validationStatus === 'invalid'">
                                <p class="mt-1 text-sm text-red-600" x-text="validationMessage"></p>
                            </template>
                            <template x-if="validationStatus === 'both_passed'">
                                <p class="mt-1 text-sm text-red-600" x-text="validationMessage"></p>
                            </template>
                            <template x-if="validationStatus === 'valid'">
                                <p class="mt-1 text-sm text-emerald-600" x-text="validationMessage"></p>
                            </template>
                            <flux:error name="examinee_id" />
                        </flux:field>
                    </template>
                </div>
            </div>

            {{-- Questions --}}
            @php
                $answerFields = ['first_answer_id', 'second_answer_id', 'third_answer_id', 'fourth_answer_id', 'fifth_answer_id', 'sixth_answer_id', 'seventh_answer_id', 'eighth_answer_id', 'ninth_answer_id'];
            @endphp

            <div
                class="space-y-6 p-6">
                <h2
                    class="flex items-center gap-2 border-b border-sky-200/50 pb-4 text-lg font-bold text-sky-800 dark:border-sky-800/30 dark:text-sky-200">
                    <flux:icon name="list-music" class="size-5 text-emerald-500 dark:text-emerald-400" />
                    {{ __('Questions') }}
                </h2>

                <div class="grid grid-cols-1 gap-6">
                    @foreach ($questions as $index => $question)
                        @php $field = $answerFields[$index] ?? null; @endphp
                        @if ($field)
                            <flux:field>
                                <flux:label>{{ $question->label }} - {{ $question->content }} <span
                                        class="text-red-500">*</span></flux:label>
                                <flux:select name="{{ $field }}" required>
                                    <option value="">{{ __('Select answer') }}</option>
                                    @foreach (($answers[$question->id] ?? collect()) as $answer)
                                        <option value="{{ $answer->id }}" @selected(old($field) == $answer->id)>{{ $answer->content }}
                                        </option>
                                    @endforeach
                                </flux:select>
                                <flux:error name="{{ $field }}" />
                            </flux:field>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- Personal Information --}}
            <div
                class="space-y-6 p-6">
                <h2
                    class="flex items-center gap-2 border-b border-sky-200/50 pb-4 text-lg font-bold text-sky-800 dark:border-sky-800/30 dark:text-sky-200">
                    <flux:icon name="user" class="size-5 text-purple-500 dark:text-purple-400" />
                    {{ __('Personal Information') }}
                </h2>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <flux:field>
                        <flux:label>{{ __('Date of birth') }} <span class="text-red-500">*</span></flux:label>
                        <flux:input name="date_of_birth" :value="old('date_of_birth')" type="date" required />
                        <flux:error name="date_of_birth" />
                    </flux:field>

                    <flux:field>
                        <flux:label>{{ __('Gender') }} <span class="text-red-500">*</span></flux:label>
                        <flux:select name="gender_id" required>
                            <option value="">{{ __('Select gender') }}</option>
                            @foreach ($genders as $id => $name)
                                <option value="{{ $id }}" @selected(old('gender_id') == $id)>{{ $name }}</option>
                            @endforeach
                        </flux:select>
                        <flux:error name="gender_id" />
                    </flux:field>

                    <flux:field>
                        <flux:label>{{ __('Occupation') }} <span class="text-red-500">*</span></flux:label>
                        <flux:input name="occupation" :value="old('occupation')" type="text" required maxlength="20"
                            placeholder="{{ __('Occupation') }}" />
                        <flux:error name="occupation" />
                    </flux:field>

                    <flux:field>
                        <flux:label>{{ __('Mobile number') }} <span class="text-red-500">*</span></flux:label>
                        <flux:input.group>
                            <flux:input.group.prefix>+880</flux:input.group.prefix>
                            <flux:input name="mobile_number" :value="old('mobile_number')" type="tel" required pattern="[3-9][0-9]{9}" maxlength="10" placeholder="{{ __('Mobile number') }}" />
                        </flux:input.group>
                        <flux:error name="mobile_number" />
                    </flux:field>

                    <flux:field>
                        <flux:label>{{ __('Post code') }} <span class="text-red-500">*</span></flux:label>
                        <flux:input name="post_code" :value="old('post_code')" type="number" required placeholder="{{ __('Post code') }}" />
                        <flux:error name="post_code" />
                    </flux:field>

                    <flux:field>
                        <flux:label>{{ __('District') }} <span class="text-red-500">*</span></flux:label>
                        <flux:select name="district_id" required>
                            <option value="">{{ __('Select district') }}</option>
                            @foreach ($districts as $id => $label)
                                <option value="{{ $id }}" @selected(old('district_id') == $id)>{{ $label }}</option>
                            @endforeach
                        </flux:select>
                        <flux:error name="district_id" />
                    </flux:field>

                    <div x-data="{ universityValue: '{{ old('university_id') }}' }" class="contents">
                        <flux:field>
                            <flux:label>{{ __('University') }} <span class="text-red-500">*</span></flux:label>
                            <flux:select name="university_id" x-model="universityValue">
                                <option value="">{{ __('Select university') }}</option>
                                <option value="other">{{ __('Not Listed') }}</option>
                                @foreach ($universities as $id => $label)
                                    <option value="{{ $id }}" @selected(old('university_id') == $id)>{{ $label }}</option>
                                @endforeach
                            </flux:select>
                            <flux:error name="university_id" />
                        </flux:field>

                        <flux:field x-show="universityValue === 'other'" x-cloak>
                            <flux:label>{{ __('Other University Name') }} <span class="text-red-500">*</span></flux:label>
                            <flux:input name="other_university_name" :value="old('other_university_name')" type="text" placeholder="{{ __('Enter your university name') }}" />
                            <flux:error name="other_university_name" />
                        </flux:field>
                    </div>

                    <flux:field class="md:col-span-2">
                        <flux:label>{{ __('Present address') }} <span class="text-red-500">*</span></flux:label>
                        <flux:textarea name="present_address" required placeholder="{{ __('Present address') }}">
                            {{ old('present_address') }}
                        </flux:textarea>
                        <flux:error name="present_address" />
                    </flux:field>

                    <flux:field class="md:col-span-2">
                        <flux:label>{{ __('Work address') }} <span class="text-red-500">*</span></flux:label>
                        <flux:textarea name="work_address" required placeholder="{{ __('Work address') }}">
                            {{ old('work_address') }}
                        </flux:textarea>
                        <flux:error name="work_address" />
                    </flux:field>
                </div>
            </div>

            <div class="flex items-center justify-center">
                <flux:button type="submit" variant="primary"
                    class="w-full max-w-md bg-gradient-to-r from-sky-600 to-indigo-600 py-4 text-base font-bold tracking-wide shadow-lg transition-all hover:scale-[1.01] hover:from-sky-500 hover:to-indigo-500 hover:shadow-sky-500/25 active:scale-[0.99]"
                    data-test="register-user-button">
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
