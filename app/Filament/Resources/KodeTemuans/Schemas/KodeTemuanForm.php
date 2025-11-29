<?php

namespace App\Filament\Resources\KodeTemuans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class KodeTemuanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode')
                    ->required(),
                TextInput::make('kelompok'),
                TextInput::make('sub_kelompok'),
                Textarea::make('deskripsi')
                    ->columnSpanFull(),
            ]);
    }
}
