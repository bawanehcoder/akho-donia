<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\OrderDetailsRelationManager;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
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

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Orders';
    protected static ?string $navigationLabel = 'New';

    protected static ?int $navigationSort = 16;


    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->where('status', 0);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('Name')
                    ->required(),
                Forms\Components\TextInput::make('Phone')
                    ->required(),

                    Hidden::make('UserID')->default(151),
                Forms\Components\Select::make('delivery_type')
                    ->options([
                        'personal_pickup' => 'Personal Pickup',
                        'delivery_address' => 'Delivery Address',
                    ])
                    ->required()
                    ->reactive(), // لتفعيل التفاعل الديناميكي

                Forms\Components\Select::make('ZoneID')
                    ->label('Zone')
                    ->relationship('zone', 'AddresEn')
                    ->required()
                    ->visible(fn(callable $get) => $get('delivery_type') === 'delivery_address'), // يظهر إذا كان نوع الطلب delivery_address

                Forms\Components\Select::make('BranchID')
                    ->label('Branch')
                    ->relationship('branch', 'AddresEn')
                    ->required()
                    ->visible(fn(callable $get) => $get('delivery_type') === 'personal_pickup'), // يظهر إذا كان نوع الطلب personal_pickup
                Forms\Components\DateTimePicker::make('OrderDate')
                    ->required(),
                // Forms\Components\TimePicker::make('DeliveryTime')
                //     ->required(),

                // Forms\Components\TextInput::make('Phone2'),
                Forms\Components\TextInput::make('address')
                    ->required(),


                Forms\Components\Select::make('action_type')
                    ->label('Action Type') // تسمية الخانة
                    ->options([
                        'deposit' => 'Deposit', // خيار الإيداع
                        'full' => 'full', // خيار آخر كمثال
                    ])
                    ->required()
                    ->reactive(), // لتفعيل التفاعل الديناميكي

                Forms\Components\TextInput::make('deposit_amount')
                    ->label('Deposit Amount') // تسمية الحقل
                    ->numeric() // تأكد من أن الإدخال رقم
                    ->required(fn(callable $get) => $get('action_type') === 'deposit') // اجعل الحقل مطلوبًا إذا كان الخيار "ديبوست"
                    ->visible(fn(callable $get) => $get('action_type') === 'deposit') // يظهر فقط إذا كان الخيار "ديبوست"
                    ->placeholder('Enter the deposit amount'), // نص إرشادي
                // Forms\Components\TextInput::make('ZonePrice')
                //     ->numeric()
                //     ->required(),
                // Forms\Components\TextInput::make('Total')
                //     ->numeric()
                //     ->required(),
                // Forms\Components\TextInput::make('AddValue')
                //     ->numeric(),
                // Forms\Components\TextInput::make('Discount')
                //     ->numeric(),
                // Forms\Components\TextInput::make('Points')
                //     ->numeric(),
                // Forms\Components\Select::make('Status')
                //     ->options([
                //         0 => 'Waiting',
                //         1 => 'Accepted',
                //         2 => 'Rejected',
                //         3 => 'Cancel',
                //         4 => 'invoiced',
                //     ])
                //     ->disabled()
                //     ->default('pending'),
                // Forms\Components\Select::make('PaymentMethod')
                //     ->options([
                //         0 => 'Cash',
                //         1 => 'Credit Card',
                //     ])
                //     ->required(),
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
            ->poll('5s')
            ->columns([
                // Tables\Columns\TextColumn::make('user.name')->label('User ID'),
                // Tables\Columns\TextColumn::make('zone.name')->label('Zone ID'),
                // Tables\Columns\TextColumn::make('delivery_type')->label('Delivery Type'),
                Tables\Columns\TextColumn::make('OrderDate')->label('Order Date'),
                Tables\Columns\TextColumn::make('DeliveryTime')->label('Delivery Time'),
                Tables\Columns\TextColumn::make('Name')->label('Customer Name'),
                Tables\Columns\TextColumn::make('Phone')->label('Phone'),
                // Tables\Columns\TextColumn::make('Phone2')->label('Alternate Phone'),
                // Tables\Columns\TextColumn::make('address')->label('Address'),
                // Tables\Columns\TextColumn::make('ZonePrice')->label('Zone Price'),
                Tables\Columns\TextColumn::make('Total')->label('Total Amount'),
                // Tables\Columns\TextColumn::make('Discount')->label('Discount'),
                Tables\Columns\TextColumn::make('Status')->label('Status'),
                Tables\Columns\TextColumn::make('PaymentMethod')->label('Payment Method'),
                // Tables\Columns\TextColumn::make('PaymentStatus')->label('Payment Status'),
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

                Action::make('accept')
                    ->label('Accept')
                    ->button()
                    ->color('success')
                    ->icon('heroicon-o-check')
                    ->modalHeading('Select Branch')
                    ->action(function ($record, array $data) {
                        $record->update([
                            'Status' => 'accepted',
                            'BranchID' => $data['branch_id'],
                        ]);
                    })
                    ->form([
                        Forms\Components\Select::make('branch_id')
                            ->label('Branch')
                            ->options(fn() => \App\Models\Branche::pluck('AddresEn', 'id'))
                            ->required()
                            ->searchable()
                            ->placeholder('Select Branch'),
                    ])
                    ->requiresConfirmation(),

                Action::make('reject')
                    ->label('Reject')
                    ->button()
                    ->color('danger')
                    ->icon('heroicon-o-exclamation-triangle')
                    // ->modalHeading('Select Branch')
                    ->action(function ($record, array $data) {
                        $record->update([
                            'Status' => 'rejected',
                            // 'BranchID' => $data['branch_id'],
                        ]);
                    })
                    // ->form([
                    //     Forms\Components\Select::make('branch_id')
                    //         ->label('Branch')
                    //         ->options(fn() => \App\Models\Branche::pluck('AddresEn', 'id'))
                    //         ->required()
                    //         ->searchable()
                    //         ->placeholder('Select Branch'),
                    // ])
                    ->requiresConfirmation(),
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
            OrderDetailsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
