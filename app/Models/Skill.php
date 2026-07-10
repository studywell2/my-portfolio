<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['name', 'category', 'proficiency', 'icon_class', 'sort_order'];

    protected $casts = [
        'proficiency' => 'integer',
    ];

    public function scopeBackend($query)
    {
        return $query->where('category', 'backend')->orderBy('sort_order');
    }

    public function scopeFrontend($query)
    {
        return $query->where('category', 'frontend')->orderBy('sort_order');
    }

    public function scopeTools($query)
    {
        return $query->where('category', 'tools')->orderBy('sort_order');
    }
}
