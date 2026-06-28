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
        $questions = Question::orderBy('label')->get();
        $answers = Answer::with('question')->get()->groupBy('question_id');
        $exams = Exam::pluck('acronym', 'id');
        $types = Type::pluck('name', 'id');
        $sites = Site::pluck('name', 'id');
        $genders = Gender::pluck('name', 'id');
        $districts = District::with('division')->get()->mapWithKeys(fn ($d) => [$d->id => $d->name.' ('.$d->division->name.')']);
        $universities = University::pluck('acronym', 'id');

        return new class($questions, $answers, $exams, $types, $sites, $genders, $districts, $universities) implements RegisterViewResponse
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
                ]);
            }
        };
    }
}
