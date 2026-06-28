@props(['questions', 'answers'])

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
