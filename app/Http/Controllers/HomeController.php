<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Intake;
use App\Models\Site;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $exams = Exam::currentStatus('active')->orderBy('level')->orderBy('name')->get();

        $schedules = Intake::with('exam')
            ->orderBy('exam_date', 'desc')
            ->take(4)
            ->get();

        $sites = Site::currentStatus('active')->orderBy('name')->get();

        $heroIntake = $schedules->first(fn (Intake $intake) => $intake->isRegistrationOpen())
            ?? $schedules->first(fn (Intake $intake) => now()->lt($intake->registration_starts_at))
            ?? $schedules->first();

        return view('welcome', [
            'exams' => $exams,
            'schedules' => $schedules,
            'sites' => $sites,
            'heroIntake' => $heroIntake,
        ]);
    }
}
