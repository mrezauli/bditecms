<div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
    <div class="flex items-center justify-between">
        <flux:heading size="xl">{{ __('Payment Details') }}</flux:heading>
        <flux:text class="text-sm text-zinc-500">{{ __('All gateway transactions for your enrollments') }}</flux:text>
    </div>

    @if ($this->payments->isEmpty())
        <div class="flex flex-col items-center justify-center gap-4 py-12">
            <flux:icon name="banknotes" class="size-16 text-zinc-300 dark:text-zinc-600" />
            <flux:heading size="lg">{{ __('No payments yet') }}</flux:heading>
            <flux:text class="text-center">{{ __('When you pay for an exam, it will appear here with transaction, amount and status.') }}</flux:text>
            <flux:button :href="route('applied.exams')" wire:navigate variant="primary" icon="arrow-top-right-on-square">{{ __('Go to Applied exams') }}</flux:button>
        </div>
    @else
        <div class="flex flex-col gap-4">
            @foreach ($this->payments as $payment)
                <flux:card class="flex flex-col gap-4">
                    <div class="flex flex-wrap items-start justify-between gap-3">
                        <div>
                            <flux:heading size="lg">{{ $payment->enrollment?->exam?->name ?? __('Payment') }} <span class="text-sm font-normal text-zinc-500">#{{ $payment->enrollment_id }}</span></flux:heading>
                            <flux:text class="text-sm">{{ $payment->enrollment?->exam?->acronym }} @if($payment->enrollment?->type) • {{ $payment->enrollment->type->name }} @endif @if($payment->enrollment?->site) • {{ $payment->enrollment->site->name }} @endif</flux:text>
                            <flux:text class="mt-1 text-xs text-zinc-500">{{ __('Enrollment ID') }}: {{ $payment->enrollment_id }} • {{ __('User') }}: {{ $payment->user->name ?? '—' }}</flux:text>
                        </div>
                        @php $color = match($payment->status){'Complete'=>'green','Pending'=>'yellow','Failed'=>'red','Canceled'=>'zinc',default=>'zinc'}; @endphp
                        <flux:badge :color="$color" size="sm">{{ $payment->status }}</flux:badge>
                    </div>

                    <flux:separator />

                    <div class="grid grid-cols-1 gap-3 text-sm md:grid-cols-2">
                        <div>
                            <flux:text class="text-xs font-medium">{{ __('Transaction ID') }}</flux:text>
                            <flux:text class="font-mono text-sm break-all">{{ $payment->transaction_id }}</flux:text>
                        </div>
                        <div>
                            <flux:text class="text-xs font-medium">{{ __('Amount') }}</flux:text>
                            <flux:text class="font-semibold">৳{{ number_format($payment->amount, 2) }} {{ $payment->currency }}</flux:text>
                            <flux:text class="text-xs text-zinc-500">{{ __('Expected fee') }}: ৳{{ number_format($payment->enrollment?->fee ?? 0, 2) }} @if($payment->enrollment && abs($payment->amount - $payment->enrollment->fee) >= 0.01) <span class="text-red-600">{{ __('Mismatch!') }}</span> @endif</flux:text>
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-xs text-zinc-500">
                        <span>{{ __('Created') }}: {{ $payment->created_at->format('d M Y, h:i A') }}</span>
                        <span>{{ __('Updated') }}: {{ $payment->updated_at->format('d M Y, h:i A') }}</span>
                    </div>

                    <div class="flex justify-end">
                        <flux:button :href="route('payment.validation', ['transaction_id' => $payment->transaction_id])" wire:navigate size="sm" variant="ghost" icon="shield-check">{{ __('Validate') }}</flux:button>
                    </div>
                </flux:card>
            @endforeach
        </div>
    @endif
</div>
