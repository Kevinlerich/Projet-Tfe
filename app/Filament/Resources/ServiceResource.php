<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Camya\Filament\Forms\Components\TitleWithSlugInput;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static ?string $label = 'Services';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Auteur')
                    ->required(),
                Forms\Components\Select::make('ville_id')
                    ->relationship('ville', 'nom')
                    ->label('Province')
                    ->required(),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'nom')
                    ->label('Categorie')
                    ->required(),
                TitleWithSlugInput::make(
                    fieldTitle: 'nom', // The name of the field in your model that stores the title.
                    fieldSlug: 'slug', // The name of the field in your model that will store the slug.
                ),
                Forms\Components\Textarea::make('description'),
                Forms\Components\FileUpload::make('image_service')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Auteur'),
                Tables\Columns\TextColumn::make('category.nom')->label('Categorie'),
                Tables\Columns\TextColumn::make('nom'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\ImageColumn::make('image_service'),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
