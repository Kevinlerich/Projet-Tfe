<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VilleResource\Pages;
use App\Filament\Resources\VilleResource\RelationManagers;
use App\Models\Ville;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Camya\Filament\Forms\Components\TitleWithSlugInput;


class VilleResource extends Resource
{
    protected static ?string $model = Ville::class;
    protected static ?string $label = 'Provinces';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TitleWithSlugInput::make(
                    fieldTitle: 'nom', // The name of the field in your model that stores the title.
                    fieldSlug: 'slug', // The name of the field in your model that will store the slug.
                ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nom')->label('Nom province'),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
            'index' => Pages\ListVilles::route('/'),
            'create' => Pages\CreateVille::route('/create'),
            'edit' => Pages\EditVille::route('/{record}/edit'),
        ];
    }
}
