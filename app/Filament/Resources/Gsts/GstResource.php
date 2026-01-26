<?php

namespace App\Filament\Resources\Gsts;

use App\Filament\Resources\Gsts\Pages\CreateGst;
use App\Filament\Resources\Gsts\Pages\EditGst;
use App\Filament\Resources\Gsts\Pages\ListGsts;
use App\Filament\Resources\Gsts\Schemas\GstForm;
use App\Filament\Resources\Gsts\Tables\GstsTable;
use App\Models\Gst;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GstResource extends Resource
{
    protected static ?string $model = Gst::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Gst';

    public static function form(Schema $schema): Schema
    {
        return GstForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GstsTable::configure($table);
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
            'index' => ListGsts::route('/'),
            'create' => CreateGst::route('/create'),
            'edit' => EditGst::route('/{record}/edit'),
        ];
    }
}
