<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Product Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Product Form')
                    ->tabs([
                        Tab::make('Product Info')
                            ->schema([
                                Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->required(),

                                TextInput::make('name')
                                    ->required()
                                    ->live(debounce: 1000)
                                    ->afterStateUpdated(function (string $operation, $state, callable $set) {
                                        $set('slug', Str::slug($state));
                                    }),

                                TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true),

                                RichEditor::make('description')
                                    ->toolbarButtons([
                                        'bold',
                                        'bulletList',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'underline',
                                        'undo',
                                    ]),
                                Toggle::make('is_customable')->required()
                            ]),

                        Tab::make('Variants')
                            ->schema([
                                Repeater::make('variants')
                                    ->relationship()
                                    ->schema([
                                        TextInput::make('name')->required(),
                                        TextInput::make('price_per_meter')->numeric()->required(),
                                        TextInput::make('stock_in_meter')->numeric()->required(),

                                        Repeater::make('sizes')
                                            ->relationship('sizes') // tambahkan foreign key manual
                                            ->schema([
                                                TextInput::make('size_label')->required(),
                                                TextInput::make('estimated_meter')->numeric()->required(),
                                                Toggle::make('available'),
                                            ]),

                                        Repeater::make('images')
                                            ->relationship()
                                            ->schema([
                                                FileUpload::make('image')
                                                    ->image()
                                                    ->directory('products/variants')
                                                    ->imagePreviewHeight('100')
                                                    ->required(),
                                            ])
                                    ])
                            ]),
                    ])->columnSpan(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('slug')->sortable()->searchable(),
                TextColumn::make('category.name')->label('Category')->sortable(),
                TextColumn::make('created_at')->dateTime('d M Y')->label('Created'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
