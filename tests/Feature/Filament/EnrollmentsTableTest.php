<?php

use App\Enums\RoleEnum;
use App\Filament\Resources\Enrollments\EnrollmentResource;
use App\Filament\Resources\Enrollments\Pages\ListEnrollments;
use App\Filament\Resources\Enrollments\Pages\ViewEnrollment;
use App\Models\Answer;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\Profile;
use App\Models\Question;
use App\Models\User;
use Filament\Facades\Filament;
use Livewire\Livewire;

beforeEach(function () {
    Filament::setCurrentPanel('super-admin');

    $this->actingAs(User::factory()->create([
        'email_verified_at' => now(),
        'role' => RoleEnum::SuperAdmin,
    ]));
});

function seedEnrollmentRow(): Enrollment
{
    $questions = collect(range(1, 9))->map(function (int $i) {
        $question = Question::factory()->create(['label' => 'Q'.$i]);
        $question->setStatus('active');

        return $question;
    });

    $answers = $questions->map(fn ($question) => Answer::factory()->for($question)->create(['label' => 'A']));

    $user = User::factory()->create(['email_verified_at' => now()]);
    Profile::factory()->create(['user_id' => $user->id]);

    $enrollment = Enrollment::factory()->create([
        'user_id' => $user->id,
        'first_answer_id' => $answers[0]->id,
        'second_answer_id' => $answers[1]->id,
        'third_answer_id' => $answers[2]->id,
        'fourth_answer_id' => $answers[3]->id,
        'fifth_answer_id' => $answers[4]->id,
        'sixth_answer_id' => $answers[5]->id,
        'seventh_answer_id' => $answers[6]->id,
        'eighth_answer_id' => $answers[7]->id,
        'ninth_answer_id' => $answers[8]->id,
    ]);

    Payment::create([
        'enrollment_id' => $enrollment->id,
        'user_id' => $user->id,
        'amount' => 500.00,
        'transaction_id' => 'TXN'.fake()->unique()->numerify('########'),
        'status' => 'Complete',
        'currency' => 'BDT',
    ]);

    return $enrollment->refresh();
}

test('enrollments list has advanced table export action', function () {
    Livewire::test(ListEnrollments::class)
        ->assertOk()
        ->assertTableHeaderActionsExistInOrder(['table-export']);
});

test('enrollments list truncates long text to three words with more link', function () {
    $enrollment = seedEnrollmentRow();

    $html = Livewire::test(ListEnrollments::class)->assertOk()->html();

    // Long type names are truncated (full label must not appear in the table).
    expect($html)->not->toContain($enrollment->type->name);

    // Truncated cell links to the view record.
    expect($html)->toContain(
        EnrollmentResource::getUrl('view', ['record' => $enrollment])
    );
});

test('enrollments list uses question labels as headers with answer labels per row', function () {
    seedEnrollmentRow();

    $html = Livewire::test(ListEnrollments::class)->assertOk()->html();

    expect($html)->toContain('Q1');
    expect($html)->toContain('Q9');
});

test('enrollments list shows profile and payment columns in serial', function () {
    $enrollment = seedEnrollmentRow();
    $enrollment->load(['user.profile.gender', 'user.profile.district', 'payment']);

    $html = Livewire::test(ListEnrollments::class)->assertOk()->html();

    expect($html)->toContain($enrollment->user->name);
    expect($html)->toContain($enrollment->user->email);
    expect($html)->toContain('01'.$enrollment->user->profile->mobile_number);
    expect($html)->toContain((string) $enrollment->user->profile->post_code);
    expect($html)->toContain($enrollment->user->profile->occupation);
    expect($html)->toContain($enrollment->payment->transaction_id);
    expect($html)->toContain('Complete');
});

test('enrollment view page shows full answer text and question', function () {
    $enrollment = seedEnrollmentRow();
    $enrollment->load(['firstAnswer.question']);

    $answer = $enrollment->firstAnswer;
    $question = $answer->question;

    Livewire::test(ViewEnrollment::class, ['record' => $enrollment->id])
        ->assertOk()
        ->assertSee($answer->content)
        ->assertSee($question->content);
});
