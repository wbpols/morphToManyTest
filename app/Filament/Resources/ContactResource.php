<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource as Resources;
use App\Models\Contact;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
        ]);
    }

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
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->iconButton(),
                    Tables\Actions\DeleteAction::make()
                        ->iconButton(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->iconButton(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Resources\Pages\ListContacts::route('/'),
            'create' => Resources\Pages\CreateContact::route('/create'),
            'view' => Resources\Pages\ViewContact::route('/{record}'),
            'edit' => Resources\Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
