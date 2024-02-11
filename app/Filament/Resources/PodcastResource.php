<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Podcast;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\ChildCategory;
use Filament\Resources\Resource;
use App\Http\Traits\NotificationTrait;
use Filament\Pages\Actions\RestoreAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\ForceDeleteAction;
use App\Filament\Resources\PodcastResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PodcastResource\RelationManagers;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class PodcastResource extends Resource
{
    use NotificationTrait;

    protected static ?string $model = Podcast::class;

    protected static ?string $navigationIcon = 'heroicon-o-microphone';
    protected static ?string $navigationGroup = 'Sections';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('podcast_list_id')
                    ->relationship('podcastList', 'title')
                    ->required(),
                Forms\Components\Select::make('child_category_id')
                    ->relationship('childCategory', 'id')
                    ->options(ChildCategory::pluck('name','id')->all())
                    ->required(),
                Forms\Components\TextInput::make('section_id')
                    ->required()
                    ->default(2)
                    ->numeric(),
                Forms\Components\FileUpload::make('voice')
                    ->required()
                    ->preserveFilenames()
                    ->directory('files/podcasts')
                    ->getUploadedFileNameForStorageUsing(
                        fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                            ->prepend(now()->timestamp),
                    )
                    ->enableOpen()
                    ->enableDownload(),
                Forms\Components\TextInput::make('duration')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('text_file')
                    ->preserveFilenames()
                    ->directory('files/podcast/podcast-text')
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
                Tables\Columns\TextColumn::make('podcastList.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('childCategory.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('section.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('voice')
                    ->searchable(),
                Tables\Columns\TextColumn::make('duration')
                    ->searchable(),
                Tables\Columns\TextColumn::make('text_file')
                    ->searchable(),
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
            'index' => Pages\ListPodcasts::route('/'),
            'create' => Pages\CreatePodcast::route('/create'),
            'edit' => Pages\EditPodcast::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }


    public function create($record) {
        // Intercept creation process
        parent::create($record);

        // If creation is successful, send notification
        $title = 'New Podcast Added';
        $body = 'A new podcast has been added.';
        $item_id = $record->getKey();
        $item_type = 'podcast';
        $this->sendNotification($title, $body, $item_id, $item_type);
    }


}
