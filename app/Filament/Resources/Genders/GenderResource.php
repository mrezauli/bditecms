<?php

namespace App\Filament\Resources\Genders;

use App\Filament\Resources\Genders\Pages\CreateGender;
use App\Filament\Resources\Genders\Pages\EditGender;
use App\Filament\Resources\Genders\Pages\ListGenders;
use App\Filament\Resources\Genders\Pages\ViewGender;
use App\Filament\Resources\Genders\Schemas\GenderForm;
use App\Filament\Resources\Genders\Schemas\GenderInfolist;
use App\Filament\Resources\Genders\Tables\GendersTable;
use App\Models\Gender;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class GenderResource extends Resource
{
    protected static ?string $model = Gender::class;

    protected static string|UnitEnum|null $navigationGroup = 'Portal Metadata';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Cube;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return GenderForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return GenderInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GendersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGenders::route('/'),
            'create' => CreateGender::route('/create'),
            'view' => ViewGender::route('/{record}'),
            'edit' => EditGender::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}