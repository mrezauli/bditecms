@props(['exams', 'types', 'sites', 'feExamId', 'feBothTypeId', 'feMorningTypeId', 'feAfternoonTypeId'])

<div
    data-fe-exam-id="{{ $feExamId }}"
    data-fe-both-type-id="{{ $feBothTypeId }}"
    x-data="{
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
    class="space-y-6 rounded-2xl border border-sky-100/50 bg-gradient-to-br from-sky-50 via-white to-indigo-50 p-6 shadow-sm dark:border-sky-900/30 dark:from-sky-950/30 dark:via-stone-950 dark:to-indigo-950/30"
>
    <h2 class="flex items-center gap-2 border-b border-sky-200/50 pb-4 text-lg font-bold text-sky-800 dark:border-sky-800/30 dark:text-sky-200">
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

        <input type="hidden" name="type_id" :value="selectedTypeId">

        <template x-if="isFE">
            <flux:field>
                <flux:label>{{ __('Have you passed either Morning (AM) exam or Afternoon (PM) Exam?') }} <span class="text-red-500">*</span></flux:label>
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
                <flux:label>{{ __('Examinee Number/ID (Example: FE00-0000)') }} <span class="text-red-500">*</span></flux:label>
                <flux:input name="examinee_id" x-model="examineeId" x-on:input.debounce.500ms="validateExaminee" type="text" placeholder="FE00-0000" />
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

        <flux:field class="md:col-span-2">
            <flux:label>{{ __('Site') }} <span class="text-red-500">*</span></flux:label>
            <flux:select name="site_id" required>
                <option value="">{{ __('Select site') }}</option>
                @foreach ($sites as $id => $name)
                    <option value="{{ $id }}" @selected(old('site_id') == $id)>{{ $name }}</option>
                @endforeach
            </flux:select>
            <flux:error name="site_id" />
        </flux:field>
    </div>
</div>
