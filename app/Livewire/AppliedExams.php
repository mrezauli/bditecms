<?php

namespace App\Livewire;

use App\Models\Enrollment;
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
            ->with(['exam', 'type', 'site', 'payment'])
            ->latest()
            ->get();
    }

    public function pay(int $enrollmentId)
    {
        $enrollment = Enrollment::findOrFail($enrollmentId);

        abort_unless($enrollment->user_id === Auth::id(), 403);

        return redirect()->route('enrollment.pay', $enrollment);
    }

    public function render()
    {
        return view('livewire.applied-exams');
    }
}
