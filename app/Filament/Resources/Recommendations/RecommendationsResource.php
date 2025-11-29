<?php

namespace App\Filament\Resources\Recommendations;

use App\Filament\Resources\Recommendations\Pages\CreateRecommendations;
use App\Filament\Resources\Recommendations\Pages\EditRecommendations;
use App\Filament\Resources\Recommendations\Pages\ListRecommendations;
use App\Filament\Resources\Recommendations\Pages\ViewRecommendations;
use App\Filament\Resources\Recommendations\Schemas\RecommendationsForm;
use App\Filament\Resources\Recommendations\Schemas\RecommendationsInfolist;
use App\Filament\Resources\Recommendations\Tables\RecommendationsTable;
use App\Models\Recommendations;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RecommendationsResource extends Resource
{
    protected static ?string $model = Recommendations::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentCheck;
    protected static ?string $navigationLabel = 'Recommendations';
   
    protected static ?string $recordTitleAttribute = 'Recomendations';
    protected static ?int $navigationSort = 6;


    public static function form(Schema $schema): Schema
    {
        return RecommendationsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RecommendationsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RecommendationsTable::configure($table);
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
            'index' => ListRecommendations::route('/'),
            'create' => CreateRecommendations::route('/create'),
            'view' => ViewRecommendations::route('/{record}'),
            'edit' => EditRecommendations::route('/{record}/edit'),
        ];
    }
}
