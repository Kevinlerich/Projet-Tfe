<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnnounceResource\Pages;
use App\Filament\Resources\AnnounceResource\RelationManagers;
use App\Models\Announce;
use Camya\Filament\Forms\Components\TitleWithSlugInput;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnnounceResource extends Resource
{
    protected static ?string $model = Announce::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),

                Forms\Components\Select::make('ville_id')
                ->relationship('ville', 'nom')
                ->required(),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'nom')
                    ->required(),
                TitleWithSlugInput::make(
                    fieldTitle: 'titre', // The name of the field in your model that stores the title.
                    fieldSlug: 'slug', // The name of the field in your model that will store the slug.
                ),
                Forms\Components\DatePicker::make('date_announce')
                    ->label('Date annonce')
                    ->required(),
                Forms\Components\RichEditor::make('description')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('category.id'),
                Tables\Columns\TextColumn::make('titre'),
                Tables\Columns\TextColumn::make('date_announce'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\BooleanColumn::make('archived'),
            ])
            ->filters([
                Filter::make('archived')->label('Archive')
                    ->query(fn (Builder $query): Builder => $query->where('archived', '=', 1)),
            ])
            ->actions([
                Tables\Actions\Action::make('archived')->label('Archivé')
                    ->url(fn (Announce $record): string  => route('archive', $record->id))
                    ->requiresConfirmation(),
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
            'index' => Pages\ListAnnounces::route('/'),
            'create' => Pages\CreateAnnounce::route('/create'),
            'edit' => Pages\EditAnnounce::route('/{record}/edit'),
        ];
    }
}
