<x-filament-panels::page>
    <div class="space-y-6">
        <x-filament::section>
            <x-slot name="heading">
                Validate Payment via SSLCommerz Gateway
            </x-slot>
            <x-slot name="description">
                Enter a <code>transaction_id</code> (e.g. <code>ENROLL-123-ABCDEF</code>) to fetch the local payment record and re-validate it against the gateway (<code>validator/api/validationserverAPI.php</code>). Uses <code>Sslcommerz::validatePayment()</code> + local amount/currency checks.
            </x-slot>

            <form wire:submit="validatePayment" class="space-y-4">
                <div>
                    <label for="transactionId" class="text-sm font-medium">Transaction ID</label>
                    <input wire:model="transactionId" id="transactionId" type="text"
                        placeholder="ENROLL-... or INV-..."
                        class="filament-forms-text-input-component mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-800" />
                    @error('transactionId')
                        <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-2">
                    <x-filament::button type="submit" icon="heroicon-o-shield-check">
                        Validate
                    </x-filament::button>
                    <x-filament::button color="gray" wire:click="clear" type="button" icon="heroicon-o-x-mark">
                        Clear
                    </x-filament::button>
                </div>
            </form>
        </x-filament::section>

        @if($validationMessage)
            <x-filament::section>
                <x-slot name="heading">
                    Result
                </x-slot>
                <div class="flex items-center gap-2">
                    <x-filament::badge :color="match($foundPayment?->status ?? $validationStatus){'Complete'=>'success','success'=>'success','Pending'=>'warning','warning'=>'warning','Failed'=>'danger','error'=>'danger','Canceled'=>'gray',default=>'gray'}">{{ $foundPayment?->status ?? ucfirst($validationStatus) }}</x-filament::badge>
                    <p class="text-sm font-medium">{{ $validationMessage }}</p>
                </div>
            </x-filament::section>
        @endif
    </div>
</x-filament-panels::page>
