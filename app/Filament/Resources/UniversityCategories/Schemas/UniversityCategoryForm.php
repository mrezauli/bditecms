<?php

namespace App\Filament\Resources\UniversityCategories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UniversityCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
            ]);
    }
}
