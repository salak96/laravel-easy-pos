<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextInputColumn;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('barcode')
                        ->required()
                        ->unique(Product::class, 'barcode', ignoreRecord: true),
                    TextInput::make('price')
                        ->numeric()
                        ->required(),
                    TextInput::make('quantity')
                        ->numeric()
                        ->minValue(0)
                        ->default(1)
                        ->required(),
                    Textarea::make('description')
                        ->maxLength(500)
                        ->nullable(),
                    FileUpload::make('image')
                        ->image()
                        ->directory('products')
                        ->nullable(),
                    Toggle::make('status')
                        ->label('Active')
                        ->default(true)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                ImageColumn::make('image')->disk('public')  
                                ->size(50)  
                                ->square(),
                TextColumn::make('barcode')->sortable()->searchable(),
                TextInputColumn::make('quantity')->type('number')  
                                ->sortable()   
                                ->width(50)
                                ->rules(['required', 'integer', 'min:1']),
                TextColumn::make('price')->sortable(),
                IconColumn::make('status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')  
                    ->falseIcon('heroicon-o-x-circle')  
                    ->tooltip(fn ($record) => $record->status ? 'Active' : 'Inactive'),               
                 TextColumn::make('created_at')->dateTime(),
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
            'index' => Pages\ListProducts::route('/'),
            // 'create' => Pages\CreateProduct::route('/create'),
            // 'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
