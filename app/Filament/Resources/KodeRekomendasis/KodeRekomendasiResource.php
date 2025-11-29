<?php

namespace App\Filament\Resources\KodeRekomendasis;

use App\Filament\Resources\KodeRekomendasis\Pages\CreateKodeRekomendasi;
use App\Filament\Resources\KodeRekomendasis\Pages\EditKodeRekomendasi;
use App\Filament\Resources\KodeRekomendasis\Pages\ListKodeRekomendasis;
use App\Filament\Resources\KodeRekomendasis\Pages\ViewKodeRekomendasi;
use App\Filament\Resources\KodeRekomendasis\Schemas\KodeRekomendasiForm;
use App\Filament\Resources\KodeRekomendasis\Schemas\KodeRekomendasiInfolist;
use App\Filament\Resources\KodeRekomendasis\Tables\KodeRekomendasisTable;
use App\Models\KodeRekomendasi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KodeRekomendasiResource extends Resource
{
    protected static ?string $model = KodeRekomendasi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedLightBulb;
    protected static ?string $navigationLabel = 'Kode Rekomendasi';


    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'Kode Rekomendasi';

    public static function form(Schema $schema): Schema
    {
        return KodeRekomendasiForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return KodeRekomendasiInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KodeRekomendasisTable::configure($table);
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
            'index' => ListKodeRekomendasis::route('/'),
            'create' => CreateKodeRekomendasi::route('/create'),
            'view' => ViewKodeRekomendasi::route('/{record}'),
            'edit' => EditKodeRekomendasi::route('/{record}/edit'),
        ];
    }
}
