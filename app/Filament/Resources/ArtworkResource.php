<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArtworkResource\Pages;
use App\Filament\Resources\ArtworkResource\RelationManagers;
use App\Models\Artwork;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArtworkResource extends Resource
{
    protected static ?string $model = Artwork::class;

    protected static ?string $navigationIcon = 'heroicon-o-paint-brush';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Artwork Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Abstract Harmony')
                            ->helperText('Title of the artwork'),
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->label('Artist')
                            ->helperText('Select the artist who created this artwork'),
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->helperText('Select the category for this artwork'),
                        Forms\Components\TextInput::make('medium')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Acrylic on Canvas, Oil on Canvas')
                            ->helperText('Medium used to create the artwork'),
                        Forms\Components\TextInput::make('dimensions')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., 24" x 36"')
                            ->helperText('Dimensions of the artwork'),
                        Forms\Components\TextInput::make('style')
                            ->maxLength(255)
                            ->placeholder('e.g., Abstract, Realism, Impressionism')
                            ->helperText('Artistic style of the artwork'),
                        Forms\Components\TextInput::make('year_created')
                            ->numeric()
                            ->minValue(1900)
                            ->maxValue(date('Y') + 1)
                            ->placeholder('e.g., 2023')
                            ->helperText('Year when the artwork was created'),
                    ])->columns(2),

                Forms\Components\Section::make('Pricing & Details')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('$')
                            ->minValue(0)
                            ->helperText('Enter price in USD'),
                        Forms\Components\TextInput::make('condition')
                            ->maxLength(255)
                            ->placeholder('e.g., Excellent, Good, Fair')
                            ->helperText('Condition of the artwork'),
                        Forms\Components\TextInput::make('location')
                            ->maxLength(255)
                            ->placeholder('e.g., New York, NY, United States')
                            ->helperText('Location where artwork is available'),
                        Forms\Components\Toggle::make('is_ready_to_hang')
                            ->label('Ready to Hang')
                            ->helperText('Is the artwork ready to hang immediately?'),
                    ])->columns(2),

                Forms\Components\Section::make('Media')
                    ->schema([
                        Forms\Components\TextInput::make('image_url')
                            ->label('Image URL (Optional)')
                            ->url()
                            ->placeholder('https://example.com/image.jpg')
                            ->helperText('Enter an image URL or upload a file below')
                            ->live(onBlur: true)
                            ->rules(['nullable', 'url']),
                        Forms\Components\FileUpload::make('image_file')
                            ->label('Or Upload Image File')
                            ->image()
                            ->directory('artworks')
                            ->helperText('Upload an image file (JPEG, PNG, WebP)')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(5120) // 5MB
                            ->live(onBlur: true),
                        Forms\Components\ViewField::make('image_preview')
                            ->view('filament.components.image-preview')
                            ->label('Current Image Preview')
                            ->visible(fn ($record) => $record && ($record->image_url || $record->image_file)),
                        Forms\Components\Textarea::make('description')
                            ->rows(4)
                            ->placeholder('Describe the artwork, its inspiration, techniques used, etc.')
                            ->helperText('Detailed description of the artwork')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('display_image_url')
                    ->size(60)
                    ->label('Image')
                    ->extraAttributes(['class' => 'rounded-lg']),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->sortable()
                    ->label('Artist'),
                Tables\Columns\TextColumn::make('category.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('medium')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('dimensions')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('year_created')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('style')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('is_ready_to_hang')
                    ->boolean()
                    ->label('Ready to Hang'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name'),
                Tables\Filters\SelectFilter::make('artist')
                    ->relationship('user', 'name'),
                Tables\Filters\TernaryFilter::make('is_ready_to_hang')
                    ->label('Ready to Hang'),
                Tables\Filters\Filter::make('price_range')
                    ->form([
                        Forms\Components\TextInput::make('price_min')
                            ->numeric()
                            ->placeholder('Min Price'),
                        Forms\Components\TextInput::make('price_max')
                            ->numeric()
                            ->placeholder('Max Price'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['price_min'],
                                fn (Builder $query, $price): Builder => $query->where('price', '>=', $price),
                            )
                            ->when(
                                $data['price_max'],
                                fn (Builder $query, $price): Builder => $query->where('price', '<=', $price),
                            );
                    }),
                Tables\Filters\SelectFilter::make('year_created')
                    ->options([
                        '2020' => '2020',
                        '2021' => '2021',
                        '2022' => '2022',
                        '2023' => '2023',
                        '2024' => '2024',
                        '2025' => '2025',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('mark_ready_to_hang')
                        ->label('Mark as Ready to Hang')
                        ->icon('heroicon-o-check-circle')
                        ->action(function ($records) {
                            $records->each(function ($record) {
                                $record->update(['is_ready_to_hang' => true]);
                            });
                        })
                        ->requiresConfirmation(),
                    Tables\Actions\BulkAction::make('mark_not_ready_to_hang')
                        ->label('Mark as Not Ready to Hang')
                        ->icon('heroicon-o-x-circle')
                        ->action(function ($records) {
                            $records->each(function ($record) {
                                $record->update(['is_ready_to_hang' => false]);
                            });
                        })
                        ->requiresConfirmation(),
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
            'index' => Pages\ListArtworks::route('/'),
            'create' => Pages\CreateArtwork::route('/create'),
            'view' => Pages\ViewArtwork::route('/{record}'),
            'edit' => Pages\EditArtwork::route('/{record}/edit'),
        ];
    }
}
