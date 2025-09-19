<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengumumanResource\Pages;
use App\Filament\Resources\PengumumanResource\RelationManagers;
use App\Models\Pengumuman;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengumumanResource extends Resource
{
    protected static ?string $model = Pengumuman::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Menejemen Konten';
    protected static ?string $navigationLabel = 'Pengumuman';
    protected static ?int $navigationSort = 8;
    public static function getPluralLabel(): string
    {
        return 'Pengumuman';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('deskripsi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('tipe')
                    ->required()
                    ->options([
                        'informasi' => 'Informasi',
                        'kegiatan' => 'Kegiatan',
                        'akademik' => 'Akademik',
                        'lainnya' => 'Lainnya',
                    ]),
                Forms\Components\Select::make('status')
                    ->required()
                    ->options([
                        'draf' => 'Draf',
                        'publikasi' => 'Publikasi',
                    ]),
                Forms\Components\FileUpload::make('gambar')
                    ->image()
                    ->imageEditor()
                    ->maxSize(1024),

                Forms\Components\Select::make('user_id')
                    ->required()
                    ->relationship('pembuat', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')->searchable(),
                Tables\Columns\TextColumn::make('tipe'),
                Tables\Columns\ToggleColumn::make('status')
                    ->onColor('success')
                    ->offColor('danger')
                    ->onIcon('heroicon-s-check-circle')
                    ->offIcon('heroicon-s-x-circle')
                    ->tooltip(function ($record) {
                        return $record->status === 'publikasi'
                            ? 'Status: Publikasi. Klik untuk jadikan Draf.'
                            : 'Status: Draf. Klik untuk Publikasikan.';
                    })
                    ->updateStateUsing(function ($record, $state) {
                        $newStatus = $state ? 'publikasi' : 'draf';
                        $record->update(['status' => $newStatus]);
                    })
                    ->getStateUsing(function ($record) {
                        return $record->status === 'publikasi';
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draf' => 'Draf',
                        'publikasi' => 'Publikasi',
                    ]),
                Tables\Filters\SelectFilter::make('tipe')
                    ->options([
                        'informasi' => 'Informasi',
                        'kegiatan' => 'Kegiatan',
                        'akademik' => 'Akademik',
                        'lainnya' => 'Lainnya',
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengumumen::route('/'),
            'create' => Pages\CreatePengumuman::route('/create'),
            'edit' => Pages\EditPengumuman::route('/{record}/edit'),
        ];
    }
}
