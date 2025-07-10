<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('Order Tabs')
                ->tabs([
                    Tab::make('Order Info')->schema([
                        Select::make('customer_id')
                            ->relationship('customer', 'name')
                            ->searchable()
                            ->required(),

                        Textarea::make('address')->required(),
                        TextInput::make('phone')->required(),

                        TextInput::make('code')->disabled()->dehydrated(false),

                        Grid::make(3)->schema([
                            TextInput::make('subtotal_amount')
                                ->label('Subtotal')->prefix('Rp')->numeric()->required(),
                            TextInput::make('tax')
                                ->label('Tax')->prefix('Rp')->numeric()->required(),
                            TextInput::make('total_amount')
                                ->label('Total')->prefix('Rp')->numeric()->required(),
                        ]),

                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'paid' => 'Paid',
                                'canceled' => 'Canceled',
                                'failed' => 'Failed',
                            ])
                            ->required(),

                        TextInput::make('payment_method')->nullable(),
                        Textarea::make('payment_url')->nullable(),
                    ]),

                    Tab::make('Order Items')->schema([
                        Repeater::make('items')
                            ->relationship()
                            ->schema([
                                Select::make('product_id')
                                    ->label('Product')
                                    ->relationship('product', 'name')
                                    ->searchable()
                                    ->required()
                                    ->afterStateUpdated(fn(Set $set) => $set('variant_id', null)),

                                Select::make('variant_id')
                                    ->label('Variant')
                                    ->options(function (Get $get) {
                                        $productId = $get('product_id');
                                        return $productId
                                            ? ProductVariant::where('product_id', $productId)
                                            ->pluck('name', 'id')
                                            ->toArray()
                                            : [];
                                    })
                                    ->searchable()
                                    ->required()
                                    ->afterStateUpdated(fn(Set $set) => $set('size_id', null)),


                                Select::make('size_id')
                                    ->label('Size')
                                    ->options(function (Get $get) {
                                        $variantId = $get('variant_id');
                                        return $variantId
                                            ? ProductSize::where('variant_id', $variantId)
                                            ->pluck('size_label', 'id')
                                            ->toArray()
                                            : [];
                                    })
                                    ->searchable()
                                    ->nullable(),


                                Textarea::make('custom_size_note')->nullable(),

                                Grid::make(3)->schema([
                                    TextInput::make('quantity')
                                        ->numeric()->default(1)->minValue(1)->required(),

                                    TextInput::make('requested_meter')
                                        ->numeric()->step(0.01)->required(),

                                    TextInput::make('subtotal_price')
                                        ->numeric()->prefix('Rp')->required(),
                                ]),

                                Textarea::make('notes')->nullable(),
                            ])
                            ->defaultItems(1)
                            ->createItemButtonLabel('Add Item')
                            ->columns(1),
                    ]),
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
