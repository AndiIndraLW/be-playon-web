<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'tag' => 'array',
            'gallery' => 'array',
            'year' => 'integer',
        ];
    }
}
