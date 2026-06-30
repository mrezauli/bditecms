<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Applied exams')]
class AppliedExams extends Component
{
    #[Computed]
    public function enrollments()
    {
        return Auth::user()
            ->enrollments()
            ->with(['exam', 'type', 'site'])
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.applied-exams');
    }
}
