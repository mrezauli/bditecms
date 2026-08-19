<?php

namespace App\Filament\Resources\Intakes;

use App\Filament\Resources\Intakes\Pages\CreateIntake;
use App\Filament\Resources\Intakes\Pages\EditIntake;
use App\Filament\Resources\Intakes\Pages\ListIntakes;
use App\Filament\Resources\Intakes\Pages\ViewIntake;
use App\Filament\Resources\Intakes\Schemas\IntakeForm;
use App\Filament\Resources\Intakes\Schemas\IntakeInfolist;
use App\Filament\Resources\Intakes\Tables\IntakesTable;
use App\Models\Intake;
use BackedEnum;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class IntakeResource extends Resource
{
    protected static ?string $model = Intake::class;

    protected static string|UnitEnum|null $navigationGroup = 'Portal Metadata';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    public static function form(Schema $schema): Schema
    {
        return IntakeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return IntakeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return IntakesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListIntakes::route('/'),
            'create' => CreateIntake::route('/create'),
            'view' => ViewIntake::route('/{record}'),
            'edit' => EditIntake::route('/{record}/edit'),
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
            ViewIntake::class,
            EditIntake::class,
        ]);
    }
}
