<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Filament\Resources\CategoryResource\RelationManagers\ProductsRelationManager;
use App\Models\v1\Category;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('type')
                ->label('Type')
                    ->options([
                        'man'=>'man',
                        'women'=>'women',
                        'skincare'=>'skincare',
                        'co-ord-set'=>'co-ord-set',
                    ]),
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                    // ->live(debounce: '1000')
                    // ->afterStateUpdated(
                    //     fn (
                    //         Set $set,
                    //         ?string $state
                    //     ) =>
                    //     $set('slug', Str::slug($state['gender'] . $state),
                    //     )
                    // ),
                // TextInput::make('slug')
                //     ->readonly()
                //     ->required()
                //     ->maxLength(255),

                // FileUpload::make('icon')
                //     ->disk('public')
                //     ->directory('images/category')
                //     ->image()
                //     ->imageEditor()


                    ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // ImageColumn::make('icon'),
                TextColumn::make('title')
                ->searchable(),
                TextColumn::make('slug')
                ->searchable(),
                SelectColumn::make('is_active')
                ->options([
                    0 => 'Inactive',
                    1 => 'Active',
                ])

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
            ProductsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
