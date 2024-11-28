<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderInvoicedResource\Pages;
use App\Filament\Resources\OrderAcceptResource\RelationManagers;
use App\Models\Order;
use App\Models\OrderAccept;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderInvoicedResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Orders';
    protected static ?string $navigationLabel = 'Invoiced';

    protected static ?int $navigationSort = 18;

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->where('status', 4);
    }

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Select::make('UserID')
                // ->getOptionLabelFromRecordUsing(fn(User $record) => "{$record->name}")
                ->relationship('user', 'email'),
            Forms\Components\Select::make('ZoneID')
                ->required()
                ->relationship('zone', 'AddresEn'),
            Forms\Components\Select::make('delivery_type')
                ->options([
                    'personal_pickup' => 'personal_pickup',
                    'delivery_address' => 'delivery_address',
                    // 'custom_date' => 'Custom Date',


                ])
                ->required(),
            Forms\Components\DateTimePicker::make('OrderDate')
                ->required(),
            Forms\Components\TimePicker::make('DeliveryTime')
                ->required(),
            Forms\Components\TextInput::make('Name')
                ->required(),
            Forms\Components\TextInput::make('Phone')
                ->required(),
            Forms\Components\TextInput::make('Phone2'),
            Forms\Components\TextInput::make('address')
                ->required(),
            // Forms\Components\TextInput::make('ZonePrice')
            //     ->numeric()
            //     ->required(),
            Forms\Components\TextInput::make('Total')
                ->numeric()
                ->required(),
            // Forms\Components\TextInput::make('AddValue')
            //     ->numeric(),
            // Forms\Components\TextInput::make('Discount')
            //     ->numeric(),
            // Forms\Components\TextInput::make('Points')
            //     ->numeric(),
            Forms\Components\Select::make('Status')
                ->options([
                    0 => 'Waiting',
                    1 => 'Accepted',
                    2 => 'Rejected',
                    3 => 'Cancel',
                    4 => 'invoiced',
                ])
                ->disabled()
                ->default('pending'),
            Forms\Components\Select::make('PaymentMethod')
                ->options([
                    0 => 'Cash',
                    1 => 'Credit Card',
                    // إضافة المزيد من طرق الدفع حسب الحاجة
                ])
                ->required(),
            // Forms\Components\TextInput::make('PaymentNo'),
            // Forms\Components\TextInput::make('PaymentData'),
            // Forms\Components\Select::make('PaymentStatus')
            //     ->options([
            //         'paid' => 'Paid',
            //         'unpaid' => 'Unpaid',
            //     ])
            //     ->default('unpaid'),
            // Forms\Components\TextInput::make('BranchID'),
            // Forms\Components\TextInput::make('Source'),
            Forms\Components\Textarea::make('Note'),
            // Forms\Components\Hidden::make('blob'), // استخدام حقل مخفي 
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('OrderDate')->label('Order Date'),
                Tables\Columns\TextColumn::make('DeliveryTime')->label('Delivery Time'),
                Tables\Columns\TextColumn::make('Name')->label('Customer Name'),
                Tables\Columns\TextColumn::make('Phone')->label('Phone'),
                Tables\Columns\TextColumn::make('Total')->label('Total Amount'),
                Tables\Columns\TextColumn::make('Status')->label('Status'),
                Tables\Columns\TextColumn::make('PaymentMethod')->label('Payment Method'),
            ])
            ->filters([


                SelectFilter::make('Branch')->relationship('Branch', 'AddresAr'),
                Filter::make('created_at')
                    ->form([
                        TextInput::make('name'),
                        TextInput::make('phone_number'),
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])->columnSpan(4)->columns(4)
                    ->query(function (Builder $query, array $data): Builder {
                        return $query

                            ->when(
                                $data['name'],
                                fn(Builder $query, $date): Builder => $query->where(
                                    'name',
                                    'LIKE',
                                    "%{$data['name']}%",
                                ),
                            )

                            ->when(
                                $data['phone_number'],
                                fn(Builder $query, $date): Builder => $query->where(
                                    'phone',
                                    'LIKE',
                                    "%{$data['phone_number']}%",
                                ),
                            )

                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })

            ], FiltersLayout::AboveContent)
            ->actions([
                // Tables\Actions\EditAction::make(),

                // Action::make('invoice')
                //     ->label('Invoice')
                //     ->button()
                //     ->color('info')
                //     ->icon('heroicon-o-check')
                //     ->modalHeading('Invoice Number')
                //     ->action(function ($record, array $data) {
                //         $record->update([
                //             'Status' => 'invoiced',
                //             // 'BranchID' => $data['branch_id'],
                //         ]);
                //     })
                //     ->form([
                //         TextInput::make('Invoice'),
                //     ])
                //     ->requiresConfirmation(),
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
            'index' => Pages\ListOrderInvoiceds::route('/'),
            // 'create' => Pages\CreateOrderInvoiced::route('/create'),
            // 'edit' => Pages\EditOrderInvoiced::route('/{record}/edit'),
        ];
    }
}
