<?php

declare(strict_types=1);

namespace Awcodes\Palette\Tests\Fixtures\Models;

use Awcodes\Palette\Tests\Database\Factories\PageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'color' => 'array',
        'select_color' => 'array',
    ];

    protected static function newFactory(): PageFactory
    {
        return new PageFactory;
    }
}
