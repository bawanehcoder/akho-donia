<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemResource\Pages;
use App\Filament\Resources\ItemResource\RelationManagers;
use App\Filament\Resources\OptionDetilsRelationManagerResource\RelationManagers\OptionDetilRelationManager;
use App\Models\Category;
use App\Models\Item;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Products and Categories';

    protected static ?string $navigationLabel = 'Products';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                SpatieMediaLibraryFileUpload::make('main_product')
                    ->collection('products')->columnSpan(2),
                // Forms\Components\TextInput::make('CatID')
                //     ->label('Category ID')
                //     ->required(),
                // TextInput::make('category'),
                Select::make('category')
                    ->options(function () {
                        return Category::whereNotNull('Name')->where('blob', 'main-categories')->where('CatID', 0)->pluck('Name', 'id');
                    })                // اختيار المدينة
                    ->required()
                    ->default(2)
                    ->selectablePlaceholder(false)

                    ->preload()
                    ->reactive()  // تحديد الحقل على أنه تفاعلي
                    ->afterStateUpdated(fn($set) => $set('CatID', null)),  // إعادة ضبط حقل الزون عند تغيير المدينة


                Select::make('CatID')
                    // ->relationship('SubCategory', 'name',fn (Builder $query) => $query->where('CatID', $cityId)->pluck('name', 'id'))                  // اختيار المدينة

                    ->options(function (callable $get) {
                        $catID = $get('category');  // الحصول على معرف المدينة المختارة
                        if (!$catID) {
                            $record = request()->route()->parameter('record');
                            $record = Item::find($record);
                            // dd($record->category);
                            $catID = $record->SubCategory->CatID;

                        }
                        return Category::where('CatID', $catID)->pluck('name', 'id');  // جلب الزون المرتبطة بالمدينة
                    })
                    ->required()
                    ->label('Sub Category'),
                // Forms\Components\DatePicker::make('Date')
                //     ->label('Date')
                //     ->required(),
                // Forms\Components\TextInput::make('blob')
                //     ->label('Blob'),
                Forms\Components\TextInput::make('Name')
                    ->label('Name')
                    ->required(),
                Forms\Components\TextInput::make('NameEN')
                    ->label('Name (English)')
                    ->required(),
                Forms\Components\Textarea::make('Description')
                    ->label('Description'),
                Forms\Components\Textarea::make('DescriptionEN')
                    ->label('Description (English)'),
                Forms\Components\Toggle::make('Available')
                    ->label('Available'),
                // Forms\Components\TextInput::make('stock')
                //     ->label('Stock')
                //     ->numeric(),
                Forms\Components\TextInput::make('Price')
                    ->label('Price')
                    ->numeric(),
                // Forms\Components\TextInput::make('Views')
                //     ->label('Views')
                //     ->numeric(),
                Forms\Components\Toggle::make('Special')
                    ->label('Special'),
                // Forms\Components\TextInput::make('operator')
                //     ->label('Operator'),
                // Forms\Components\TextInput::make('ItemID')
                //     ->label('Item ID'),
                // Forms\Components\TextInput::make('ItemType')
                //     ->label('Item Type'),
                // Forms\Components\TextInput::make('R_ItemShortcut')
                //     ->label('Item Shortcut'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('id')->sortable(),
                SpatieMediaLibraryImageColumn::make('main_product')->collection('products'),

                Tables\Columns\TextColumn::make('subCategory.Name')->label('Category'),
                Tables\Columns\TextColumn::make('Date')->label('Date'),
                Tables\Columns\TextColumn::make('Name')->label('Name')->searchable(),
                Tables\Columns\TextColumn::make('NameEN')->label('Name (English)'),
                Tables\Columns\TextColumn::make('Available')->label('Available')->badge(),
                // Tables\Columns\TextColumn::make('stock')->label('Stock'),
                Tables\Columns\TextColumn::make('Price')->label('Price'),
                // Tables\Columns\TextColumn::make('Views')->label('Views'),
                Tables\Columns\TextColumn::make('Special')->label('Special')->badge(),
                // Tables\Columns\TextColumn::make('operator')->label('Operator'),
                // Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
                // Tables\Columns\TextColumn::make('updated_at')->label('Updated At')->dateTime(),
            ])
            ->filters([

                // SelectFilter::make('CatID')
                //     // ->multiple()
                //     ->label('Category')
                //     ->options(function () {
                //         return Category::whereNotNull('Name')->where('blob', 'main-categories')->where('CatID', 0)->pluck('Name', 'id');
                //     })
                //     ->searchable()

                //     ->query(function (Builder $query, array $data) {
                //         // dd($data);
                //         if (isset($data['value'])) {

                //             $cats = Category::where('catID', $data['value'])->pluck('id');

                //             $query->WhereIn('CatID', $cats);

                //             // dd($cats);
                //         }
                //     }),

                // SelectFilter::make('subCategory')
                //     ->relationship('subCategory', 'name')

                //     ->searchable()
                //     ->preload(),



                Filter::make('cats')
                    ->form([
                        Select::make('mainCatID')
                            ->options(function () {
                                return Category::whereNotNull('Name')->where('blob', 'main-categories')->where('CatID', 0)->pluck('Name', 'id');
                            })                // اختيار المدينة
                            ->required()
                            ->reactive()  // تحديد الحقل على أنه تفاعلي
                            ->afterStateUpdated(fn($set) => $set('CatID', null)),  // إعادة ضبط حقل الزون عند تغيير المدينة


                        Select::make('CatID')
                            ->options(function (callable $get) {
                                $cityId = $get('mainCatID');  // الحصول على معرف المدينة المختارة
                                if (!$cityId) {
                                    return [];  // إذا لم تكن هناك مدينة مختارة، لا تعرض شيئًا
                                }
                                return Category::where('CatID', $cityId)->pluck('name', 'id');  // جلب الزون المرتبطة بالمدينة
                            })
                            ->required()
                            ->label('Sub Category'),
                    ])->columnSpan(2)->columns(2)
                    ->query(function (Builder $query, array $data): Builder {
                        // dd($data);
                        if (isset($data['mainCatID'])) {
                            if (isset($data['CatID'])) {
                                return $query->where('CatID', $data['CatID']);
                            }
                            $cats = Category::where('catID', $data['mainCatID'])->pluck('id');

                            return $query->WhereIn('CatID', $cats);
                        }
                        return $query;

                    })

            ], FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            OptionDetilRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }
}
