<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\ExamineeResolver;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExamineeController extends Controller
{
    public function __construct(private readonly ExamineeResolver $examineeResolver) {}

    public function validate(Request $request): JsonResponse
    {
        $data = $request->validate([
            'examinee_id' => ['required', 'string', 'max:255'],
        ]);

        $resolution = $this->examineeResolver->resolve($data['examinee_id']);

        return response()->json([
            'status' => $resolution->status,
            'type_id' => $resolution->remainingTypeId,
            'type_name' => $resolution->remainingTypeName,
            'name' => $resolution->name,
            'message' => $resolution->message,
        ]);
    }
}
