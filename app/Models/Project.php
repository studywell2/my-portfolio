<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'description',
        'image_path',
        'gallery',
        'project_url',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'gallery' => 'array',
        'is_featured' => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getThumbnailUrlAttribute()
    {
        return $this->image_path
            ? asset('storage/' . $this->image_path)
            : asset('images/project-placeholder.svg');
    }
}
