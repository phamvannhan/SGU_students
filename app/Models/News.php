<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class News extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "news";

    protected $fillable = [
        "category_id",
        "image",
        'title',
        'description',
        "content",
        "active"
    ];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function getLabelActiveAttribute()
    {
        return $this->active ? trans("admin_news.attr.active") : trans("admin_news.attr.un_active");
    }

    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'category_id');
    }
}
