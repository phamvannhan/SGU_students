<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class PayInterest extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'user_id',
        'company_id',
        'bank_number',
        'bank_name',
        'bank_branch',
        'date_of_investment',
        'amount_of_investment',
        'date_pay',
        'number_of_share',
        'total_share',
        'price_of_share',
        'fixed_money',
        'monthly_interest',
        'real_interest',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function getDateOfInvestmentFormatAttribute()
    {
        return cvDbTime($this->date_of_investment);
    }

    public function getDatePayFormatAttribute()
    {
        return cvDbTime($this->date_pay);
    }
}
