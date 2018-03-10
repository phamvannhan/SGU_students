<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class GroupPhone extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'group_phone';

    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_phone_user', 'group_id', 'user_id')
            ->withPivot('note', 'called_at', 'status');
    }

}
