<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers\CategoriesRelationManager;
use App\Filament\Resources\ProductResource\RelationManagers\VariationRelationManager;
use App\Models\v1\Product;
use Closure;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Str;
use Filament\Tables\Table;
use Filament\Forms\Set;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;


class ProductResource extends Resource
{

    protected static ?string $model = Product::class;


    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form

            ->schema([
                TextInput::make('sku')
                    ->label('SKU')
                    ->default(fn () => Product::generateSKU())
                    ->required()
                    ->maxLength(255),

                TextInput::make('name')

                    ->required()
                    ->maxLength(255),
                // // ->live(debounce: '1000')
                // ->afterStateUpdated(
                //     fn (
                //         Set $set,
                //         ?string $state
                //     ) =>
                //     $set('slug', Str::slug($state))
                // ),
                RichEditor::make('description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('BDT'),
                TextInput::make('sell_price')
                    ->required()
                    ->numeric()
                    ->prefix('BDT')
                    ->lte('price'),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                TextInput::make('stock')
                    ->numeric(),
                Fieldset::make('Product Image')
                    ->relationship('image')
                    ->schema([
                        FileUpload::make('original')

                            ->disk('public')
                            ->directory('images/product')
                            ->image()
                            ->imageEditor()
                            ->required(),
                        FileUpload::make('thumbnail')
                            ->disk('public')
                            ->directory('images/product')
                            ->image()
                            ->imageEditor()
                            ->required(),
                    ]),
                // Fieldset::make('Product Gallery')
                //     ->relationship('gallery')
                //     ->schema([
                //         FileUpload::make('original')
                //             ->multiple()
                //             ->disk('public')
                //             ->directory('images/product')
                //             ->image()
                //             ->imageEditor()
                //             ->required(),
                //     ]),
                Section::make('Categories')->schema(
                    [
                        Select::make('categories')
                            ->relationship('categories', 'slug')
                             
                            ->multiple()
                            ->preload()
                    ]
                ),
                Section::make('Variations')->schema(
                    [
                        Select::make('variations')
                            ->relationship('Variation', 'value')
                            ->multiple()
                            ->preload()
                    ]
                ),
                Toggle::make('active')
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(25)
            ->columns([
                TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable(),
                ImageColumn::make('image.original')
                    ->label('Image')
                    ->circular(),
                TextColumn::make('name')
                    ->wrap()
                    ->searchable(),
                TextColumn::make('price')
                    ->money('BDT')
                    ->sortable(),
                TextColumn::make('sell_price')
                    ->money('BDT')
                    ->sortable(),
                TextColumn::make('slug')
                    ->wrap()
                    ->searchable(),
                TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('active')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CategoriesRelationManager::class,
            VariationRelationManager::class
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
