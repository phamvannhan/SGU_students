<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class GroupSms extends Model implements Transformable
{
    use TransformableTrait;

    const STATUS_DRAFT = 'draft';
    const STATUS_SENT = 'sent';

    protected $table = 'group_sms';

    protected $fillable = [
    	'id',
        'name',
        'content',
        'status',
    ];

   public function users()
    {
        return $this->belongsToMany(User::class, 'group_sms_user', 'group_id', 'user_id');
    }

    public function getLabelStatusAttribute()
    {
        return trans("admin_group_sms.attr.{$this->status}");
    }

}
