<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhotographeProvinceResource\Pages;
use App\Filament\Resources\PhotographeProvinceResource\RelationManagers;
use App\Models\PhotographeProvince;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PhotographeProvinceResource extends Resource
{
    protected static ?string $model = PhotographeProvince::class;

    protected static ?string $label = 'Lieux de travail';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('province_id')
                    ->relationship('province', 'nom')
                    ->label('Province')
                    ->required(),
                Forms\Components\Select::make('photographe_id')
                    ->relationship('photographe', 'name')
                    ->label('Photographe')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('province.nom'),
                Tables\Columns\TextColumn::make('photographe.name'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListPhotographeProvinces::route('/'),
            'create' => Pages\CreatePhotographeProvince::route('/create'),
            'edit' => Pages\EditPhotographeProvince::route('/{record}/edit'),
        ];
    }
}
