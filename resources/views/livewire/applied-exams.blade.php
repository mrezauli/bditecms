<div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
    <div class="flex items-center justify-between">
        <flux:heading size="xl">{{ __('Applied exams') }}</flux:heading>
    </div>

    @if ($this->enrollments->isEmpty())
        <div class="flex flex-col items-center justify-center gap-4 py-12">
            <flux:icon name="clipboard-document-list" class="size-16 text-zinc-300 dark:text-zinc-600" />
            <flux:heading size="lg">{{ __('No applied exams yet') }}</flux:heading>
            <flux:text class="text-center">
                {{ __('You haven\'t applied for any exams yet.') }}
            </flux:text>
        </div>
    @else
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($this->enrollments as $enrollment)
                <flux:card class="flex flex-col gap-3">
                    <div class="flex items-start justify-between">
                        <div>
                            <flux:heading size="lg">{{ $enrollment->exam->name }}</flux:heading>
                            <flux:text class="text-sm">
                                {{ $enrollment->exam->acronym }}
                            </flux:text>
                        </div>
                        <flux:badge size="sm">{{ $enrollment->exam->level }}</flux:badge>
                    </div>

                    <flux:separator />

                    <div class="grid grid-cols-2 gap-3 text-sm">
                        @if ($enrollment->type)
                            <div>
                                <flux:text class="text-xs font-medium">{{ __('Type') }}</flux:text>
                                <flux:text>{{ $enrollment->type->name }}</flux:text>
                            </div>
                        @endif

                        @if ($enrollment->site)
                            <div>
                                <flux:text class="text-xs font-medium">{{ __('Venue') }}</flux:text>
                                <flux:text>{{ $enrollment->site->name }}</flux:text>
                            </div>
                        @endif
                    </div>

                    <div class="text-xs text-zinc-400 dark:text-zinc-500">
                        {{ __('Applied') }}: {{ $enrollment->created_at->format('d M Y, h:i A') }}
                    </div>
                </flux:card>
            @endforeach
        </div>
    @endif
</div>
