<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiPasswordReset extends Model
{
    protected $table = "api_password_reset";

    protected $fillable = [
        "user_id",
        "token"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
