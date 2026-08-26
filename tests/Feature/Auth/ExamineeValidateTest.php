<?php

use App\Models\Exam;
use App\Models\HalfPasser;
use App\Models\Intake;
use App\Models\Type;
use Laravel\Fortify\Features;

beforeEach(function () {
    $this->skipUnlessFortifyHas(Features::registration());
});

function setupFeContext(): array
{
    $exam = Exam::factory()->create(['acronym' => 'FE']);
    $intake = Intake::factory()->for($exam)->create([
        'registration_starts_at' => now()->subDay(),
        'registration_ends_at' => now()->addDays(30),
    ]);
    $intake->setStatus('active');

    return [
        'exam' => $exam,
        'intake' => $intake,
        'morningType' => Type::factory()->create(['exam_id' => $exam->id, 'name' => 'FE: Morning (AM) Exam']),
        'afternoonType' => Type::factory()->create(['exam_id' => $exam->id, 'name' => 'FE: Afternoon (PM) Exam']),
        'bothType' => Type::factory()->create(['exam_id' => $exam->id, 'name' => 'FE: Both - Morning (AM) & Afternoon (PM) Exam']),
    ];
}

test('returns validation errors for missing examinee_id', function () {
    $this->postJson(route('examinee.validate'), [])
        ->assertJsonValidationErrors(['examinee_id']);
});

test('returns invalid for unknown examinee id', function () {
    $this->postJson(route('examinee.validate'), [
        'examinee_id' => 'FE-UNKNOWN-001',
    ])->assertJsonPath('status', 'invalid')
        ->assertJsonPath('message', __('Invalid ID.'));
});

test('returns valid with opposite session for am-only half passer', function () {
    $ctx = setupFeContext();
    HalfPasser::factory()->create([
        'examinee_no' => 'FE-HP-AM-001',
        'name' => 'Rahman',
        'type_id' => $ctx['morningType']->id,
        'intake_id' => $ctx['intake']->id,
    ]);

    $this->postJson(route('examinee.validate'), [
        'examinee_id' => 'FE-HP-AM-001',
    ])
        ->assertOk()
        ->assertJsonPath('status', 'valid')
        ->assertJsonPath('type_id', $ctx['afternoonType']->id)
        ->assertJsonPath('type_name', 'FE: Afternoon (PM) Exam')
        ->assertJsonPath('name', 'Rahman');
});

test('returns both_passed when examinee passed both sessions via half_passers', function () {
    $ctx = setupFeContext();
    HalfPasser::factory()->create([
        'examinee_no' => 'FE-BOTH-001',
        'type_id' => $ctx['morningType']->id,
        'intake_id' => $ctx['intake']->id,
    ]);
    HalfPasser::factory()->create([
        'examinee_no' => 'FE-BOTH-001',
        'type_id' => $ctx['afternoonType']->id,
        'intake_id' => $ctx['intake']->id,
    ]);

    $this->postJson(route('examinee.validate'), [
        'examinee_id' => 'FE-BOTH-001',
    ])
        ->assertOk()
        ->assertJsonPath('status', 'both_passed')
        ->assertJsonPath('message', __('You should not register because you are already passed.'));
});
