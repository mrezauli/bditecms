<x-layouts::auth :title="__('Preview Registration')" wide>
    <div class="flex flex-col gap-8">
        <div class="flex flex-col items-center text-center">
            <h1 class="mb-2 bg-gradient-to-r from-sky-600 to-indigo-600 bg-clip-text text-3xl font-bold text-transparent dark:from-sky-400 dark:to-indigo-400">
                {{ __('Preview Your Registration') }}
            </h1>
            <p class="text-base text-neutral-500 dark:text-neutral-400">
                {{ __('Please review your information before creating your account. No data has been saved yet.') }}
            </p>
        </div>

        <x-auth-session-status class="text-center" :status="session('status')" />

        {{-- Account Information --}}
        <div class="space-y-4 rounded-xl border border-sky-200/50 bg-white p-6 shadow-sm dark:border-sky-800/30 dark:bg-neutral-900">
            <h2 class="flex items-center gap-2 border-b border-sky-200/50 pb-3 text-lg font-bold text-sky-800 dark:border-sky-800/30 dark:text-sky-200">
                <flux:icon name="user" class="size-5 text-blue-500" />
                {{ __('Account Information') }}
            </h2>
            <dl class="grid grid-cols-1 gap-4 text-sm md:grid-cols-2">
                <div>
                    <dt class="font-medium text-neutral-500 dark:text-neutral-400">{{ __('Name') }}</dt>
                    <dd class="mt-1 font-semibold text-neutral-900 dark:text-white">{{ $display['account']['name'] }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-neutral-500 dark:text-neutral-400">{{ __('Email address') }}</dt>
                    <dd class="mt-1 font-semibold text-neutral-900 dark:text-white">{{ $display['account']['email'] }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-neutral-500 dark:text-neutral-400">{{ __('Password') }}</dt>
                    <dd class="mt-1 font-semibold text-neutral-900 dark:text-white">{{ $display['account']['password'] }}</dd>
                </div>
            </dl>
        </div>

        {{-- Exam Information --}}
        <div class="space-y-4 rounded-xl border border-sky-200/50 bg-white p-6 shadow-sm dark:border-sky-800/30 dark:bg-neutral-900">
            <h2 class="flex items-center gap-2 border-b border-sky-200/50 pb-3 text-lg font-bold text-sky-800 dark:border-sky-800/30 dark:text-sky-200">
                <flux:icon name="trophy" class="size-5 text-yellow-500" />
                {{ __('Exam Information') }}
            </h2>
            <dl class="grid grid-cols-1 gap-4 text-sm md:grid-cols-2">
                <div>
                    <dt class="font-medium text-neutral-500 dark:text-neutral-400">{{ __('Exam') }}</dt>
                    <dd class="mt-1 text-neutral-900 dark:text-white">{{ $display['exam']['exam'] }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-neutral-500 dark:text-neutral-400">{{ __('Site') }}</dt>
                    <dd class="mt-1 text-neutral-900 dark:text-white">{{ $display['exam']['site'] }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-neutral-500 dark:text-neutral-400">{{ __('Type') }}</dt>
                    <dd class="mt-1 text-neutral-900 dark:text-white">{{ $display['exam']['type'] }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-neutral-500 dark:text-neutral-400">{{ __('Intake') }}</dt>
                    <dd class="mt-1 text-neutral-900 dark:text-white">{{ $display['exam']['intake'] }}</dd>
                </div>
                @if(($display['exam']['passed_before'] ?? '—') !== '—' && $display['exam']['passed_before'] !== '')
                <div>
                    <dt class="font-medium text-neutral-500 dark:text-neutral-400">{{ __('Passed before') }}</dt>
                    <dd class="mt-1 text-neutral-900 dark:text-white">{{ $display['exam']['passed_before'] }}</dd>
                </div>
                @endif
                @if(($display['exam']['examinee_id'] ?? '—') !== '—' && $display['exam']['examinee_id'] !== '')
                <div>
                    <dt class="font-medium text-neutral-500 dark:text-neutral-400">{{ __('Examinee ID') }}</dt>
                    <dd class="mt-1 text-neutral-900 dark:text-white">{{ $display['exam']['examinee_id'] }}</dd>
                </div>
                @endif
            </dl>
        </div>

        {{-- Questions --}}
        <div class="space-y-4 rounded-xl border border-sky-200/50 bg-white p-6 shadow-sm dark:border-sky-800/30 dark:bg-neutral-900">
            <h2 class="flex items-center gap-2 border-b border-sky-200/50 pb-3 text-lg font-bold text-sky-800 dark:border-sky-800/30 dark:text-sky-200">
                <flux:icon name="question-mark-circle" class="size-5 text-emerald-500" />
                {{ __('Questions') }}
            </h2>
            <div class="space-y-3">
                @foreach($display['questions'] as $qa)
                    <div class="rounded-lg bg-neutral-50 p-3 dark:bg-neutral-800/50">
                        <p class="text-xs font-medium text-neutral-500 dark:text-neutral-400">{{ $qa['label'] }} — {{ $qa['question'] }}</p>
                        <p class="mt-1 text-sm font-semibold text-neutral-900 dark:text-white">{{ $qa['answer'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Personal Information --}}
        <div class="space-y-4 rounded-xl border border-sky-200/50 bg-white p-6 shadow-sm dark:border-sky-800/30 dark:bg-neutral-900">
            <h2 class="flex items-center gap-2 border-b border-sky-200/50 pb-3 text-lg font-bold text-sky-800 dark:border-sky-800/30 dark:text-sky-200">
                <flux:icon name="identification" class="size-5 text-purple-500" />
                {{ __('Personal Information') }}
            </h2>
            <dl class="grid grid-cols-1 gap-4 text-sm md:grid-cols-2">
                <div>
                    <dt class="font-medium text-neutral-500 dark:text-neutral-400">{{ __('Date of birth') }}</dt>
                    <dd class="mt-1 text-neutral-900 dark:text-white">{{ $display['personal']['date_of_birth'] }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-neutral-500 dark:text-neutral-400">{{ __('Gender') }}</dt>
                    <dd class="mt-1 text-neutral-900 dark:text-white">{{ $display['personal']['gender'] }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-neutral-500 dark:text-neutral-400">{{ __('Occupation') }}</dt>
                    <dd class="mt-1 text-neutral-900 dark:text-white">{{ $display['personal']['occupation'] }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-neutral-500 dark:text-neutral-400">{{ __('Mobile number') }}</dt>
                    <dd class="mt-1 text-neutral-900 dark:text-white">{{ $display['personal']['mobile_number'] }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-neutral-500 dark:text-neutral-400">{{ __('Post code') }}</dt>
                    <dd class="mt-1 text-neutral-900 dark:text-white">{{ $display['personal']['post_code'] }}</dd>
                </div>
                <div>
                    <dt class="font-medium text-neutral-500 dark:text-neutral-400">{{ __('District') }}</dt>
                    <dd class="mt-1 text-neutral-900 dark:text-white">{{ $display['personal']['district'] }}</dd>
                </div>
                <div class="md:col-span-2">
                    <dt class="font-medium text-neutral-500 dark:text-neutral-400">{{ __('University') }}</dt>
                    <dd class="mt-1 text-neutral-900 dark:text-white">{{ $display['personal']['university'] }}</dd>
                </div>
                <div class="md:col-span-2">
                    <dt class="font-medium text-neutral-500 dark:text-neutral-400">{{ __('Present address') }}</dt>
                    <dd class="mt-1 whitespace-pre-wrap text-neutral-900 dark:text-white">{{ $display['personal']['present_address'] }}</dd>
                </div>
                <div class="md:col-span-2">
                    <dt class="font-medium text-neutral-500 dark:text-neutral-400">{{ __('Work address') }}</dt>
                    <dd class="mt-1 whitespace-pre-wrap text-neutral-900 dark:text-white">{{ $display['personal']['work_address'] }}</dd>
                </div>
            </dl>
        </div>

        <p class="text-center text-sm text-neutral-500 dark:text-neutral-400">
            {{ __('If everything looks correct, submit to create your account. Use Back to edit.') }}
        </p>

        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-center">
            <form method="POST" action="{{ route('register.preview.back') }}">
                @csrf
                <flux:button type="submit" variant="ghost" class="w-full sm:w-auto">
                    {{ __('Back') }}
                </flux:button>
            </form>

            <form method="POST" action="{{ route('register.confirm') }}">
                @csrf
                <flux:button type="submit" variant="primary" class="w-full bg-gradient-to-r from-sky-600 to-indigo-600 shadow-lg hover:from-sky-500 hover:to-indigo-500 sm:w-auto">
                    {{ __('Submit') }}
                </flux:button>
            </form>
        </div>
    </div>
</x-layouts::auth>
