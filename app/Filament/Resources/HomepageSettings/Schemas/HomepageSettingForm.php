<?php

namespace App\Filament\Resources\HomepageSettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class HomepageSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('hero_bg_video')
                    ->label('Hero Background Video')
                    ->disk('public')
                    ->visibility('public')
                    ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/quicktime', 'video/x-msvideo'])
                    ->maxSize(512000)
                    ->directory('homepage')
                    ->previewable(false)
                    ->openable()
                    ->downloadable(),
                TextInput::make('hero_title')
                    ->label('Hero Title')
                    ->maxLength(255),
                Textarea::make('hero_subtitle')
                    ->label('Hero Subtitle / Description')
                    ->helperText('Little text displayed beneath the main hero title on the homepage')
                    ->rows(2)
                    ->columnSpanFull(),
                FileUpload::make('company_logos')
                    ->label('Company / Client Logos')
                    ->disk('public')
                    ->visibility('public')
                    ->multiple()
                    ->image()
                    ->reorderable()
                    ->directory('homepage/logos')
                    ->columnSpanFull(),
                Textarea::make('section_1_text')
                    ->rows(4)
                    ->columnSpanFull(),
                TextInput::make('section_1_button_text')
                    ->maxLength(100),
                TextInput::make('section_1_button_link')
                    ->url(),
            ]);
    }
}
