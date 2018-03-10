<?php

namespace App\Models;

use App\Traits\ModelEventTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class NewsCategory extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "news_categories";

    protected static $caches = [
        'categories_has_news'
    ];

    protected $fillable = [
        "icon",
        'name',
        'description',
        "position"
    ];

    public function newses()
    {
        return $this->hasMany(News::class, 'category_id');
    }
}
