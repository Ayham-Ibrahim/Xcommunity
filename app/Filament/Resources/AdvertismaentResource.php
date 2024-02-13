<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Advertismaent;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AdvertismaentResource\Pages;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use App\Filament\Resources\AdvertismaentResource\RelationManagers;

class AdvertismaentResource extends Resource
{
    protected static ?string $model = Advertismaent::class;

    protected static ?string $navigationIcon = 'heroicon-s-megaphone';

    protected static ?string $navigationGroup = 'Sections';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\Hidden::make('section_id')
                    ->default(6)
                    ->required(),
                Forms\Components\MarkdownEditor::make('discription')
                    ->maxLength(65535)
                    ->columnSpanFull()
                    ->required(),
                Forms\Components\MarkdownEditor::make('trainning_topics')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\MarkdownEditor::make('details')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\MarkdownEditor::make('tarinning_outcomes')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('reservation')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('cost')
                    ->required()
                    ->numeric()
                    ->prefix('S.p'),
                Forms\Components\FileUpload::make('image')
                ->image()
                ->preserveFilenames()
                ->directory('images/advertisments')
                ->getUploadedFileNameForStorageUsing(
                    fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                        ->prepend(now()->timestamp),
                )
                ->enableOpen()
                ->enableDownload()
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('cost')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('discription')
                    ->searchable(),
                Tables\Columns\TextColumn::make('reservation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('section.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ViewAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListAdvertismaents::route('/'),
            'create' => Pages\CreateAdvertismaent::route('/create'),
            'view' => Pages\ViewAdvertismaent::route('/{record}'),
            'edit' => Pages\EditAdvertismaent::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
