<?php

namespace App\Filament\Resources\KodeTemuans;

use App\Filament\Resources\KodeTemuans\Pages\CreateKodeTemuan;
use App\Filament\Resources\KodeTemuans\Pages\EditKodeTemuan;
use App\Filament\Resources\KodeTemuans\Pages\ListKodeTemuans;
use App\Filament\Resources\KodeTemuans\Pages\ViewKodeTemuan;
use App\Filament\Resources\KodeTemuans\Schemas\KodeTemuanForm;
use App\Filament\Resources\KodeTemuans\Schemas\KodeTemuanInfolist;
use App\Filament\Resources\KodeTemuans\Tables\KodeTemuansTable;
use App\Models\KodeTemuan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KodeTemuanResource extends Resource
{
    protected static ?string $model = KodeTemuan::class;

    protected static string|BackedEnum|null $navigationIcon =Heroicon::OutlinedTag;
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Kode Temuan';
    
    protected static ?string $recordTitleAttribute = 'Kode Temuan';

    public static function form(Schema $schema): Schema
    {
        return KodeTemuanForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return KodeTemuanInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KodeTemuansTable::configure($table);
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
            'index' => ListKodeTemuans::route('/'),
            'create' => CreateKodeTemuan::route('/create'),
            'view' => ViewKodeTemuan::route('/{record}'),
            'edit' => EditKodeTemuan::route('/{record}/edit'),
        ];
    }
}
