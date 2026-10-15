<?php

use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\Type;
use Tests\TestCase;

uses(TestCase::class);

test('charges the canonical fee for each exam and type combination', function (?string $examAcronym, ?string $typeName, float $expectedFee) {
    $enrollment = new Enrollment;

    $enrollment->setRelation('exam', Exam::factory()->make(['acronym' => $examAcronym]));

    if ($typeName !== null) {
        $enrollment->setRelation('type', new Type(['name' => $typeName]));
    }

    expect($enrollment->fee)->toBe($expectedFee);
})->with([
    'ip exam is always 500' => ['IP', null, 500.00],
    'ip exam ignores the type' => ['IP', 'FE: Both - Morning (AM) & Afternoon (PM) Exam', 500.00],
    'fe both sessions is 1000' => ['FE', 'FE: Both - Morning (AM) & Afternoon (PM) Exam', 1000.00],
    'fe morning only is 500' => ['FE', 'FE: Morning (AM) Exam', 500.00],
    'fe afternoon only is 500' => ['FE', 'FE: Afternoon (PM) Exam', 500.00],
    'fe without a type is 500' => ['FE', null, 500.00],
    'other exams fall back to 500' => ['XX', null, 500.00],
]);
