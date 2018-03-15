<?php

namespace App\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Students extends Model implements Transformable
{
    use Notifiable, TransformableTrait;

    protected $fillable = [
        "name",
        "email",
        "start_doanvien",
        "password",
        "remember_token",
        "active"
    ];

    protected $hidden = [
        "password",
        "remember_token",
    ];

    public function getBirthdayFormatAttribute()
    {
        return $this->birthday ? cvDbTime($this->birthday) : null;
    }


}
