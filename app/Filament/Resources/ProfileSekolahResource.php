<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfileSekolahResource\Pages;
use App\Filament\Resources\ProfileSekolahResource\RelationManagers;
use App\Models\ProfileSekolah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class ProfileSekolahResource extends Resource
{
    protected static ?string $model = ProfileSekolah::class;

    protected static ?string $navigationLabel = 'Profile Sekolah';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_sekolah')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('npsn')
                    ->maxLength(255),
                Forms\Components\TextInput::make('no_telp')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\Textarea::make('alamat')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('visi')
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('misi')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('kepala_sekolah')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('foto_sekolah')
                    ->image()
                    ->imageEditor()
                    ->maxSize(1024),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->searchable(
                'nama_sekolah',
                'npsn',
            )
            ->columns([
                Tables\Columns\TextColumn::make('No.')
                    ->rowIndex(),

                Tables\Columns\TextColumn::make('nama_sekolah')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_sekolah')
                    ->searchable(),
                Tables\Columns\TextColumn::make('npsn')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_telp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('visi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kepala_sekolah')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('foto_sekolah')
                    ->searchable()
                    ->url(fn(ProfileSekolah $record) => $record->foto_sekolah ? Storage::url($record->foto_sekolah) : null),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('nama_sekolah')
                    ->options(ProfileSekolah::all()->pluck('nama_sekolah', 'id')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([]);
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
            'index' => Pages\ListProfileSekolahs::route('/'),
            'create' => Pages\CreateProfileSekolah::route('/create'),
            'view' => Pages\ViewProfileSekolah::route('/{record}'),
            'edit' => Pages\EditProfileSekolah::route('/{record}/edit'),
        ];
    }
}
