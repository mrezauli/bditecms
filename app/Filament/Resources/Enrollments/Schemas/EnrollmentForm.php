<?php

namespace App\Filament\Resources\Enrollments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class EnrollmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('exam_id')
                    ->relationship('exam', 'acronym')
                    ->required(),
                Select::make('type_id')
                    ->relationship('type', 'name')
                    ->required(),
                Select::make('site_id')
                    ->relationship('site', 'name')
                    ->required(),
                Select::make('first_answer_id')
                    ->relationship('firstAnswer', 'label')
                    ->required(),
                Select::make('second_answer_id')
                    ->relationship('secondAnswer', 'label')
                    ->required(),
                Select::make('third_answer_id')
                    ->relationship('thirdAnswer', 'label')
                    ->required(),
                Select::make('fourth_answer_id')
                    ->relationship('fourthAnswer', 'label')
                    ->required(),
                Select::make('fifth_answer_id')
                    ->relationship('fifthAnswer', 'label')
                    ->required(),
                Select::make('sixth_answer_id')
                    ->relationship('sixthAnswer', 'label')
                    ->required(),
                Select::make('seventh_answer_id')
                    ->relationship('seventhAnswer', 'label')
                    ->required(),
                Select::make('eighth_answer_id')
                    ->relationship('eighthAnswer', 'label')
                    ->required(),
                Select::make('ninth_answer_id')
                    ->relationship('ninthAnswer', 'label')
                    ->required(),
            ]);
    }
}
