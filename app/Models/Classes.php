<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Classes extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "class";

    protected $fillable = [
        "major_id",
        "class_name",
    ];

    public function major()
    {
        //return $this->belongsTo(NewsCategory::class, 'category_id');
    }

}
