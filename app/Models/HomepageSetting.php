<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageSetting extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'company_logos' => 'array',
        ];
    }
}
