<x-layouts::auth :title="__('Register')" wide>
    <div class="flex flex-col gap-8">
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

        <form method="POST" action="{{ route('register.preview') }}" class="flex flex-col gap-8">
            @csrf

            {{-- Account Information --}}
            <div class="space-y-6 p-6" x-data="{ verifiedName: null }"
                @examinee-validated.window="verifiedName = $event.detail.name ?? null"
                @examinee-reset.window="verifiedName = null">
                <h2
                    class="flex items-center gap-2 border-b border-sky-200/50 pb-4 text-lg font-bold text-sky-800 dark:border-sky-800/30 dark:text-sky-200">
                    <flux:icon name="user" class="size-5 text-blue-500 dark:text-blue-400" />
                    {{ __('Account Information') }}
                </h2>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <flux:field>
                        <flux:label>{{ __('Name') }} <span class="text-red-500">*</span></flux:label>
                        <flux:input name="name" :value="old('name')" type="text" required autofocus autocomplete="name"
                            placeholder="{{ __('Full name') }}" x-bind:readonly="verifiedName !== null" />
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
            @php
                $intakesJson = $intakesByExam->map(fn($intake) => [
                    'name' => $intake->name,
                    'exam_date' => $intake->exam_date->format('Y-m-d'),
                    'exam_date_display' => $intake->exam_date->format('d F Y'),
                    'reg_ends_at' => $intake->registration_ends_at->format('Y-m-d'),
                    'reg_ends_display' => $intake->registration_ends_at->format('d F Y'),
                    'days_left' => (int) now()->diffInDays($intake->registration_ends_at, false),
                ]);
            @endphp
            <div data-fe-exam-id="{{ $feExamId }}" data-fe-both-type-id="{{ $feBothTypeId }}"
                data-intakes='{{ $intakesJson }}' x-data="{
                    examId: '{{ old('exam_id') }}',
                    passedBefore: '{{ old('passed_before') }}',
                    examineeId: '{{ old('examinee_id') }}',
                    selectedIntakeId: '{{ old('intake_id') }}',
                    validationStatus: null,
                    validationMessage: '',
                    validatedTypeId: null,
                    validatedTypeName: null,
                    validatedName: null,
                    isFE: false,
                    selectedTypeId: null,
                    feTypeName: @js(__('FE: Both - Morning (AM) & Afternoon (PM) Exam')),
                    csrfToken: @js(csrf_token()),
                    activeIntake: null,

                    init() {
                        this.isFE = this.examId == this.$el.dataset.feExamId;
                        this.updateIntake();
                        this.$watch('examId', value => {
                            this.isFE = value == this.$el.dataset.feExamId;
                            this.selectedTypeId = null;
                            this.passedBefore = '';
                            this.examineeId = '';
                            this.selectedIntakeId = '';
                            this.validationStatus = null;
                            this.feTypeName = @js(__('FE: Both - Morning (AM) & Afternoon (PM) Exam'));
                            this.updateIntake();
                            window.dispatchEvent(new CustomEvent('examinee-reset'));
                        });
                        this.$watch('passedBefore', value => {
                            if (value === 'no') {
                                this.selectedTypeId = this.$el.dataset.feBothTypeId;
                                this.feTypeName = @js(__('FE: Both - Morning (AM) & Afternoon (PM) Exam'));
                            } else {
                                this.selectedTypeId = null;
                            }
                            this.examineeId = '';
                            this.selectedIntakeId = '';
                            this.validationStatus = null;
                            window.dispatchEvent(new CustomEvent('examinee-reset'));
                        });
                        this.$watch('validationStatus', value => {
                            if (value === 'valid') {
                                this.selectedTypeId = this.validatedTypeId;
                                this.feTypeName = this.validatedTypeName || @js(__('FE: Both - Morning (AM) & Afternoon (PM) Exam'));
                            }
                        });
                    },

                    updateIntake() {
                        const intakes = JSON.parse(this.$el.dataset.intakes);
                        this.activeIntake = intakes[this.examId] || null;
                    },

                    validateExaminee() {
                        if (this.examineeId.length < 4) return;
                        if (!this.selectedIntakeId) return;
                        this.validationStatus = 'loading';
                        this.validationMessage = '';
                        this.validatedName = null;
                        fetch('{{ url('examinee/validate') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': this.csrfToken,
                            },
                            body: JSON.stringify({ examinee_id: this.examineeId, intake_id: this.selectedIntakeId }),
                        })
                        .then(r => r.json())
                        .then(data => {
                            this.validationStatus = data.status;
                            this.validationMessage = data.message;
                            if (data.status === 'valid') {
                                this.validatedTypeId = data.type_id;
                                this.validatedTypeName = data.type_name;
                                this.validatedName = data.name;
                                if (data.name) {
                                    const nameInput = document.querySelector('form [name=name]');
                                    if (nameInput) { nameInput.value = data.name; }
                                }
                                window.dispatchEvent(new CustomEvent('examinee-validated', { detail: { name: data.name } }));
                            }
                        });
                    },
                }" class="space-y-6 p-6">
                <h2
                    class="flex items-center gap-2 border-b border-sky-200/50 pb-4 text-lg font-bold text-sky-800 dark:border-sky-800/30 dark:text-sky-200">
                    <flux:icon name="trophy" class="size-5 text-yellow-500 dark:text-yellow-400" />
                    {{ __('Exam Information') }}
                </h2>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
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

                    <flux:field>
                        <flux:label>{{ __('Exam') }} <span class="text-red-500">*</span></flux:label>
                        <flux:select name="exam_id" x-model="examId">
                            <option value="">{{ __('Select exam') }}</option>
                            @foreach ($exams as $id => $label)
                                <option value="{{ $id }}" @selected(old('exam_id') == $id)>{{ $label }}</option>
                            @endforeach
                        </flux:select>
                        <template x-if="!activeIntake && examId">
                            <div
                                class="mt-2 rounded-lg border border-red-200 bg-red-50 p-3 text-sm dark:border-red-800 dark:bg-red-900/20">
                                <div class="flex items-center gap-2">
                                    <flux:icon name="x-circle" class="size-4 shrink-0 text-red-600 dark:text-red-400" />
                                    <span
                                        class="font-medium text-red-800 dark:text-red-200">{{ __('Registration is not open for this exam.') }}</span>
                                </div>
                            </div>
                        </template>
                        <flux:error name="exam_id" />
                    </flux:field>

                    {{-- IP exam: no type field --}}
                    <template x-if="!isFE && examId">
                        <input type="hidden" name="type_id" value="">
                    </template>

                    {{-- FE exam: locked type select + hidden input --}}
                    <template x-if="isFE">
                        <flux:field class="md:col-span-2">
                            <flux:label>{{ __('Type') }} <span class="text-red-500">*</span></flux:label>
                            <input type="hidden" name="type_id" :value="selectedTypeId">
                            <div class="flex items-center gap-2 rounded-lg border border-neutral-200 bg-neutral-50 px-3 py-2 text-sm dark:border-neutral-700 dark:bg-neutral-800">
                                <span x-text="feTypeName"></span>
                            </div>
                            <template x-if="validationStatus === 'valid'">
                                <p class="mt-1 text-sm text-emerald-600" x-text="validationMessage"></p>
                            </template>
                            <flux:error name="type_id" />
                        </flux:field>
                    </template>

                    <template x-if="isFE">
                        <flux:field class="md:col-span-2">
                            <flux:label>{{ __('Have you passed either Morning (AM) exam or Afternoon (PM) Exam?') }}
                                <span class="text-red-500">*</span>
                            </flux:label>
                            <flux:select name="passed_before" x-model="passedBefore">
                                <option value="no" @selected(old('passed_before') === 'no')>{{ __('No') }}</option>
                                <option value="yes" @selected(old('passed_before') === 'yes')>{{ __('Yes') }}</option>
                            </flux:select>
                            <flux:error name="passed_before" />
                        </flux:field>
                    </template>

                    <template x-if="isFE && passedBefore === 'yes'">
                        <flux:field class="md:col-span-2">
                            <flux:label>{{ __('Intake') }} <span class="text-red-500">*</span></flux:label>
                            <input type="hidden" name="intake_id" :value="selectedIntakeId">
                            <flux:select x-model="selectedIntakeId" x-on:change="examineeId = ''; validationStatus = null;">
                                <option value="">{{ __('Select intake') }}</option>
                                @foreach ($feIntakes as $intake)
                                    <option value="{{ $intake['id'] }}">{{ $intake['name'] }}</option>
                                @endforeach
                            </flux:select>
                            <flux:error name="intake_id" />
                        </flux:field>
                    </template>

                    <template x-if="isFE && passedBefore === 'yes'">
                        <flux:field class="md:col-span-2">
                            <flux:label>{{ __('Examinee Number/ID (Example: FE00-0000)') }} <span
                                    class="text-red-500">*</span></flux:label>
                            <flux:input name="examinee_id" x-model="examineeId"
                                x-on:input.debounce.500ms="validateExaminee" type="text" placeholder="FE00-0000" />
                            <template x-if="validationStatus === 'loading'">
                                <p class="mt-1 text-sm text-neutral-500">{{ __('Searching') }}</p>
                            </template>
                            <template x-if="validationStatus === 'invalid'">
                                <p class="mt-1 text-sm text-red-600" x-text="validationMessage"></p>
                            </template>
                            <template x-if="validationStatus === 'both_passed'">
                                <p class="mt-1 text-sm text-red-600" x-text="validationMessage"></p>
                            </template>
                            <template x-if="validationStatus === 'valid' && validatedName">
                                <p class="mt-1 text-sm font-semibold text-emerald-700">{{ __('Name:') }} <span
                                        x-text="validatedName"></span></p>
                            </template>
                            <template x-if="validationStatus === 'valid' && validatedTypeName">
                                <p class="mt-1 text-sm font-semibold text-emerald-700">{{ __('Registering for:') }}
                                    <span x-text="validatedTypeName"></span>
                                </p>
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

            <div class="space-y-6 p-6">
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
            <div x-data="{
                    formDob: '{{ old('date_of_birth') }}',
                    formName: '{{ old('name') }}',
                    get generatedSlug() {
                        const namePart = this.formName.replace(/\s+/g, '').toLowerCase();
                        if (!this.formDob || !namePart) return '';
                        const parts = this.formDob.split('-');
                        return namePart + '-' + parts[2] + '-' + parts[1] + '-' + parts[0];
                    },
                    init() {
                        const nameInput = this.$root.closest('form').querySelector('[name=name]');
                        if (nameInput) {
                            this.formName = nameInput.value;
                            nameInput.addEventListener('input', (e) => {
                                this.formName = e.target.value;
                            });
                        }
                    },
                }" class="space-y-6 p-6">
                <h2
                    class="flex items-center gap-2 border-b border-sky-200/50 pb-4 text-lg font-bold text-sky-800 dark:border-sky-800/30 dark:text-sky-200">
                    <flux:icon name="user" class="size-5 text-purple-500 dark:text-purple-400" />
                    {{ __('Personal Information') }}
                </h2>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <flux:field>
                        <flux:label>{{ __('Date of birth') }} <span class="text-red-500">*</span></flux:label>
                        <flux:input name="date_of_birth" x-model="formDob" type="date" max="{{ $minimumDateOfBirth }}"
                            required />
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
                            <flux:input.group.prefix>+8801</flux:input.group.prefix>
                            <flux:input name="mobile_number" :value="old('mobile_number')" type="tel" required
                                pattern="[3-9][0-9]{8}" maxlength="9" placeholder="{{ __('Mobile number') }}" />
                        </flux:input.group>
                        <flux:error name="mobile_number" />
                    </flux:field>

                    <flux:field>
                        <flux:label>{{ __('Post code') }} <span class="text-red-500">*</span></flux:label>
                        <flux:input name="post_code" :value="old('post_code')" type="number" required
                            placeholder="{{ __('Post code') }}" />
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
                            <flux:label>{{ __('Other University Name') }} <span class="text-red-500">*</span>
                            </flux:label>
                            <flux:input name="other_university_name" :value="old('other_university_name')" type="text"
                                placeholder="{{ __('Enter your university name') }}" />
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
                    {{ __('Preview') }}
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-neutral-500 dark:text-neutral-400">
            <span>{{ __('Already have an account?') }}</span>
            <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
        </div>
    </div>
</x-layouts::auth>