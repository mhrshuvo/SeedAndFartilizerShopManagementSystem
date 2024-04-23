<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PreLovedResource\Pages;
use App\Filament\Resources\PreLovedResource\RelationManagers;
use App\Models\v1\PreLoved;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class PreLovedResource extends Resource
{
    protected static ?string $model = PreLoved::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('User')
                    ->options(
                        \App\Models\User::all()->pluck('name', 'id')
                    ),
                Forms\Components\TextInput::make('contact_no')
                    ->label('Contact No'),
                Select::make('want_to_do')
                    ->label('Want To Do')
                    ->options([
                        'sell' => 'Sell',
                        'donate' => 'Donate',
                    ]),

                Section::make('Payout Details For Bank')
                    ->statePath('payout_account.bank')
                    ->schema([
                        Forms\Components\TextInput::make('bank_name'),
                        Forms\Components\TextInput::make('branch_name'),
                        Forms\Components\TextInput::make('account_number'),
                        Forms\Components\TextInput::make('account_name'),
                    ]),
                Section::make('Payout Details for Mobile Banking')
                    ->statePath('payout_account.mb')
                    ->schema([
                        Forms\Components\TextInput::make('which mobile banking'),
                        Forms\Components\TextInput::make('phone_no'),

                    ]),
                FileUpload::make('image')
                    ->multiple()
                    ->disk('public')
                    ->directory('images/pre_loved_product')
                    ->image()
                    ->imageEditor()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name'),
                TextColumn::make('contact_no'),
                TextColumn::make('want_to_do'),
                SelectColumn::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                        'live' => 'Live',
                        'down' => 'Down',
                        'donated' => 'Donated',
                    ]),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'pre_loved_products' => RelationManagers\PreLovedProductsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPreLoveds::route('/'),
            'create' => Pages\CreatePreLoved::route('/create'),
            'edit' => Pages\EditPreLoved::route('/{record}/edit'),
            'view' => Pages\ViewPreLoved::route('/{record}'),
        ];
    }
}
