@props(['exams', 'types', 'sites'])

<div class="space-y-6 rounded-2xl border border-sky-100/50 bg-gradient-to-br from-sky-50 via-white to-indigo-50 p-6 shadow-sm dark:border-sky-900/30 dark:from-sky-950/30 dark:via-stone-950 dark:to-indigo-950/30">
    <h2 class="flex items-center gap-2 border-b border-sky-200/50 pb-4 text-lg font-bold text-sky-800 dark:border-sky-800/30 dark:text-sky-200">
        <flux:icon name="trophy" class="size-5 text-yellow-500 dark:text-yellow-400" />
        {{ __('Exam Information') }}
    </h2>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
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

        <flux:field class="md:col-span-2">
            <flux:label>{{ __('Site') }}</flux:label>
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