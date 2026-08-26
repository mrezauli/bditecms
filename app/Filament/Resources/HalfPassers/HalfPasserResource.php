<?php

namespace App\Filament\Resources\HalfPassers;

use App\Filament\Resources\HalfPassers\Pages\CreateHalfPasser;
use App\Filament\Resources\HalfPassers\Pages\EditHalfPasser;
use App\Filament\Resources\HalfPassers\Pages\ListHalfPassers;
use App\Filament\Resources\HalfPassers\Pages\ViewHalfPasser;
use App\Filament\Resources\HalfPassers\Schemas\HalfPasserForm;
use App\Filament\Resources\HalfPassers\Schemas\HalfPasserInfolist;
use App\Filament\Resources\HalfPassers\Tables\HalfPassersTable;
use App\Models\HalfPasser;
use BackedEnum;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class HalfPasserResource extends Resource
{
    protected static ?string $model = HalfPasser::class;

    protected static string|UnitEnum|null $navigationGroup = 'Exam Metadata';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static ?string $navigationLabel = 'Half Passers';

    public static function form(Schema $schema): Schema
    {
        return HalfPasserForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return HalfPasserInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HalfPassersTable::configure($table);
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
            'index' => ListHalfPassers::route('/'),
            'create' => CreateHalfPasser::route('/create'),
            'view' => ViewHalfPasser::route('/{record}'),
            'edit' => EditHalfPasser::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            ViewHalfPasser::class,
            EditHalfPasser::class,
        ]);
    }
}
