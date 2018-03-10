<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Contact extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'contacts';

    protected $fillable = [
        'user_id',
        'room_id',
        'title',
        'content'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function room(){
        return $this->belongsTo(ContactRoom::class, 'room_id');
    }
}
