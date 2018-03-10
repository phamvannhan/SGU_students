<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Course extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'courses';

    protected $fillable = [
        "id",
        "name",
        "image_pro1",
        "image_pro2",
        "image_pro3",
        "image_process1",
        "image_process2",
        "image_graduate",
        "courses_year",
        "city_id",
        "start_date"
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id');
    }

    public function getStartDateFormatAttribute()
    {
        return cvDbTime($this->start_date);
    }
}