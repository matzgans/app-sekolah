<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FasilitasResource\Pages;
use App\Models\Fasilitas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FasilitasResource extends Resource
{
    protected static ?string $model = Fasilitas::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationLabel = 'Fasilitas';
    protected static ?string $navigationGroup = 'Menejemen Sarana Prasarana';
    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_fasilitas')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('deskripsi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('foto_fasilitas')
                    ->image()
                    ->imageEditor()
                    ->maxSize(1024)
                    ->required(),
                Forms\Components\Select::make('status')
                    ->required()
                    ->options([
                        'baik' => 'Baik',
                        'kurang_baik' => 'Kurang Baik',
                        'rusak' => 'Rusak',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No.')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('nama_fasilitas')->searchable(),
                Tables\Columns\TextColumn::make('deskripsi'),
                Tables\Columns\ImageColumn::make('foto_fasilitas'),
                Tables\Columns\TextColumn::make('status'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'baik' => 'Baik',
                        'kurang_baik' => 'Kurang Baik',
                        'rusak' => 'Rusak',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFasilitas::route('/'),
            'create' => Pages\CreateFasilitas::route('/create'),
            'edit' => Pages\EditFasilitas::route('/{record}/edit'),
        ];
    }
}
