<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class GroupEmail extends Model implements Transformable
{
    use TransformableTrait;

    const STATUS_DRAFT = 'draft';
    const STATUS_SENT = 'sent';

    protected $table = 'group_email';

    protected $fillable = [
        'subject',
        'content',
        'status',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_email_user', 'group_id', 'user_id');
    }

    public function getLabelStatusAttribute()
    {
        return trans("admin_group_email.attr.{$this->status}");
    }
}
