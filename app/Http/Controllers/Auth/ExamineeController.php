<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\HalfPasser;
use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExamineeController extends Controller
{
    public function validate(Request $request): JsonResponse
    {
        $data = $request->validate([
            'examinee_id' => ['required', 'string', 'max:255'],
            'exam_id' => ['required', 'integer', 'exists:exams,id'],
        ]);

        $feExamId = Exam::where('acronym', 'FE')->value('id');

        if ((int) $data['exam_id'] !== $feExamId) {
            return response()->json([
                'status' => 'invalid',
                'message' => __('Invalid exam selection.'),
            ]);
        }

        $foundInAm = Enrollment::where('am_exam', $data['examinee_id'])->exists();
        $foundInPm = Enrollment::where('pm_exam', $data['examinee_id'])->exists();

        if ($foundInAm && $foundInPm) {
            return response()->json([
                'status' => 'both_passed',
                'message' => __('You should not register because you are already passed.'),
            ]);
        }

        if ($foundInAm || $foundInPm) {
            $passedExam = $foundInAm ? 'AM' : 'PM';
            $otherExam = $foundInAm ? 'PM' : 'AM';

            $typeId = $foundInAm
                ? Type::where('exam_id', $feExamId)->where('name', 'Afternoon Exam')->value('id')
                : Type::where('exam_id', $feExamId)->where('name', 'Morning Exam')->value('id');

            $halfPasser = HalfPasser::where('examinee_no', $data['examinee_id'])->first();

            return response()->json([
                'status' => 'valid',
                'type_id' => $typeId,
                'name' => $halfPasser?->name,
                'message' => __('You passed in :exam exam so you can only participate in :other exam.', [
                    'exam' => $passedExam,
                    'other' => $otherExam,
                ]),
            ]);
        }

        $halfPassers = HalfPasser::where('examinee_no', $data['examinee_id'])->get();

        if ($halfPassers->count() === 2) {
            return response()->json([
                'status' => 'both_passed',
                'message' => __('You should not register because you are already passed.'),
            ]);
        }

        if ($halfPassers->isNotEmpty()) {
            $halfPasser = $halfPassers->first();
            $typeId = $halfPasser->exam_type === 'Morning Exam'
                ? Type::where('exam_id', $feExamId)->where('name', 'Afternoon Exam')->value('id')
                : Type::where('exam_id', $feExamId)->where('name', 'Morning Exam')->value('id');

            return response()->json([
                'status' => 'valid',
                'type_id' => $typeId,
                'name' => $halfPasser->name,
                'message' => __('You passed in :exam so you can only participate in :other.', [
                    'exam' => $halfPasser->exam_type,
                    'other' => $halfPasser->exam_type === 'Morning Exam' ? 'Afternoon Exam' : 'Morning Exam',
                ]),
            ]);
        }

        return response()->json([
            'status' => 'invalid',
            'message' => __('Invalid ID.'),
        ]);
    }
}
