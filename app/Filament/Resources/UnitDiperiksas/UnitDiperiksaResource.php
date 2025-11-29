<?php

namespace App\Filament\Resources\UnitDiperiksas;

use App\Filament\Resources\UnitDiperiksas\Pages\CreateUnitDiperiksa;
use App\Filament\Resources\UnitDiperiksas\Pages\EditUnitDiperiksa;
use App\Filament\Resources\UnitDiperiksas\Pages\ListUnitDiperiksas;
use App\Filament\Resources\UnitDiperiksas\Schemas\UnitDiperiksaForm;
use App\Filament\Resources\UnitDiperiksas\Tables\UnitDiperiksasTable;
use App\Models\UnitDiperiksa;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UnitDiperiksaResource extends Resource
{
    protected static ?string $model = UnitDiperiksa::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Unit Diperiksa';

    protected static ?string $recordTitleAttribute = 'UnitDiperiksa';

    public static function form(Schema $schema): Schema
    {
        return UnitDiperiksaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UnitDiperiksasTable::configure($table);
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
            'index' => ListUnitDiperiksas::route('/'),
            'create' => CreateUnitDiperiksa::route('/create'),
            'edit' => EditUnitDiperiksa::route('/{record}/edit'),
        ];
    }
}
