<?php

namespace App\Filament\Resources\CategoryResource\RelationManagers;

use App\Models\v1\Product;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('sku')
                    ->label('SKU')
                    ->default(fn () => Product::generateSKU())
                    ->required()
                    ->maxLength(255)
                    ->readOnly(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->live(debounce: '1000')
                    ->afterStateUpdated(
                        fn (
                            Set $set,
                            ?string $state
                        ) =>
                        $set('slug', Str::slug($state))
                    ),
                MarkdownEditor::make('description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('BDT'),
                TextInput::make('sell_price')
                    ->required()
                    ->numeric()
                    ->prefix('BDT'),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                TextInput::make('stock')
                    ->numeric(),
                Toggle::make('active')
                    ->required(),
                Fieldset::make('Product Image')
                    ->relationship('image')
                    ->schema([
                        FileUpload::make('original')
                            ->disk('public')
                            ->directory('images/product')
                            ->image()
                            ->imageEditor(),
                        FileUpload::make('thumbnail')
                            ->disk('public')
                            ->directory('images/product')
                            ->image()
                            ->imageEditor(),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                 AttachAction::make(),
            ])
            ->actions([
                DetachAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
}
