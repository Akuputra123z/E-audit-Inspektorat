<?php

namespace App\Filament\Resources\KodeRekomendasis\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class KodeRekomendasiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode')
                    ->required(),
                TextInput::make('kategori'),
                Textarea::make('deskripsi')
                    ->columnSpanFull(),
            ]);
    }
}
