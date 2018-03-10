<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupPhoneUser extends Model
{
    protected $table = 'group_phone_user';

    protected $fillable = [
        'group_id',
        'user_id',
        'note',
        'called_at',
        'status'
    ];

    const STATUS_DRAFT = 'waiting';
    const STATUS_DONE = 'done';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getLabelStatusAttribute()
    {
        return trans("admin_group_phone.attr.{$this->status}");
    }

    public function getCalledAtFormatAttribute()
    {
        return cvDbTime($this->called_at);
    }
}
