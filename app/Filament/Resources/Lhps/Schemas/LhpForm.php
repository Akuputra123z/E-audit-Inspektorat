<?php

namespace App\Filament\Resources\Lhps\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use App\Models\UnitDiperiksa;
use Filament\Forms\Get;


class LhpForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('nomor_lhp')
                    ->label('Nomor LHP')
                    ->required(),

                DatePicker::make('tanggal_lhp')
                    ->label('Tanggal LHP')
                    ->required(),

                /**
                 * ====================================
                 * NAMA KECAMATAN (ambil distinct)
                 * ====================================
                 */
                Select::make('nama_kecamatan')
                    ->label('Nama Kecamatan')
                    ->options(
                        UnitDiperiksa::select('nama_kecamatan')
                            ->distinct()
                            ->orderBy('nama_kecamatan')
                            ->pluck('nama_kecamatan', 'nama_kecamatan')
                    )
                    ->reactive()
                    ->required(),

                /**
                 * ====================================
                 * KATEGORI UNIT (ambil distinct)
                 * ====================================
                 */
                Select::make('kategori_unit')
                    ->label('Kategori Unit')
                    ->options(
                        UnitDiperiksa::select('kategori')
                            ->distinct()
                            ->orderBy('kategori')
                            ->pluck('kategori', 'kategori')
                    )
                    ->reactive()
                    ->required(),

                /**
                 * ==================================================
                 * UNIT DIPERIKSA (FILTER BY kategori + kecamatan)
                 * ==================================================
                 */
                Select::make('unit_id')
                ->label('Nama Unit')
                ->options(function (callable $get) {
                    $kategori  = $get('kategori_unit');
                    $kecamatan = $get('nama_kecamatan');

                    // jika belum ada filter lengkap, kembalikan kosong
                    if (empty($kategori) || empty($kecamatan)) {
                        return [];
                    }

                    return UnitDiperiksa::query()
                        ->where('kategori', $kategori)
                        ->where('nama_kecamatan', $kecamatan)
                        ->orderBy('nama_unit')
                        ->pluck('nama_unit', 'id')
                        ->toArray();
                })
                ->reactive()
                ->searchable()
                ->preload()
                ->required()
                /**
                 * Setelah user memilih unit_id, ambil kecamatan dari unit & set nama_kecamatan agar konsisten
                 */
                ->afterStateUpdated(function ($state, callable $set, callable $get) {
                    if ($state) {
                        $unit = UnitDiperiksa::find($state);
                        if ($unit) {
                            $set('nama_kecamatan', $unit->nama_kecamatan);
                            $set('kategori_unit', $unit->kategori);
                        }
                    }
                }),

                Select::make('jenis_pemeriksaan')
                    ->label('Jenis Pemeriksaan')
                    ->required()
                    ->options([
                        'Reguler'      => 'Reguler',
                        'Investigatif' => 'Investigatif',
                        'PKPT'         => 'PKPT',
                ]),

                Select::make('tim')
                ->label('TIM Pemeriksa')
                ->required()
                ->options([
                    'TIM I' => 'TIM I',
                    'TIM II' => 'TIM II',
                    'TIM III' => 'TIM III',
                    'TIM IV' => 'TIM IV',
                    'TIM V' => 'TIM V',
            ]),

            
            ]);
    }
}
