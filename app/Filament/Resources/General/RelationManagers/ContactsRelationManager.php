<?php

namespace App\Filament\Resources\General\RelationManagers;

use App\Filament\Resources\ContactResource;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;

class ContactsRelationManager extends RelationManager
{
    protected static string $relationship = 'contacts';

    public function form(Forms\Form $form): Forms\Form
    {
        return ContactResource::form($form);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return ContactResource::table($table);
    }

    public function isReadOnly(): bool
    {
        return false;
    }
}
