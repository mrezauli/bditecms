<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\District;
use App\Models\Exam;
use App\Models\Gender;
use App\Models\Intake;
use App\Models\Question;
use App\Models\Site;
use App\Models\Type;
use App\Models\University;
use App\Services\ExamineeResolver;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegisterPreviewController extends Controller
{
    public function preview(Request $request): RedirectResponse
    {
        $input = $request->all();

        // Reuse the same validation logic as CreateNewUser without persisting.
        // We instantiate a temporary validator via CreateNewUser's internal flow
        // by running its registrationRules and examineeResolver checks manually
        // but simpler: attempt to validate via a dedicated preview validator.
        // For now, we validate using CreateNewUser's rules by triggering its
        // validator path via a dummy transaction rollback.

        $previewValidator = $this->validateForPreview($input);

        if ($previewValidator->fails()) {
            return redirect()->route('register')
                ->withErrors($previewValidator)
                ->withInput();
        }

        $validated = $previewValidator->validated();

        // Preserve raw password for final creation (not shown in preview)
        $validated['password'] = $input['password'];
        $validated['password_confirmation'] = $input['password_confirmation'];
        $validated['name'] = $input['name'] ?? $validated['name'] ?? null;
        $validated['email'] = $input['email'] ?? $validated['email'] ?? null;

        // Keep examinee-related fields as user typed (already normalized in validator)
        foreach (['exam_id', 'site_id', 'type_id', 'passed_before', 'examinee_id'] as $key) {
            if (array_key_exists($key, $input)) {
                $validated[$key] = $input[$key];
            }
        }

        // Normalize type_id for FE no -> Both case (mirrors CreateNewUser)
        $feExamId = Exam::where('acronym', 'FE')->value('id');
        $isFe = (int) ($validated['exam_id'] ?? 0) === (int) $feExamId;
        if ($isFe && ($validated['passed_before'] ?? null) === 'no') {
            $bothTypeId = Type::where('exam_id', $feExamId)
                ->where('name', 'FE: Both - Morning (AM) & Afternoon (PM) Exam')
                ->value('id');
            $validated['type_id'] = $bothTypeId;
        }

        // Keep all answer fields and personal fields
        foreach (['first_answer_id', 'second_answer_id', 'third_answer_id', 'fourth_answer_id', 'fifth_answer_id', 'sixth_answer_id', 'seventh_answer_id', 'eighth_answer_id', 'ninth_answer_id', 'date_of_birth', 'gender_id', 'occupation', 'mobile_number', 'post_code', 'district_id', 'university_id', 'other_university_name', 'present_address', 'work_address'] as $key) {
            if (array_key_exists($key, $input)) {
                $validated[$key] = $input[$key];
            }
        }

        $request->session()->put('registration_preview', $validated);
        $request->session()->put('registration_preview_display', $this->buildDisplayData($validated));

        return redirect()->route('register.preview.show');
    }

    public function show(Request $request): View|RedirectResponse
    {
        $display = $request->session()->get('registration_preview_display');
        $validated = $request->session()->get('registration_preview');

        if (! $display || ! $validated) {
            return redirect()->route('register');
        }

        return view('livewire.auth.register-preview', [
            'display' => $display,
        ]);
    }

    public function confirm(Request $request): RedirectResponse
    {
        $validated = $request->session()->get('registration_preview');

        if (! $validated) {
            return redirect()->route('register')
                ->with('error', __('Session expired. Please fill the form again.'));
        }

        // Delegate to actual creation (re-validates and persists)
        $creator = app(CreateNewUser::class);
        $user = $creator->create($validated);

        $request->session()->forget(['registration_preview', 'registration_preview_display']);

        Auth::login($user);

        return redirect()->intended(config('fortify.home', '/dashboard'));
    }

    public function back(Request $request): RedirectResponse
    {
        $validated = $request->session()->get('registration_preview');

        if (! $validated) {
            return redirect()->route('register');
        }

        return redirect()->route('register')
            ->withInput($validated);
    }

    /**
     * Build display data for preview (text only, no form elements).
     *
     * @return array<string, mixed>
     */
    private function buildDisplayData(array $validated): array
    {
        $exam = isset($validated['exam_id']) ? Exam::find($validated['exam_id']) : null;
        $site = isset($validated['site_id']) ? Site::find($validated['site_id']) : null;
        $type = isset($validated['type_id']) && $validated['type_id'] ? Type::find($validated['type_id']) : null;
        $gender = isset($validated['gender_id']) ? Gender::find($validated['gender_id']) : null;
        $district = isset($validated['district_id']) ? District::find($validated['district_id']) : null;
        $university = null;
        if (isset($validated['university_id']) && $validated['university_id'] !== 'other' && $validated['university_id']) {
            $university = University::find($validated['university_id']);
        }

        $intake = null;
        if (isset($validated['exam_id'])) {
            $intake = Intake::where('exam_id', $validated['exam_id'])->get()->first(fn (Intake $i) => $i->isRegistrationOpen());
        }

        $questions = Question::currentStatus('active')->orderBy('label')->get()->keyBy('id');
        // Need mapping of answer fields to question
        $orderedQuestions = Question::currentStatus('active')->orderBy('label')->get();
        $answerFields = ['first_answer_id', 'second_answer_id', 'third_answer_id', 'fourth_answer_id', 'fifth_answer_id', 'sixth_answer_id', 'seventh_answer_id', 'eighth_answer_id', 'ninth_answer_id'];
        $qa = [];
        foreach ($answerFields as $idx => $field) {
            $question = $orderedQuestions[$idx] ?? null;
            $answerId = $validated[$field] ?? null;
            $answer = $answerId ? Answer::find($answerId) : null;
            if ($question) {
                $qa[] = [
                    'label' => $question->label,
                    'question' => $question->content,
                    'answer' => $answer?->content ?? '—',
                ];
            }
        }

        return [
            'account' => [
                'name' => $validated['name'] ?? '—',
                'email' => $validated['email'] ?? '—',
                // never show raw password
                'password' => '••••••••',
            ],
            'exam' => [
                'exam' => $exam ? $exam->label : '—',
                'site' => $site?->name ?? '—',
                'type' => $type?->name ?? ($exam && $exam->acronym === 'IP' ? __('N/A (IP)') : '—'),
                'passed_before' => $validated['passed_before'] ?? '—',
                'examinee_id' => $validated['examinee_id'] ?? '—',
                'intake' => $intake ? $intake->name.' ('.$intake->exam_date->format('d F Y').')' : '—',
            ],
            'questions' => $qa,
            'personal' => [
                'date_of_birth' => $validated['date_of_birth'] ?? '—',
                'gender' => $gender?->name ?? '—',
                'occupation' => $validated['occupation'] ?? '—',
                'mobile_number' => isset($validated['mobile_number']) ? '+8801'.($validated['mobile_number']) : '—',
                'post_code' => $validated['post_code'] ?? '—',
                'district' => $district?->name ?? '—',
                'university' => $validated['university_id'] === 'other' ? ($validated['other_university_name'] ?? '—').' ('.__('Not Listed').')' : ($university?->label ?? '—'),
                'present_address' => $validated['present_address'] ?? '—',
                'work_address' => $validated['work_address'] ?? '—',
            ],
        ];
    }

    private function validateForPreview(array $input): Validator
    {
        // Mirror CreateNewUser::create validation without DB write
        $creator = app(CreateNewUser::class);

        // Use reflection to access protected registrationRules
        $ref = new \ReflectionClass($creator);
        $method = $ref->getMethod('registrationRules');
        $method->setAccessible(true);
        $rules = $method->invoke($creator);

        // University handling
        if (($input['university_id'] ?? null) === 'other') {
            $rules['university_id'] = ['nullable', 'string'];
            $rules['other_university_name'] = ['required', 'string', 'max:255'];
        } else {
            $rules['university_id'] = ['required', Rule::exists(University::class, 'id')];
            $rules['other_university_name'] = ['nullable', 'string', 'max:255'];
        }

        $feExamId = Exam::where('acronym', 'FE')->value('id');
        $isFe = (int) ($input['exam_id'] ?? 0) === (int) $feExamId;

        $rules['type_id'] = $isFe
            ? ['required', Rule::exists(Type::class, 'id')->where('exam_id', $feExamId)]
            : ['nullable'];

        if ($isFe) {
            $rules['passed_before'] = ['required', Rule::in(['yes', 'no'])];
            $rules['examinee_id'] = match (($input['passed_before'] ?? null)) {
                'yes' => ['required', 'string', 'max:255'],
                default => ['nullable'],
            };
        }

        // For preview, normalize type_id for 'no' case before validation (same as creator)
        if ($isFe && ($input['passed_before'] ?? null) === 'no') {
            $bothTypeId = Type::where('exam_id', $feExamId)
                ->where('name', 'FE: Both - Morning (AM) & Afternoon (PM) Exam')
                ->value('id');
            $input['type_id'] = $bothTypeId;
        }

        $validator = \Illuminate\Support\Facades\Validator::make($input, $rules);

        $intake = null;
        if (isset($input['exam_id'])) {
            $intake = Intake::where('exam_id', $input['exam_id'])->get()->first(fn (Intake $i) => $i->isRegistrationOpen());
            if (! $intake) {
                $exam = Exam::find($input['exam_id']);
                $validator->after(fn ($v) => $v->errors()->add('exam_id', __('Registration is not open for :exam at this time.', ['exam' => $exam?->name ?? 'this exam'])));
            }
        }

        if ($isFe && ($input['passed_before'] ?? null) === 'yes') {
            $resolver = app(ExamineeResolver::class);
            $resolution = $resolver->resolve($input['examinee_id'] ?? '');
            match ($resolution->status) {
                'both_passed' => $validator->after(fn ($v) => $v->errors()->add('examinee_id', __('You should not register because you are already passed.'))),
                'invalid' => $validator->after(fn ($v) => $v->errors()->add('examinee_id', __('Invalid ID.'))),
                'valid' => match (true) {
                    (int) ($input['type_id'] ?? 0) !== (int) $resolution->remainingTypeId => $validator->after(fn ($v) => $v->errors()->add('type_id', __('You passed in :exam exam so you can only participate in :other exam.', ['exam' => $resolution->passedSession === 'AM' ? 'AM' : 'PM', 'other' => $resolution->remainingTypeName]))),
                    $resolution->name !== null && trim((string) ($input['name'] ?? '')) !== $resolution->name => $validator->after(fn ($v) => $v->errors()->add('name', __('The name must match the name registered for this examinee ID.'))),
                    default => null,
                },
                default => null,
            };
        }

        // Trigger after callbacks
        $validator->passes();

        return $validator;
    }
}
