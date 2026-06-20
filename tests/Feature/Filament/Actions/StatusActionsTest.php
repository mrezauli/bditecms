<?php

declare(strict_types=1);

use App\Filament\Actions\ActivateRecordAction;
use App\Filament\Actions\DeactivateRecordAction;
use App\Models\Answer;
use App\Models\District;
use App\Models\Division;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Site;
use App\Models\Type;
use App\Models\University;
use App\Models\User;

describe('Status Actions', function () {
    beforeEach(function () {
        // Authenticate as admin for all tests
        $this->actingAs(User::factory()->create());
    });

    describe('ActivateRecordAction', function () {
        it('activates a user record', function () {
            $user = User::factory()->create();

            expect($user->hasStatus('active'))->toBeFalse();

            $user->setStatus('active');

            expect($user->hasStatus('active'))->toBeTrue();
        });

        it('activates an exam record', function () {
            $exam = Exam::factory()->create();

            expect($exam->hasStatus('active'))->toBeFalse();

            $exam->setStatus('active');

            expect($exam->hasStatus('active'))->toBeTrue();
        });

        it('activates a question record', function () {
            $question = Question::factory()->create();

            expect($question->hasStatus('active'))->toBeFalse();

            $question->setStatus('active');

            expect($question->hasStatus('active'))->toBeTrue();
        });

        it('activates a district record', function () {
            $division = Division::factory()->create();
            $district = District::factory()->create(['division_id' => $division->id]);

            expect($district->hasStatus('active'))->toBeFalse();

            $district->setStatus('active');

            expect($district->hasStatus('active'))->toBeTrue();
        });

        it('activates a division record', function () {
            $division = Division::factory()->create();

            expect($division->hasStatus('active'))->toBeFalse();

            $division->setStatus('active');

            expect($division->hasStatus('active'))->toBeTrue();
        });

        it('activates a university record', function () {
            $university = University::factory()->create();

            expect($university->hasStatus('active'))->toBeFalse();

            $university->setStatus('active');

            expect($university->hasStatus('active'))->toBeTrue();
        });

        it('activates a site record', function () {
            $site = Site::factory()->create();

            expect($site->hasStatus('active'))->toBeFalse();

            $site->setStatus('active');

            expect($site->hasStatus('active'))->toBeTrue();
        });

        it('activates a type record', function () {
            $exam = Exam::factory()->create();
            $type = Type::factory()->create(['exam_id' => $exam->id]);

            expect($type->hasStatus('active'))->toBeFalse();

            $type->setStatus('active');

            expect($type->hasStatus('active'))->toBeTrue();
        });

        it('activates an answer record', function () {
            $question = Question::factory()->create();
            $answer = Answer::factory()->create(['question_id' => $question->id]);

            expect($answer->hasStatus('active'))->toBeFalse();

            $answer->setStatus('active');

            expect($answer->hasStatus('active'))->toBeTrue();
        });
    });

    describe('DeactivateRecordAction', function () {
        it('deactivates a user record', function () {
            $user = User::factory()->create();
            $user->setStatus('active');

            expect($user->hasStatus('active'))->toBeTrue();

            $user->deleteStatus('active');

            expect($user->hasStatus('active'))->toBeFalse();
        });

        it('deactivates an exam record', function () {
            $exam = Exam::factory()->create();
            $exam->setStatus('active');

            expect($exam->hasStatus('active'))->toBeTrue();

            $exam->deleteStatus('active');

            expect($exam->hasStatus('active'))->toBeFalse();
        });

        it('deactivates a question record', function () {
            $question = Question::factory()->create();
            $question->setStatus('active');

            expect($question->hasStatus('active'))->toBeTrue();

            $question->deleteStatus('active');

            expect($question->hasStatus('active'))->toBeFalse();
        });

        it('deactivates a district record', function () {
            $division = Division::factory()->create();
            $district = District::factory()->create(['division_id' => $division->id]);
            $district->setStatus('active');

            expect($district->hasStatus('active'))->toBeTrue();

            $district->deleteStatus('active');

            expect($district->hasStatus('active'))->toBeFalse();
        });

        it('deactivates a division record', function () {
            $division = Division::factory()->create();
            $division->setStatus('active');

            expect($division->hasStatus('active'))->toBeTrue();

            $division->deleteStatus('active');

            expect($division->hasStatus('active'))->toBeFalse();
        });

        it('deactivates a university record', function () {
            $university = University::factory()->create();
            $university->setStatus('active');

            expect($university->hasStatus('active'))->toBeTrue();

            $university->deleteStatus('active');

            expect($university->hasStatus('active'))->toBeFalse();
        });

        it('deactivates a site record', function () {
            $site = Site::factory()->create();
            $site->setStatus('active');

            expect($site->hasStatus('active'))->toBeTrue();

            $site->deleteStatus('active');

            expect($site->hasStatus('active'))->toBeFalse();
        });

        it('deactivates a type record', function () {
            $exam = Exam::factory()->create();
            $type = Type::factory()->create(['exam_id' => $exam->id]);
            $type->setStatus('active');

            expect($type->hasStatus('active'))->toBeTrue();

            $type->deleteStatus('active');

            expect($type->hasStatus('active'))->toBeFalse();
        });

        it('deactivates an answer record', function () {
            $question = Question::factory()->create();
            $answer = Answer::factory()->create(['question_id' => $question->id]);
            $answer->setStatus('active');

            expect($answer->hasStatus('active'))->toBeTrue();

            $answer->deleteStatus('active');

            expect($answer->hasStatus('active'))->toBeFalse();
        });
    });

    describe('Action Classes', function () {
        it('ActivateRecordAction exists and is callable', function () {
            $action = ActivateRecordAction::make();

            expect($action)->toBeObject();
            expect($action->getName())->toBe('activate');
        });

        it('DeactivateRecordAction exists and is callable', function () {
            $action = DeactivateRecordAction::make();

            expect($action)->toBeObject();
            expect($action->getName())->toBe('deactivate');
        });
    });
});
