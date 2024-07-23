<?php

namespace App\Filament\Resources;

use App\Enums\Enums\GenderEnum;
use App\Enums\StatusEnum;
use App\Filament\Resources\BeneficiaryResource\Pages;
use App\Models\Beneficiary;
use App\Models\Cell;
use App\Models\District;
use App\Models\Field;
use App\Models\Sector;
use App\Models\Village;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BeneficiaryResource extends Resource
{
    protected static ?string $model = Beneficiary::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Personal Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\Select::make('sex')
                        ->native(false)
                            ->label('Gender')
                            ->options(GenderEnum::class)

                            ->required(),
                            Forms\Components\Select::make('district_id')
                            ->relationship(name: 'district', titleAttribute: 'name')
                               ->label('District')
                               ->options(District::pluck('name', 'id')->toArray())
                               ->preload()
                               ->searchable()
                               ->required(),
                               Forms\Components\Select::make('sector_id')
                               ->relationship(name: 'sector', titleAttribute: 'name')
                                  ->label('Sector')
                                  ->options(Sector::pluck('name', 'id')->toArray())
                                  ->preload()
                                  ->searchable()
                                  ->required(),
                                  Forms\Components\Select::make('cell_id')
                                  ->relationship(name: 'cell', titleAttribute: 'name')
                                     ->label('Cell')
                                     ->options(Cell::pluck('name', 'id')->toArray())
                                     ->preload()
                                     ->searchable()
                                     ->required(),
                        Forms\Components\Select::make('village_id')
                         ->relationship(name: 'village_id', titleAttribute: 'name')
                            ->label('Village')
                            ->options(Village::pluck('name', 'id')->toArray())
                            ->preload()
                            ->searchable()
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->options(StatusEnum::class)
                            ->preload()
                            ->searchable(),
                    ])->columns(),
                Forms\Components\Repeater::make('fields')
                    ->label('Additional Beneficiary Information')
                    ->relationship('beneficiaryFields')
                    ->schema([
                        Forms\Components\Select::make('field_id')
                            ->relationship(name: 'field_id', titleAttribute: 'name')
                            ->label('Column Name')
                            ->preload()
                            ->searchable()
                            ->native(false)
                            ->options(Field::pluck('name', 'id')->toArray())
                            ->disableOptionWhen(function ($value, $state, Get $get) {
                                return collect($get('../*.field_id'))
                                    ->reject(fn ($id) => $id == $state)
                                    ->filter()
                                    ->contains($value);
                            })
                            ->required()->live(),
                        Forms\Components\TextInput::make('value')
                            ->required(),
                    ])->addAction(function (Action $action) {
                        return $action->label('Add an other information');
                    }),
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sex')
                    ->label('Gender')
                    ->sortable()
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('village.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(StatusEnum::class)
                    ->native(false)
                    ->preload()
                    ->searchable()
                    ->placeholder('Filter by status'),
                SelectFilter::make('village_id')
                    ->relationship('village', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Filter by village'),
                SelectFilter::make('sex')
                    ->options(GenderEnum::class)
                    ->searchable()
                    ->preload()
                    ->label('Filter by gender'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->slideOver(),
                Tables\Actions\DeleteAction::make()->requiresConfirmation('Are you sure you want to delete this beneficiary?')->slideOver(),
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
            'index' => Pages\ListBeneficiaries::route('/'),
        ];
    }
}
