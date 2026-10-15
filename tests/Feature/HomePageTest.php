<?php

use App\Models\Exam;
use App\Models\Intake;
use App\Models\Site;

function seedHomePage(): array
{
    $exam = Exam::factory()->create(['acronym' => 'IP', 'name' => 'Passport', 'level' => '1']);
    $exam->setStatus('active');

    $intake = Intake::factory()->for($exam)->create([
        'name' => 'Spring 2026',
        'exam_date' => '2026-04-26',
        'registration_starts_at' => now()->subDay(),
        'registration_ends_at' => now()->addDays(30),
        'result_published_at' => null,
    ]);
    $intake->setStatus('active');

    $site = Site::factory()->create(['name' => 'Test Venue City']);
    $site->setStatus('active');

    return compact('exam', 'intake', 'site');
}

test('homepage shows admin exam intake and venue data', function () {
    seedHomePage();

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('IP Exam', false)
        ->assertSee('Spring 2026')
        ->assertSee('26 April 2026')
        ->assertSee('Registration closes')
        ->assertSee('Test Venue City');
});

test('homepage shows closed status for past intakes', function () {
    $exam = Exam::factory()->create(['acronym' => 'FE']);
    $exam->setStatus('active');

    Intake::factory()->for($exam)->create([
        'name' => 'Autumn 2025',
        'exam_date' => '2025-10-25',
        'registration_starts_at' => now()->subMonths(3),
        'registration_ends_at' => now()->subMonths(2),
        'result_published_at' => now()->subMonth(),
    ]);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Autumn 2025')
        ->assertSee('Closed')
        ->assertSee('Results published');
});
