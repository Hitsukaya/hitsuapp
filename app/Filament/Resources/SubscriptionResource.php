<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubscriptionResource\Pages;
use App\Filament\Resources\SubscriptionResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Newsletter\Entities\Subscription;
use Modules\Newsletter\Http\Controllers\NewsletterController;
use Filament\Pages\SubNavigationPosition;


class SubscriptionResource extends Resource
{
    protected static ?string $model = Subscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationGroup = 'Subscribers';

    protected static ?string $navigationLabel = 'Subscriber Newsletter';

    protected static ?string $pluralModelLabel = 'Subscribers';

    protected static ?string $modelLabel = 'Subscriber';

    protected static ?int $navigationSort = 1;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->email()
                    ->maxLength(255),

                TextInput::make('name')
                    ->label('Nume')
                    ->nullable()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('email')->sortable()->searchable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('created_at')->label('Date Subscriber')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('send_newsletter')
                    ->label('Send Newsletter')
                    ->action(function ($record) {
                        $controller = new NewsletterController();
                        $controller->sendNewsletter(request());
                }),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                    Action::make('send_newsletter')
                    ->label('Send Newsletter to All')
                    ->action(function () {
                        $controller = new NewsletterController();
                        $controller->sendNewsletter(request());
                    })
                    ->color('success')
                    ->icon('heroicon-o-envelope')
                    ->requiresConfirmation(),
                ]),
            ]);
    }

    public static function getNavigationLabel(): string
    {
        return 'Newsletter';
    }

    public static function getHeaderActions(): array
    {
        return [
            Action::make('send_newsletter')
                ->label('Send Newsletter to All')
                ->action(function () {
                    $controller = new NewsletterController();
                    $controller->sendNewsletter(request());
                })
                ->color('success')
                ->icon('heroicon-o-envelope')
                ->requiresConfirmation(),
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
            'index' => Pages\ListSubscriptions::route('/'),
            'create' => Pages\CreateSubscription::route('/create'),
            'view' => Pages\ViewSubscription::route('/{record}'),
            'edit' => Pages\EditSubscription::route('/{record}/edit'),
        ];
    }
}
