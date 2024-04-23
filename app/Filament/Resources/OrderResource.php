<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers\OrderProductsRelationManager;
use App\Models\v1\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Infolists\Infolist;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('tracking_id'),
                TextInput::make('address'),
                TextInput::make('contact_no'),
                TextInput::make('subtotal'),
                TextInput::make('coupon_no'),
                TextInput::make('coupon_discount'),
                TextInput::make('delivery_charge'),
                TextInput::make('vat')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->deferLoading()
            ->defaultPaginationPageOption(25)
            ->columns([

                TextColumn::make('tracking_id'),
                TextColumn::make('user.name'),
                TextColumn::make('contact_no'),
                TextColumn::make('division.name')
                    ->label('Division'),

                TextColumn::make('total_price')
                    ->money('BDT')
                    ->sortable(),

                SelectColumn::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'canceled' => 'Canceled',
                        'confirm' => 'Confirm',
                        'processing' => 'Processing',
                        'on_delivery' => 'On_delivery',
                        'delivered' => 'Delivered'
                    ])

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),

                Action::make('pdf')
                    ->label('invoice')
                    ->color('success')
                    ->icon('heroicon-o-arrow-down-on-square')
                    ->url(fn (Order $record) => route('invoice', $record))
                    ->openUrlInNewTab(),


            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                //Tables\Actions\CreateAction::make(),
            ]);
    }
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('tracking_id')
                    ->badge(),
                TextEntry::make('coupon_discount')
                    ->money('BDT'),
                TextEntry::make('delivery_charge')
                    ->money('BDT'),
                TextEntry::make('vat')
                    ->money('BDT'),
                TextEntry::make('total_price')
                    ->money('BDT'),
                TextEntry::make('user.name'),
                TextEntry::make('contact_no'),
                TextEntry::make('address'),
                TextEntry::make('status')
                    ->badge(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            OrderProductsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            //'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
