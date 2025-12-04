<?php

namespace App\Filament\Resources\LaporanRekomendasis;

use App\Filament\Resources\LaporanRekomendasis\Pages\CreateLaporanRekomendasi;
use App\Filament\Resources\LaporanRekomendasis\Pages\EditLaporanRekomendasi;
use App\Filament\Resources\LaporanRekomendasis\Pages\ListLaporanRekomendasis;
use App\Filament\Resources\LaporanRekomendasis\Schemas\LaporanRekomendasiForm;
use App\Filament\Resources\LaporanRekomendasis\Tables\LaporanRekomendasisTable;
use App\Filament\Resources\LaporanRekomendasis\Pages\ViewLaporanRekomendasis;

use App\Models\Recommendations;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LaporanRekomendasiResource extends Resource


{
    protected static ?string $model = Recommendations::class;
    protected static ?int $navigationSort = 7;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentArrowDown;
    protected static ?string $navigationLabel = 'Laporan';
    protected static string | UnitEnum | null $navigationGroup = 'Laporan';



    protected static ?string $recordTitleAttribute = 'Laporan Rekomendasi';

    public static function form(Schema $schema): Schema
    {
        return LaporanRekomendasiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaporanRekomendasisTable::configure($table);
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
            'index' => ListLaporanRekomendasis::route('/'),
            'create' => CreateLaporanRekomendasi::route('/create'),
            // 'view' => ViewLaporanRekomendasis::route('/{record}'),
            // 'edit' => EditLaporanRekomendasi::route('/{record}/edit'),
        ];
    }
}
