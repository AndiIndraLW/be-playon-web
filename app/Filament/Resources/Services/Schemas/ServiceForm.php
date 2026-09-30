<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ServiceForm
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
                FileUpload::make('featured_image')
                    ->image()
                    ->directory('services/featured')
                    ->columnSpanFull(),
                FileUpload::make('gallery')
                    ->multiple()
                    ->image()
                    ->directory('services/gallery')
                    ->columnSpanFull(),
                RichEditor::make('description')
                    ->columnSpanFull(),
            ]);
    }
}
