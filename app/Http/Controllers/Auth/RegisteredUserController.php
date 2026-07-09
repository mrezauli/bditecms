<?php

namespace App\Http\Controllers\Auth;

use App\Models\Answer;
use App\Models\District;
use App\Models\Exam;
use App\Models\Gender;
use App\Models\Question;
use App\Models\Site;
use App\Models\Type;
use App\Models\University;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\RegisterViewResponse;
use Laravel\Fortify\Http\Controllers\RegisteredUserController as FortifyRegisteredUserController;

class RegisteredUserController extends FortifyRegisteredUserController
{
    public function create(Request $request): RegisterViewResponse
    {
        $questions = Question::currentStatus('active')->orderBy('label')->get();
        $answers = Answer::currentStatus('active')->with('question')->get()->groupBy('question_id');
        $exams = Exam::currentStatus('active')->orderBy('name')->get()->mapWithKeys(fn ($exam) => [$exam->id => $exam->label]);
        $types = Type::currentStatus('active')->orderBy('name')->get()->keyBy('id');
        $sites = Site::currentStatus('active')->orderBy('name')->pluck('name', 'id');
        $genders = Gender::currentStatus('active')->orderBy('name')->pluck('name', 'id');
        $districts = District::currentStatus('active')->orderBy('name')->pluck('name', 'id');
        $universities = University::currentStatus('active')->orderBy('name')->get()->mapWithKeys(fn ($u) => [$u->id => $u->label]);

        $feExamId = Exam::where('acronym', 'FE')->value('id');
        $feBothTypeId = Type::where('exam_id', $feExamId)->where('name', 'Both (FE: Morning & Afternoon Exam)')->value('id');
        $feMorningTypeId = Type::where('exam_id', $feExamId)->where('name', 'Morning Exam')->value('id');
        $feAfternoonTypeId = Type::where('exam_id', $feExamId)->where('name', 'Afternoon Exam')->value('id');

        return new class($questions, $answers, $exams, $types, $sites, $genders, $districts, $universities, $feExamId, $feBothTypeId, $feMorningTypeId, $feAfternoonTypeId) implements RegisterViewResponse
        {
            public function __construct(
                private $questions,
                private $answers,
                private $exams,
                private $types,
                private $sites,
                private $genders,
                private $districts,
                private $universities,
                private $feExamId,
                private $feBothTypeId,
                private $feMorningTypeId,
                private $feAfternoonTypeId,
            ) {}

            public function toResponse($request)
            {
                return view('livewire.auth.register', [
                    'questions' => $this->questions,
                    'answers' => $this->answers,
                    'exams' => $this->exams,
                    'types' => $this->types,
                    'sites' => $this->sites,
                    'genders' => $this->genders,
                    'districts' => $this->districts,
                    'universities' => $this->universities,
                    'feExamId' => $this->feExamId,
                    'feBothTypeId' => $this->feBothTypeId,
                    'feMorningTypeId' => $this->feMorningTypeId,
                    'feAfternoonTypeId' => $this->feAfternoonTypeId,
                ]);
            }
        };
    }
}
