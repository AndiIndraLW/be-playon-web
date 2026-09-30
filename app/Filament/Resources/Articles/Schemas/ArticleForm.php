<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ArticleForm
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
                DateTimePicker::make('published_at')
                    ->default(now()),
                FileUpload::make('featured_image')
                    ->image()
                    ->directory('articles/featured')
                    ->columnSpanFull(),
                FileUpload::make('gallery')
                    ->multiple()
                    ->image()
                    ->directory('articles/gallery')
                    ->columnSpanFull(),
                RichEditor::make('description')
                    ->columnSpanFull(),
            ]);
    }
}
