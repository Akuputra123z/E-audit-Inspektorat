<?php

namespace App\Filament\Resources\UnitDiperiksas\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class UnitDiperiksaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_unit')
                ->label('Nama Unit')
                ->required(),

            Select::make('kategori')
                ->options([
                    'OPD' => 'OPD',
                    'Desa' => 'Desa',
                    'BUMD' => 'BUMD',
                    'Sekolah_SMP' => 'Sekolah SMP',
                    'Sekolah_SMA' => 'Sekolah SMA',
                    'Sekolah_TK' => 'Sekolah TK',
                ])
                ->searchable()
                ->required(),
                Select::make('nama_kecamatan') 
                ->label('Nama Kecamatan') 
                ->options([ 
                    'Sumber' => 'Kecamatan Sumber', 
                    'Bulu' => 'Kecamatan Bulu', 
                    'Gunem' => 'Kecamatan Gunem', 
                    'Sale' => 'Kecamatan Sale', 
                    'Sarang' => 'Kecamatan Sarang', 
                    'Sedan' => 'Kecamatan Sedan', 
                    'Pamotan' => 'Kecamatan Pamotan', 
                    'Sulang' => 'Kecamatan Sulang', 
                    'Kaliori' => 'Kecamatan Kaliori', 
                    'Rembang' => 'Kecamatan Rembang',
                    'Pancur' => 'Kecamatan Pancur',
                    'Kragan' => 'Kecamatan Kragan', 
                    'Sluke' => 'Kecamatan Sluke', 
                    'Lasem' => 'Kecamatan Lasem', 
                    ]) 
                    ->searchable() 
                    ->required(),
            ]);
    }
}
