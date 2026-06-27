<?php

namespace App\Filament\Resources\Universities\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UniversityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('acronym')
                    ->required(),
                TextInput::make('website')
                    ->url()
                    ->required(),
                Select::make('university_category_id')
                    ->relationship('universityCategory', 'name')
                    ->required(),
            ]);
    }
}
