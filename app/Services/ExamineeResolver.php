<?php

namespace App\Services;

use App\Models\Exam;
use App\Models\HalfPasser;
use App\Models\Type;

class ExamineeResolver
{
    /**
     * Resolve an FE examinee ID against the half passers register only.
     *
     * A candidate who passed a single session may register for the remaining
     * session only; passing both disqualifies them entirely.
     */
    public function resolve(string $examineeId, ?int $intakeId = null): ExamineeResolution
    {
        $records = HalfPasser::query()
            ->where('examinee_no', $examineeId)
            ->when($intakeId, fn ($q) => $q->where('intake_id', $intakeId))
            ->with('type')
            ->get();

        if ($records->isEmpty()) {
            return new ExamineeResolution('invalid', __('Invalid ID.'));
        }

        $passedAm = $records->contains(fn (HalfPasser $r) => $r->type?->name === 'FE: Morning (AM) Exam');
        $passedPm = $records->contains(fn (HalfPasser $r) => $r->type?->name === 'FE: Afternoon (PM) Exam');

        if ($passedAm && $passedPm) {
            return new ExamineeResolution(
                'both_passed',
                __('You should not register because you are already passed.'),
            );
        }

        $feExamId = Exam::where('acronym', 'FE')->value('id');
        $remainingTypeName = $passedAm ? 'FE: Afternoon (PM) Exam' : 'FE: Morning (AM) Exam';
        $passedSession = $passedAm ? 'AM' : 'PM';

        return new ExamineeResolution(
            status: 'valid',
            message: __('You passed in :exam exam so you can only participate in :other exam.', [
                'exam' => $passedSession,
                'other' => $passedSession === 'AM' ? 'PM' : 'AM',
            ]),
            passedSession: $passedSession,
            remainingTypeId: Type::query()
                ->where('exam_id', $feExamId)
                ->where('name', $remainingTypeName)
                ->value('id'),
            remainingTypeName: $remainingTypeName,
            name: $records->firstWhere('name')?->name,
        );
    }
}
