<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                TextInput::make('sub_title')
                    ->maxLength(255),
                TextInput::make('year')
                    ->numeric()
                    ->default(date('Y')),
                TagsInput::make('tag')
                    ->placeholder('Add tags...')
                    ->columnSpanFull(),
                FileUpload::make('featured_image')
                    ->image()
                    ->directory('projects/featured')
                    ->columnSpanFull(),
                FileUpload::make('gallery')
                    ->multiple()
                    ->image()
                    ->directory('projects/gallery')
                    ->columnSpanFull(),
                RichEditor::make('description')
                    ->columnSpanFull(),
            ]);
    }
}
