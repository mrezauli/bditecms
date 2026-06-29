@props(['questions', 'answers'])

<div class="space-y-6 rounded-2xl border border-sky-100/50 bg-gradient-to-br from-sky-50 via-white to-indigo-50 p-6 shadow-sm dark:border-sky-900/30 dark:from-sky-950/30 dark:via-stone-950 dark:to-indigo-950/30">
    <h2 class="flex items-center gap-2 border-b border-sky-200/50 pb-4 text-lg font-bold text-sky-800 dark:border-sky-800/30 dark:text-sky-200">
        <flux:icon name="list-music" class="size-5 text-emerald-500 dark:text-emerald-400" />
        {{ __('Questions') }}
    </h2>

    @php
        $answerFields = ['first_answer_id', 'second_answer_id', 'third_answer_id', 'fourth_answer_id', 'fifth_answer_id', 'sixth_answer_id', 'seventh_answer_id', 'eighth_answer_id', 'ninth_answer_id'];
    @endphp

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        @foreach ($questions as $index => $question)
            @php $field = $answerFields[$index] ?? null; @endphp
            @if ($field)
                <flux:field>
                    <flux:label>{{ $question->label }} - {{ $question->content }}</flux:label>
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
    </div>
</div>