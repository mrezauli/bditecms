<?php

use App\Models\Exam;
use App\Models\Type;

test('type factory uses an existing exam id', function () {
    $exams = Exam::factory()->count(3)->create();

    $type = Type::factory()->create();

    expect($exams->modelKeys())->toContain($type->exam_id);
});
