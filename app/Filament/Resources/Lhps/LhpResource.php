<?php

namespace App\Filament\Resources\Lhps;

use App\Filament\Resources\Lhps\Pages\CreateLhp;
use App\Filament\Resources\Lhps\Pages\EditLhp;
use App\Filament\Resources\Lhps\Pages\ListLhps;
use App\Filament\Resources\Lhps\Pages\ViewLhp;
use App\Filament\Resources\Lhps\Schemas\LhpForm;
use App\Filament\Resources\Lhps\Schemas\LhpInfolist;
use App\Filament\Resources\Lhps\Tables\LhpsTable;
use App\Models\Lhp;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LhpResource extends Resource
{
    protected static ?string $model = Lhp::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationLabel = 'LHP';
    protected static ?string $recordTitleAttribute = 'Lhp';

    public static function form(Schema $schema): Schema
    {
        return LhpForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LhpInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LhpsTable::configure($table);
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
            'index' => ListLhps::route('/'),
            'create' => CreateLhp::route('/create'),
            'view' => ViewLhp::route('/{record}'),
            'edit' => EditLhp::route('/{record}/edit'),
        ];
    }
}
