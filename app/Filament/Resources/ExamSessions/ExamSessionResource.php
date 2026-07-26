<?php

namespace App\Filament\Resources\ExamSessions;

use App\Filament\Resources\ExamSessions\Pages\CreateExamSession;
use App\Filament\Resources\ExamSessions\Pages\EditExamSession;
use App\Filament\Resources\ExamSessions\Pages\ListExamSessions;
use App\Filament\Resources\ExamSessions\Pages\ViewExamSession;
use App\Filament\Resources\ExamSessions\Schemas\ExamSessionForm;
use App\Filament\Resources\ExamSessions\Schemas\ExamSessionInfolist;
use App\Filament\Resources\ExamSessions\Tables\ExamSessionsTable;
use App\Models\ExamSession;
use BackedEnum;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class ExamSessionResource extends Resource
{
    protected static ?string $model = ExamSession::class;

    protected static string|UnitEnum|null $navigationGroup = 'Exam Sessions';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    public static function form(Schema $schema): Schema
    {
        return ExamSessionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ExamSessionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExamSessionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListExamSessions::route('/'),
            'create' => CreateExamSession::route('/create'),
            'view' => ViewExamSession::route('/{record}'),
            'edit' => EditExamSession::route('/{record}/edit'),
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
            ViewExamSession::class,
            EditExamSession::class,
        ]);
    }
}
