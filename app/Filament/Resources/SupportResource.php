<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupportResource\Pages;
use App\Models\Field;
use App\Models\Support;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SupportResource extends Resource
{
    protected static ?string $model = Support::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Support Information')
                    ->schema([
                        Forms\Components\Select::make('beneficiary_id')
                            ->relationship('beneficiary', 'name')
                            ->native(false)
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('project_id')
                            ->relationship('project', 'name')
                            ->native(false)
                            ->preload()
                            ->searchable()
                            ->required(),

                    ])->columns(2),
                Section::make('Support Details')
                    ->schema([
                        Forms\Components\Repeater::make('fields')
                            ->relationship('supportFields')
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
                                return $action->label('Add an other details');
                            }),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('beneficiary.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('project.name')
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
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSupports::route('/'),
        ];
    }
}
