<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Enter banner title'),

                Forms\Components\TextInput::make('subtitle')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Enter banner subtitle'),

                Forms\Components\TextInput::make('button_text')
                    ->required()
                    ->maxLength(100)
                    ->placeholder('e.g., VIEW DETAILS, EXPLORE NOW'),

                Forms\Components\TextInput::make('button_url')
                    ->required()
                    ->maxLength(500)
                    ->placeholder('e.g., /paintings, /artwork/123')
                    ->helperText('Enter the URL where the button should link to'),

                Forms\Components\FileUpload::make('image')
                    ->label('Banner Image')
                    ->image()
                    ->directory('banners')
                    ->maxSize(2048)
                    ->helperText('Upload an image for the banner (required)')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->required(),

                Forms\Components\ColorPicker::make('background_color')
                    ->label('Background Color')
                    ->default('#667eea')
                    ->required(),

                Forms\Components\ColorPicker::make('text_color')
                    ->label('Text Color')
                    ->default('#ffffff')
                    ->required(),

                Forms\Components\Toggle::make('is_active')
                    ->label('Active')
                    ->default(true)
                    ->helperText('Only active banners will be displayed'),

                Forms\Components\TextInput::make('order')
                    ->label('Display Order')
                    ->numeric()
                    ->default(0)
                    ->helperText('Lower numbers appear first'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->circular()
                    ->size(50),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('subtitle')
                    ->limit(50)
                    ->searchable(),

                Tables\Columns\TextColumn::make('button_text')
                    ->label('Button')
                    ->searchable(),

                Tables\Columns\TextColumn::make('button_url')
                    ->label('URL')
                    ->limit(30)
                    ->searchable(),

                Tables\Columns\ColorColumn::make('background_color')
                    ->label('Background'),

                Tables\Columns\ColorColumn::make('text_color')
                    ->label('Text'),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),

                Tables\Columns\TextColumn::make('order')
                    ->sortable()
                    ->label('Order'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order', 'asc');
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
