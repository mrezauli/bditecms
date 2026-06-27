<?php

namespace App\Filament\Resources\Enrollments\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EnrollmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('exam_id')
                    ->required()
                    ->numeric(),
                TextInput::make('type_id')
                    ->required()
                    ->numeric(),
                TextInput::make('site_id')
                    ->required()
                    ->numeric(),
                TextInput::make('first_answer_id')
                    ->required()
                    ->numeric(),
                TextInput::make('second_answer_id')
                    ->required()
                    ->numeric(),
                TextInput::make('third_answer_id')
                    ->required()
                    ->numeric(),
                TextInput::make('fourth_answer_id')
                    ->required()
                    ->numeric(),
                TextInput::make('fifth_answer_id')
                    ->required()
                    ->numeric(),
                TextInput::make('sixth_answer_id')
                    ->required()
                    ->numeric(),
                TextInput::make('seventh_answer_id')
                    ->required()
                    ->numeric(),
                TextInput::make('eighth_answer_id')
                    ->required()
                    ->numeric(),
                TextInput::make('ninth_answer_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
