<?php

namespace App\Filament\Resources\LaporanRekomendasis;

use App\Filament\Resources\LaporanRekomendasis\Pages\CreateLaporanRekomendasi;
use App\Filament\Resources\LaporanRekomendasis\Pages\EditLaporanRekomendasi;
use App\Filament\Resources\LaporanRekomendasis\Pages\ListLaporanRekomendasis;
use App\Filament\Resources\LaporanRekomendasis\Schemas\LaporanRekomendasiForm;
use App\Filament\Resources\LaporanRekomendasis\Tables\LaporanRekomendasisTable;
use App\Models\Recommendations;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LaporanRekomendasiResource extends Resource


{
    protected static ?string $model = Recommendations::class;
    protected static ?int $navigationSort = 7;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentCheck;
    protected static ?string $navigationLabel = 'Laporan Recommendations';
   

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
            'edit' => EditLaporanRekomendasi::route('/{record}/edit'),
        ];
    }
}
