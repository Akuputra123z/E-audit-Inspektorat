<?php

namespace App\Filament\Resources\Recommendations\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use App\Models\Lhp;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use App\Models\KodeTemuan;
use Filament\Forms\Components\RichEditor;

class RecommendationsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                  /** ---------------------------------
                 *  PILIH TEMUAN LHP
                 * ---------------------------------*/
                Select::make('lhp_id')
                        ->label('Nomor LHP')
                        ->searchable()
                        ->options(
                            Lhp::query()
                                ->pluck('nomor_lhp', 'id')
                        )
                        ->required()
                        ->reactive(),


                /** ---------------------------------
                 *  PILIH KODE REKOMENDASI
                 * ---------------------------------*/
                Select::make('kode_temuan_id')
                        ->label('Kode Temuan')
                        ->options(
                            KodeTemuan::pluck('kode', 'id')
                        )
                        ->searchable()
                        ->nullable(),

                        TextInput::make('nilai_temuan')
                        ->label('Nilai Temuan')
                        ->numeric()
                        ->nullable(),

                        RichEditor::make('uraian_temuan')
                        ->label('Uraian Temuan')
                        ->nullable(),
                        Select::make('kode_rekomendasi_id')
                        ->label('Kode Rekomendasi')
                        ->relationship('kodeRekomendasi', 'kategori')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->afterStateUpdated(function ($state, callable $set) {
                            if ($state) {
                                $kode = \App\Models\KodeRekomendasi::find($state);
                                $set('kategori_rekom', $kode?->kategori);
                            }
                        }),
                /** ---------------------------------
                 *  STATUS
                 * ---------------------------------*/
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'proses' => 'Proses',
                        'selesai' => 'Selesai',
                    ])
                    ->required(),

                /** ---------------------------------
                 *  URAIAN DAN NILAI REKOM
                 * ---------------------------------*/
                Textarea::make('uraian_rekom')
                    ->label('Uraian Rekomendasi')
                    ->columnSpanFull(),

                TextInput::make('nilai_rekom')
                    ->label('Nilai Rekomendasi')
                    ->numeric(),

                /** ---------------------------------
                 *  TINDAK LANJUT
                 * ---------------------------------*/
                TextInput::make('no_tindak_lanjut')
                    ->label('Nomor Tindak Lanjut'),

                Textarea::make('uraian_tindak_lanjut')
                    ->label('Uraian Tindak Lanjut')
                    ->columnSpanFull(),

                TextInput::make('nilai_tindak_lanjut')
                    ->label('Nilai Tindak Lanjut')
                    ->numeric(),

                /** ---------------------------------
                 *  UPLOAD MULTI FILE
                 * ---------------------------------*/
                FileUpload::make('file_tindak_lanjut')
                ->label('Lampiran Bukti (PDF/Gambar)')
                ->multiple()
                ->directory('tindaklanjut')
                ->disk('public')
                ->visibility('public')
                ->downloadable()
                ->openable()
                ->previewable(true) // hanya preview gambar, bukan PDF
                ->acceptedFileTypes([
                    'image/jpeg',
                    'image/png',
                    'image/webp',
                    'image/gif',
                    'application/pdf',
                ]), 
            
            

                /** ---------------------------------
                 *   TANGGAPAN
                 * ---------------------------------*/
               
            ]);
    }
}
