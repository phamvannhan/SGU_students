<?php

namespace App\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Ultraware\Roles\Traits\HasRoleAndPermission;
use Ultraware\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;


class User extends Authenticatable implements Transformable, HasRoleAndPermissionContract
{
    use Notifiable, TransformableTrait, HasRoleAndPermission;

    protected $fillable = [
        "name",
        "email",
        "password",
        "remember_token",
        "last_logon",
        "active",
        "students_code",
        "city_id",
        "phone",
        "facebook",
        "birthday",
        "avatar",
    ];

    protected $hidden = [
        "password",
        "remember_token",
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'user_company', 'user_id', 'company_id')
            ->withPivot('number_of_share', 'date_of_investment', 'amount_of_investment');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function getBirthdayFormatAttribute()
    {
        return $this->birthday ? cvDbTime($this->birthday) : null;
    }

    public function getIdNumberDateFormatAttribute()
    {
        return $this->id_number_date ? cvDbTime($this->id_number_date) : null;
    }

    public function getTotalAssetAttribute()
    {
        $price = 0;
        foreach ($this->companies as $rs) {
            $price += $rs->price_of_share * $rs->pivot->number_of_share;
        }
        return $price;
    }
}
