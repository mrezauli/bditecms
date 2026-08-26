<?php

use App\Models\Exam;
use App\Models\HalfPasser;
use App\Models\Intake;
use App\Models\Type;
use App\Services\ExamineeResolver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

function setupFeExamWithTypes(): array
{
    $exam = Exam::factory()->create(['acronym' => 'FE']);
    $intake = Intake::factory()->for($exam)->create();
    $morningType = Type::factory()->create(['exam_id' => $exam->id, 'name' => 'FE: Morning (AM) Exam']);
    $afternoonType = Type::factory()->create(['exam_id' => $exam->id, 'name' => 'FE: Afternoon (PM) Exam']);
    $bothType = Type::factory()->create(['exam_id' => $exam->id, 'name' => 'FE: Both - Morning (AM) & Afternoon (PM) Exam']);

    return compact('exam', 'intake', 'morningType', 'afternoonType', 'bothType');
}

test('returns invalid for an unknown examinee id', function () {
    $resolution = app(ExamineeResolver::class)->resolve('FE-UNKNOWN-000');

    expect($resolution->status)->toBe('invalid');
    expect($resolution->message)->toBe(__('Invalid ID.'));
});

test('returns valid with remaining session when found in am only', function () {
    $ctx = setupFeExamWithTypes();
    HalfPasser::factory()->create([
        'examinee_no' => 'FE-AM-001',
        'type_id' => $ctx['morningType']->id,
        'intake_id' => $ctx['intake']->id,
    ]);

    $resolution = app(ExamineeResolver::class)->resolve('FE-AM-001');

    expect($resolution->status)->toBe('valid');
    expect($resolution->passedSession)->toBe('AM');
    expect($resolution->remainingTypeId)->toBe($ctx['afternoonType']->id);
    expect($resolution->remainingTypeName)->toBe('FE: Afternoon (PM) Exam');
});

test('returns valid with remaining session when found in pm only', function () {
    $ctx = setupFeExamWithTypes();
    HalfPasser::factory()->create([
        'examinee_no' => 'FE-PM-001',
        'type_id' => $ctx['afternoonType']->id,
        'intake_id' => $ctx['intake']->id,
    ]);

    $resolution = app(ExamineeResolver::class)->resolve('FE-PM-001');

    expect($resolution->status)->toBe('valid');
    expect($resolution->passedSession)->toBe('PM');
    expect($resolution->remainingTypeId)->toBe($ctx['morningType']->id);
    expect($resolution->remainingTypeName)->toBe('FE: Morning (AM) Exam');
});

test('returns both_passed when found in both am and pm', function () {
    $ctx = setupFeExamWithTypes();
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

    $resolution = app(ExamineeResolver::class)->resolve('FE-BOTH-001');

    expect($resolution->status)->toBe('both_passed');
});

test('returns name from half passer record', function () {
    $ctx = setupFeExamWithTypes();
    HalfPasser::factory()->create([
        'examinee_no' => 'FE-HP-001',
        'name' => 'Rahman',
        'type_id' => $ctx['morningType']->id,
        'intake_id' => $ctx['intake']->id,
    ]);

    $resolution = app(ExamineeResolver::class)->resolve('FE-HP-001');

    expect($resolution->status)->toBe('valid');
    expect($resolution->name)->toBe('Rahman');
});
