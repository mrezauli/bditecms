<?php

namespace App\Filament\Resources\Universities\Schemas;

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
                TextInput::make('category')
                    ->required(),
            ]);
    }
}
