@props(['exams', 'types', 'sites'])

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
