<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class AccountDetail extends Model
{
    protected $table = 'tbl_account_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'broker_name',
        'account_id',
        'is_real',
        'currency',
        'unit_lots',
        'balance',
        'equity',
        'margin',
        'free_margin',
        'margin_level',
        'pos_profit',
        'daily_profit',
        'deposit'
    ];

    protected $casts = [
        'is_real' => 'boolean'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

	public function account()
    {
        return $this->belongsTo('App\AccountList', 'account_id');
    }
}