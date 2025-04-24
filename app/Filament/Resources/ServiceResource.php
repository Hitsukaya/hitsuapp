<?php

namespace App\Filament\Resources;

//use App\Filament\Resources\ServiceCategoryResource\Pages\CreateServiceCategory;
//use App\Filament\Resources\ServiceCategoryResource\ServiceCategory;
use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\Pages\EditService;
use App\Filament\Resources\ServiceResource\Pages\ViewService;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Filament\Resources\ServiceResource\Widgets\ServiceStatusStatsWidget;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Pages\Page;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
//use Modules\Services\Entities\ServiceCategory;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Modules\Services\Entities\Service;
use Modules\Services\Enums\ServiceStatus;



class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Services';

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
                        ->directory('services/covers')
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

                            TextInput::make('slug')
                                    ->required()
                                    ->disabled(),

                            Select::make('category_id')
                                ->label('Category')
                                ->relationship('categories', 'name')
                                ->preload()
                                ->nullable(),
                    ])->columns(3),
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
                        ->directory('services/covers')
                        ->required(),
                ])->columnSpan(6),

            Fieldset::make('Status')
                ->schema([
                    ToggleButtons::make('status')
                        ->live()
                        ->inline()
                        ->options(ServiceStatus::class)
                        ->required(),
                    DateTimePicker::make('scheduled_for')
                        ->visible(function ($get) {
                            return $get('status') === ServiceStatus::SCHEDULED->value;
                        })
                        ->required(function ($get) {
                            return $get('status') === ServiceStatus::SCHEDULED->value;
                        })
                        ->native(false),
                    DateTimePicker::make('published_at')
                        ->visible(function ($get) {
                            return $get('status') === ServiceStatus::PUBLISHED->value;
                        })
                        ->required(function ($get) {
                            return $get('status') === ServiceStatus::PUBLISHED->value;
                        })
                        ->native(false),
                    ])->columnSpan(6),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\ImageColumn::make('cover_image')->label('Cover Service'),
            Tables\Columns\TextColumn::make('title')
                ->label('Title')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('slug')
                ->label('Slug')
                ->sortable(),

            TextColumn::make('categories.name')
                ->label('Category')
                ->sortable(),

            Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(function ($state) {
                        return $state->getColor();
                    }),

            Tables\Columns\TextColumn::make('created_at')
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Service')
                ->schema([
                Section::make('General')
                    ->description('')
                    ->schema([
                        //ImageEntry::make('cover_image'),
                        TextEntry::make('title'),
                        TextEntry::make('slug'),
                        TextEntry::make('body_small'),
                    ])->columns(3),

                Section::make('Publish Information')
                    ->schema([
                        TextEntry::make('status')
                            ->badge()->color(function ($state) {
                                return $state->getColor();
                            }),
                        TextEntry::make('published_at')->visible(function (Service $record) {
                            return $record->status === ServiceStatus::PUBLISHED;
                        }),

                        TextEntry::make('scheduled_for')->visible(function (Service $record) {
                            return $record->status === ServiceStatus::SCHEDULED;
                        }),
                    ])->columns(2),
                Section::make('Description')
                    ->schema([
                        TextEntry::make('body_full')
                            ->html()
                            ->columnSpanFull(),
                    ]),
                ]),
        ]);
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            ViewService::class,
            EditService::class,
            //ServiceCategory::class,
           //CreateServiceCategory::class,

        ]);
    }

    public static function getWidgets(): array
    {
        return [
            ServiceStatusStatsWidget::class,
        ];
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'view' => Pages\ViewService::route('/{record}'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
