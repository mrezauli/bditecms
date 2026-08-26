<?php

namespace App\Services;

readonly class ExamineeResolution
{
    public function __construct(
        public string $status,
        public ?string $message = null,
        public ?string $passedSession = null,
        public ?int $remainingTypeId = null,
        public ?string $remainingTypeName = null,
        public ?string $name = null,
    ) {}
}
