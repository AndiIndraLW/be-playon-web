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
                    ->acceptedFileTypes(['video/mp4', 'video/webm'])
                    ->directory('homepage'),
                TextInput::make('hero_title')
                    ->maxLength(255),
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
