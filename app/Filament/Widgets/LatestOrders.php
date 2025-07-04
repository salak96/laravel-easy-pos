<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\CustomerResource;
use App\Models\Customer;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table

            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->query(Customer::query()->latest())
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->label('Nama Customer')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('address')
                    ->label('Alamat')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')    
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telepon')
            ])->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('open')
                    ->url(fn(Customer $record): string => CustomerResource::getUrl('edit', ['record' => $record])),
            ]);
    }
}
