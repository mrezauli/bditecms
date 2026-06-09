<?php

use App\Enums\RoleEnum;
use App\Filament\Resources\Types\Pages\EditType;
use App\Filament\Resources\Types\Pages\ViewType;
use App\Models\Exam;
use App\Models\Type;
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

test('type view page loads with sectioned schema state', function () {
    $exam = Exam::factory()->create();
    $type = Type::factory()->create([
        'exam_id' => $exam->id,
    ]);

    $component = Livewire::test(ViewType::class, ['record' => $type->id])
        ->assertOk()
        ->assertSchemaStateSet([
            'name' => $type->name,
            'exam.name' => $exam->name,
        ]);

    expect(collect($component->instance()->getSubNavigation())->map->getLabel()->all())
        ->toBe(['View', 'Edit']);
});

test('type edit page loads', function () {
    $exam = Exam::factory()->create();
    $type = Type::factory()->create([
        'exam_id' => $exam->id,
    ]);

    Livewire::test(EditType::class, ['record' => $type->id])
        ->assertOk();
});
