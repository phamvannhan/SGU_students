<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ContactRoom extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'contact_rooms';

    protected $fillable = [
        'name',
        'email',
    ];
}
