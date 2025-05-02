<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Filament\Resources\BlogPostResource\Pages\EditBlogPost;
use App\Filament\Resources\BlogPostResource\Pages\ViewBlogPost;
use App\Filament\Resources\BlogPostResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Modules\Blog\Entities\BlogPost;
use Modules\Blog\Enums\BlogStatus;

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Blog';

    protected static ?string $recordTitleAttribute = 'name';

    protected static int $globalSearchResultsLimit = 5;

    protected static ?int $navigationSort = 1;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Cover Image')
                ->schema([
                    FileUpload::make('cover_image')
                        ->label('Cover Image')
                        ->image()
                        ->disk('public')
                        ->directory('blog/covers')
                        ->required()
                        ->columnSpan(2)
                        ->imagePreviewHeight('200'),
                ])->columnSpan(6),

            Fieldset::make('Title & Slug')
                ->schema([
                    Grid::make()
                        ->schema([
                            TextInput::make('title')
                                ->label('Title')
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (callable $set, $state) {
                                    $set('slug', Str::slug($state));
                                })
                                ->required()
                                ->maxLength(255),

                            TextInput::make('sub_title')
                                ->label('Sub Title')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('slug')
                                    ->required()
                                    ->disabled(),

                            Select::make('category_id')
                                ->label('Category')
                                ->relationship('categories', 'name')
                                ->preload()
                                ->nullable(),

                            CheckboxList::make('tags')
                                ->relationship('tags', 'name')
                                ->columns(2)
                                ->label('Tags')
                                ->required(),
                    ])->columns(3),
                ])->columnSpan(6),

                Fieldset::make('Seo section')
                ->schema([
                    Grid::make()
                        ->schema([
                            TextInput::make('meta_title')
                                ->label('Meta Title')
                                ->maxLength(60)
                                ->required(),

                            Textarea::make('meta_description')
                                ->label('Meta Description')
                                ->maxLength(160)
                                ->rows(3)
                                ->required(),
                        ])->columns(2),
                ])->columnSpan(6),

            Fieldset::make('Small description')
                ->schema([
                    Textarea::make('body_small')
                        ->label('')
                        ->nullable()
                        ->columnSpan(6),
                ])->columnSpan(6),

            Fieldset::make('Full Description')
                ->schema([
                    TiptapEditor::make('body_full')
                        ->label('')
                        ->profile('default')
                        ->columnSpanFull()
                        ->output(TiptapOutput::Html)
                        ->required()
                        ->maxSize(2048)
                        ->disk('public')
                        ->directory('blog/covers')
                        ->required(),
                ])->columnSpan(6),

            Fieldset::make('Status')
                ->schema([
                    ToggleButtons::make('status')
                        ->live()
                        ->inline()
                        ->options(BlogStatus::class)
                        ->required(),
                    DateTimePicker::make('scheduled_for')
                        ->visible(function ($get) {
                            return $get('status') === BlogStatus::SCHEDULED->value;
                        })
                        ->required(function ($get) {
                            return $get('status') === BlogStatus::SCHEDULED->value;
                        })
                        ->native(false),
                    DateTimePicker::make('published_at')
                        ->visible(function ($get) {
                            return $get('status') === BlogStatus::PUBLISHED->value;
                        })
                        ->required(function ($get) {
                            return $get('status') === BlogStatus::PUBLISHED->value;
                        })
                        ->native(false),
                    ])->columnSpan(6),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover_image')
                    ->label('Cover Service'),

                TextColumn::make('title')
                    ->label('Title')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('slug')
                    ->label('Slug')
                    ->sortable(),

                TextColumn::make('categories.name')
                    ->label('Category')
                    ->sortable(),

                TextColumn::make('status')
                        ->badge()
                        ->color(function ($state) {
                            return $state->getColor();
                        }),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->sortable()
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            ViewBlogPost::class,
            EditBlogPost::class,
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
            'index' => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'view' => Pages\ViewBlogPost::route('/{record}'),
            'edit' => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }
}
