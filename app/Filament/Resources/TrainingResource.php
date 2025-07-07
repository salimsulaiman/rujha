<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainingResource\Pages;
use App\Filament\Resources\TrainingResource\RelationManagers;
use App\Models\Training;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class TrainingResource extends Resource
{
    protected static ?string $model = Training::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->live(debounce: 1000)
                    ->afterStateUpdated(function (string $operation, $state, callable $set) {
                        $set('slug', Str::slug($state));
                    })
                    ->maxLength(255),

                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                Textarea::make('excerpt')
                    ->label('Deskripsi Singkat')
                    ->rows(2)
                    ->required()
                    ->maxLength(500),

                RichEditor::make('description')
                    ->label('Deskripsi Lengkap')
                    ->required()
                    ->columnSpan('full'),

                TextInput::make('location')
                    ->label('Lokasi')
                    ->required()
                    ->columnSpan(2)
                    ->maxLength(255),

                DateTimePicker::make('start_date')
                    ->label('Tanggal Mulai')
                    ->required(),

                DateTimePicker::make('end_date')
                    ->label('Tanggal Selesai')
                    ->required(),

                FileUpload::make('thumbnail')
                    ->label('Thumbnail')
                    ->image()
                    ->required()
                    ->directory('trainings')
                    ->imagePreviewHeight('150'),

                TextInput::make('price')->label('Harga')->numeric()->required(),

                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ])
                    ->label('Status')
                    ->default('draft')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Gambar')
                    ->circular()
                    ->height(50)
                    ->width(50),

                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('location')
                    ->label('Lokasi')
                    ->limit(20),

                TextColumn::make('start_date')
                    ->label('Mulai')
                    ->dateTime('d M Y H:i'),

                TextColumn::make('end_date')
                    ->label('Selesai')
                    ->dateTime('d M Y H:i'),

                BadgeColumn::make('status')
                    ->colors([
                        'primary' => 'draft',
                        'success' => 'published',
                        'gray' => 'archived',
                    ])
                    ->label('Status')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ])
                    ->label('Status'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListTrainings::route('/'),
            'create' => Pages\CreateTraining::route('/create'),
            'edit' => Pages\EditTraining::route('/{record}/edit'),
        ];
    }
}
