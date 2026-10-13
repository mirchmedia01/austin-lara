<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    protected $fillable = [
        'page_key',
        'label',
        'seo_title',
        'seo_description',
        'og_image',
    ];
}
