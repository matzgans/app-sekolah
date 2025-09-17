<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeritaResource\Pages;
use App\Filament\Resources\BeritaResource\RelationManagers;
use App\Models\Berita;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BeritaResource extends Resource
{
    protected static ?string $model = Berita::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Menejemen Konten';
    protected static ?string $navigationLabel = 'Berita';
    protected static ?int $navigationSort = 7;
    public static function getPluralLabel(): string
    {
        return 'Berita';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')
                    ->required()
                    ->maxLength(255)
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('isi_berita')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('thumbnail')
                    ->image()
                    ->imageEditor()
                    ->maxSize(1024)
                    ->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->required()
                    ->options([
                        'draf' => 'Draf',
                        'publikasi' => 'Publikasi',
                    ]),
                Forms\Components\DateTimePicker::make('tanggal_publikasi'),

                Forms\Components\Repeater::make('galeris')
                    ->label('Koleksi Gambar')
                    ->columnSpanFull()
                    ->relationship('galeris')
                    ->schema([
                        Forms\Components\FileUpload::make('gambar')
                            ->image()
                            ->required()
                            ->imageEditor()
                            ->maxSize(1024),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No.')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('judul')->searchable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('tanggal_publikasi'),
                Tables\Columns\TextColumn::make('pembuat.name')->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draf' => 'Draf',
                        'publikasi' => 'Publikasi',
                    ]),
                Tables\Filters\SelectFilter::make('pembuat.name')
                    ->options(User::all()->pluck('name', 'id')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('lihat_galeri')
                    ->label('Lihat Galeri')
                    ->icon('heroicon-o-photo')
                    ->modalHeading('Koleksi Gambar')
                    ->modalContent(function ($record) {
                        return view('filament.prestasi.galeri-modal', [
                            'galeris' => $record->galeris,
                        ]);
                    })
                    ->modalWidth('lg')
                    ->modalSubmitAction(false),
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
            'index' => Pages\ListBeritas::route('/'),
            'create' => Pages\CreateBerita::route('/create'),
            'edit' => Pages\EditBerita::route('/{record}/edit'),
        ];
    }
}
