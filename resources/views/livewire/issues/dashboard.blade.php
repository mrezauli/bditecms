<div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
    <div class="flex items-center justify-between">
        <flux:heading size="xl">{{ __('Issues') }}</flux:heading>
        <flux:button wire:click="openCreateModal" variant="primary" size="sm">
            <flux:icon name="plus" class="size-4" />
            {{ __('New Issue') }}
        </flux:button>
    </div>

    {{-- Issue List --}}
    @if ($this->selectedIssueId && $this->selectedIssue)
        {{-- Issue Detail View --}}
        <div class="flex flex-col gap-4">
            <div class="flex items-center gap-3">
                <flux:button wire:click="closeIssue" variant="ghost" size="sm">
                    <flux:icon name="arrow-left" class="size-4" />
                    {{ __('Back') }}
                </flux:button>
                <flux:heading size="lg">{{ $this->selectedIssue->subject }}</flux:heading>
                <flux:badge :color="$this->selectedIssue->status_color" size="sm">
                    {{ ucfirst($this->selectedIssue->status) }}
                </flux:badge>
                <flux:badge :color="$this->selectedIssue->priority_color" size="sm">
                    {{ ucfirst($this->selectedIssue->priority) }}
                </flux:badge>
            </div>

            <div class="text-sm text-zinc-500 dark:text-zinc-400">
                {{ __('Category:') }} {{ $this->selectedIssue->category->name }} &middot;
                {{ __('Created:') }} {{ $this->selectedIssue->created_at->format('d M Y, h:i A') }}
            </div>

            {{-- Messages Thread --}}
            <div class="flex flex-col gap-3 rounded-xl border border-zinc-200 bg-white p-4 dark:border-zinc-700 dark:bg-zinc-900" style="max-height: 500px; overflow-y: auto;">
                @forelse ($this->selectedIssueMessages as $message)
                    @php
                        $isOwn = $message->user_id === auth()->id();
                    @endphp
                    <div class="flex {{ $isOwn ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-[75%] rounded-lg p-3 {{ $isOwn ? 'bg-sky-100 dark:bg-sky-900/30' : 'bg-zinc-100 dark:bg-zinc-800' }}">
                            <div class="flex items-center gap-2 text-xs text-zinc-500 dark:text-zinc-400">
                                <span class="font-medium">{{ $message->user->name }}</span>
                                <span>&middot;</span>
                                <span>{{ $message->created_at->format('d M Y, h:i A') }}</span>
                            </div>
                            <p class="mt-1 text-sm whitespace-pre-wrap">{{ $message->body }}</p>
                        </div>
                    </div>
                @empty
                    <div class="py-8 text-center text-sm text-zinc-400">
                        {{ __('No messages yet.') }}
                    </div>
                @endforelse
            </div>

            {{-- Reply Form --}}
            @if ($this->selectedIssue->status !== 'resolved')
                <form wire:submit="sendReply" class="flex gap-3">
                    <flux:textarea wire:model="replyBody" placeholder="{{ __('Type your reply...') }}" rows="2" class="flex-1" />
                    <flux:button type="submit" variant="primary" size="sm" class="self-end">
                        {{ __('Send') }}
                    </flux:button>
                </form>
            @else
                <div class="rounded-lg bg-emerald-50 p-3 text-sm text-emerald-700 dark:bg-emerald-900/20 dark:text-emerald-400">
                    {{ __('This issue has been resolved.') }}
                </div>
            @endif
        </div>
    @else
        {{-- Issues List --}}
        @if ($this->issues->isEmpty())
            <div class="flex flex-col items-center justify-center gap-4 py-12">
                <flux:icon name="chat-bubble-left-right" class="size-16 text-zinc-300 dark:text-zinc-600" />
                <flux:heading size="lg">{{ __('No issues yet') }}</flux:heading>
                <flux:text class="text-center">
                    {{ __('You haven\'t raised any issues yet.') }}
                </flux:text>
            </div>
        @else
            <div class="flex flex-col gap-3">
                @foreach ($this->issues as $issue)
                    <div wire:click="openIssue({{ $issue->id }})"
                        class="cursor-pointer rounded-xl border border-zinc-200 bg-white p-4 transition-colors hover:border-sky-300 hover:bg-sky-50/50 dark:border-zinc-700 dark:bg-zinc-900 dark:hover:border-sky-600 dark:hover:bg-sky-900/10">
                        <div class="flex items-start justify-between">
                            <div class="flex flex-col gap-1">
                                <div class="flex items-center gap-2">
                                    <flux:heading size="base">{{ $issue->subject }}</flux:heading>
                                    <flux:badge :color="$issue->status_color" size="sm">
                                        {{ ucfirst($issue->status) }}
                                    </flux:badge>
                                    <flux:badge :color="$issue->priority_color" size="sm">
                                        {{ ucfirst($issue->priority) }}
                                    </flux:badge>
                                </div>
                                <flux:text class="text-xs text-zinc-500 dark:text-zinc-400">
                                    {{ $issue->category->name }} &middot;
                                    {{ $issue->created_at->diffForHumans() }}
                                </flux:text>
                            </div>
                            <flux:icon name="chevron-right" class="size-5 text-zinc-400" />
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endif

    {{-- Create Issue Modal --}}
    @if ($showCreateModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" wire:click.self="closeCreateModal">
            <div class="w-full max-w-lg rounded-xl bg-white p-6 shadow-xl dark:bg-zinc-900" @click.stop>
                <div class="flex items-center justify-between">
                    <flux:heading size="lg">{{ __('Create Issue') }}</flux:heading>
                    <flux:button wire:click="closeCreateModal" variant="ghost" size="sm">
                        <flux:icon name="x-mark" class="size-5" />
                    </flux:button>
                </div>

                <form wire:submit="createIssue" class="mt-4 flex flex-col gap-4">
                    <flux:field>
                        <flux:label>{{ __('Category') }} <span class="text-red-500">*</span></flux:label>
                        <flux:select wire:model="categoryId" required>
                            <option value="">{{ __('Select category') }}</option>
                            @foreach ($this->categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </flux:select>
                        <flux:error name="categoryId" />
                    </flux:field>

                    <flux:field>
                        <flux:label>{{ __('Subject') }} <span class="text-red-500">*</span></flux:label>
                        <flux:input wire:model="subject" type="text" placeholder="{{ __('Brief description of your issue') }}" required />
                        <flux:error name="subject" />
                    </flux:field>

                    <flux:field>
                        <flux:label>{{ __('Priority') }} <span class="text-red-500">*</span></flux:label>
                        <flux:select wire:model="priority" required>
                            <option value="low">{{ __('Low') }}</option>
                            <option value="medium" selected>{{ __('Medium') }}</option>
                            <option value="high">{{ __('High') }}</option>
                        </flux:select>
                        <flux:error name="priority" />
                    </flux:field>

                    <flux:field>
                        <flux:label>{{ __('Description') }} <span class="text-red-500">*</span></flux:label>
                        <flux:textarea wire:model="body" rows="4" placeholder="{{ __('Describe your issue in detail...') }}" required />
                        <flux:error name="body" />
                    </flux:field>

                    <div class="flex justify-end gap-3">
                        <flux:button wire:click="closeCreateModal" variant="ghost">
                            {{ __('Cancel') }}
                        </flux:button>
                        <flux:button type="submit" variant="primary">
                            {{ __('Create Issue') }}
                        </flux:button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
