<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class System extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "systems";

    protected $fillable = [
        "key",
        "content"
    ];

    public $system_key = [
        'contact_email',
        'hotline',
        'role_access_app'
    ];

    public static function content($key, $default = null)
    {
        $model = self::select("content")->where('key', $key)->first();
        return $model ? $model->content : $default;
    }
}
