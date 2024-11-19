<?php

namespace App\Filament\Resources;

use App\Filament\Resources\General as GeneralResources;
use App\Filament\Resources\ProspectResource as Resources;
use App\Models\Prospect;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent;

class ProspectResource extends Resource
{
    protected static ?string $model = Prospect::class;

    public static function table(Tables\Table $table): Tables\Table
    {
        return CustomerResource::table($table);
    }

    public static function getRelations(): array
    {
        return [
            GeneralResources\RelationManagers\ContactsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Resources\Pages\ListProspects::route('/'),
            'create' => Resources\Pages\CreateProspect::route('/create'),
            'view' => Resources\Pages\ViewProspect::route('/{record}'),
            'edit' => Resources\Pages\EditProspect::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                Eloquent\SoftDeletingScope::class,
            ]);
    }
}
