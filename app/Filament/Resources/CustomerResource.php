<?php

namespace App\Filament\Resources;

use App\Filament\Resources\General as GeneralResources;
use App\Filament\Resources\CustomerResource as Resources;
use App\Models\Customer;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->iconButton(),
                Tables\Actions\EditAction::make()
                    ->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Resources\Pages\ListCustomers::route('/'),
            'create' => Resources\Pages\CreateCustomer::route('/create'),
            'view' => Resources\Pages\ViewCustomer::route('/{record}'),
            'edit' => Resources\Pages\EditCustomer::route('/{record}/edit'),
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
