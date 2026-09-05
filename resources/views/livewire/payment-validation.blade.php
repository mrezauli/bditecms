<div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
    <div class="flex items-center justify-between">
        <flux:heading size="xl">{{ __('Payment Validation') }}</flux:heading>
        <flux:text class="text-sm text-zinc-500">{{ __('Re-validate your transaction against SSLCommerz gateway') }}
        </flux:text>
    </div>

    <flux:card class="flex flex-col gap-4">
        <flux:heading size="sm">{{ __('Validate by Transaction ID') }}</flux:heading>
        <flux:text class="text-sm text-zinc-500">
            {{ __('Enter your transaction ID (e.g. ENROLL-12-ABCDEF) – only your own payments will be checked. Offline fee check: IP 500 / FE half 500 / FE both 1000.') }}
        </flux:text>

        <form wire:submit="validatePayment" class="flex flex-col gap-4">
            <flux:field>
                <flux:label>{{ __('Transaction ID') }}</flux:label>
                <flux:input wire:model="transactionId" type="text" placeholder="ENROLL-..." required />
                <flux:error name="transactionId" />
            </flux:field>

            <div class="flex gap-2">
                <flux:button type="submit" variant="primary" icon="shield-check">{{ __('Validate') }}</flux:button>
                <flux:button type="button" wire:click="clear" variant="ghost">{{ __('Clear') }}</flux:button>
            </div>
        </form>
    </flux:card>

    @if($validationMessage)
        @php $color = match ($validationStatus) { 'success' => 'green', 'warning' => 'yellow', 'error' => 'red', default => 'zinc'}; @endphp
        <flux:card>
            <div class="flex items-center gap-2">
                <flux:badge :color="$color" size="sm">{{ $foundPayment?->status ?? ucfirst($validationStatus) }}
                </flux:badge>
                <flux:text class="text-sm font-medium">{{ $validationMessage }}</flux:text>
            </div>
        </flux:card>
    @endif

</div>