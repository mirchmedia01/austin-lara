<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'excerpt',
        'category',
        'date_label',
        'image',
        'image_alt',
        'body_html',
        'body_view',
        'seo_title',
        'seo_description',
        'is_public',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_public' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    /**
     * Shape a DB row like the legacy BlogPostRepository arrays so all
     * public views keep working unchanged.
     */
    public function toPostArray(): array
    {
        return [
            'slug' => $this->slug,
            'title' => $this->title,
            'excerpt' => $this->excerpt,
            'date' => $this->date_label,
            'image' => $this->image,
            'image_alt' => $this->image_alt,
            'seo_title' => $this->seo_title,
            'seo_desc' => $this->seo_description,
            'category' => $this->category ?: 'Eye Care & Vision',
            'published_at' => $this->published_at,
            'is_public' => $this->is_public,
            // Editor-managed HTML body (null = render legacy Blade view).
            'body_html' => $this->body_html,
            'body_view' => $this->body_view,
            '_db_id' => $this->id,
        ];
    }
}
