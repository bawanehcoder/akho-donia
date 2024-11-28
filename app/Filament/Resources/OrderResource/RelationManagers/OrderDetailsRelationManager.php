<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use App\Models\ItemOption;
use App\Models\OptionDetil;
use App\Models\SubOption;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderDetailsRelationManager extends RelationManager
{
    protected static string $relationship = 'order_details';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('ItemID')
                    ->relationship('item', 'name')
                    ->reactive()
                    ->afterStateUpdated(fn(callable $set) => $set('OptID', null)),
                TextInput::make('Quantity'),

                Select::make('OptID')
                    ->options(function (callable $get) {
                        $itemId = $get('ItemID');
                        if ($itemId) {
                            // الحصول على كل قيم OptID المرتبطة بالـ ItemID من جدول OptionDetil
                            $optIds = OptionDetil::where('ItemID', $itemId)->pluck('OptID');

                            // استخدام قيم OptID لجلب أسماء subOption من جدول suboption
                            return SubOption::whereIn('id', $optIds)->pluck('Name', 'id');
                        }
                        return [];
                        ;
                    })
                    ->multiple() // لجعل الحقل يقبل خيارات متعددة
                    ->dehydrateStateUsing(fn ($state) => json_encode($state))
                    ->afterStateUpdated(function (callable $get, callable $set) {
                        $selectedOptIds = $get('OptID') ?? [];
                
                        // جلب AdditionalValue لكل OptID محدد وحساب المجموع
                        $totalAdditionalValue = OptionDetil::whereIn('OptID', $selectedOptIds)->sum('AdditionalValue');
                
                        // تحديث حقل Price بالسعر الكلي الجديد
                        $set('Price', $totalAdditionalValue * $get('Quantity'));
                    })
                    ->reactive(),
                TextInput::make('Price'),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('item.Name'),
                Tables\Columns\TextColumn::make('option_detil')->html(),
                Tables\Columns\TextColumn::make('Price')->summarize(
                    Tables\Columns\Summarizers\Sum::make()
                        ->money()
                ),
                Tables\Columns\TextColumn::make('Quantity')->summarize(
                    Tables\Columns\Summarizers\Sum::make()->numeric(),
                ),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
