<?php

namespace App\Livewire;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Payment Details')]
class PaymentDetails extends Component
{
    #[Computed]
    public function payments()
    {
        return Payment::where('user_id', Auth::id())
            ->with(['enrollment.exam', 'enrollment.type', 'enrollment.site', 'user'])
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.payment-details');
    }
}
