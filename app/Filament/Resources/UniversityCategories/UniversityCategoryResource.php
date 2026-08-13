<?php

namespace App\Filament\Resources\UniversityCategories;

use App\Filament\Resources\UniversityCategories\Pages\CreateUniversityCategory;
use App\Filament\Resources\UniversityCategories\Pages\EditUniversityCategory;
use App\Filament\Resources\UniversityCategories\Pages\ListUniversityCategories;
use App\Filament\Resources\UniversityCategories\Pages\ViewUniversityCategory;
use App\Filament\Resources\UniversityCategories\Schemas\UniversityCategoryForm;
use App\Filament\Resources\UniversityCategories\Schemas\UniversityCategoryInfolist;
use App\Filament\Resources\UniversityCategories\Tables\UniversityCategoriesTable;
use App\Models\UniversityCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class UniversityCategoryResource extends Resource
{
    protected static ?string $model = UniversityCategory::class;

    protected static string|UnitEnum|null $navigationGroup = 'Exam Metadata';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ClipboardDocumentList;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return UniversityCategoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UniversityCategoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UniversityCategoriesTable::configure($table);
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
            'index' => ListUniversityCategories::route('/'),
            'create' => CreateUniversityCategory::route('/create'),
            'view' => ViewUniversityCategory::route('/{record}'),
            'edit' => EditUniversityCategory::route('/{record}/edit'),
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
