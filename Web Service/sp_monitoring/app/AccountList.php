<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class AccountList extends Model
{
    protected $table = 'tbl_account_list';

    const CREATED_AT = 'register_date';
    const UPDATED_AT = 'update_date';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'customer_id',		// 고객식별자
		'account_id',		// 플랫폼 구좌식별자, @Note: 다른 테이블에서 ForeignKey로 리용되는 account_id와 혼동하지 말것(ForeignKey에서는 id값이 리용됨)
        'broker_id',		// 플랫폼 브로커ID
        'register_date',
        'update_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

	public function accountdetail()
    {
        return $this->hasOne('App\AccountDetail', 'account_id');
    }

    public function tradedetail()
    {
        return $this->hasMany('App\TradeDetail', 'account_id');
    }

    public function spclient()
    {
        // return $this->belongsTo('App\SPClient', 'id', 'account_id');
        return $this->hasOne('App\SPClient', 'account_id', 'id');
    }

    public function broker()
    {
        return $this->belongsTo('App\Broker');
    }

    public function scopeHasBroker($query, $broker_name)
    {
        return $query->whereHas('broker', function($q) use($broker_name) {
            $q->where('name', $broker_name);
        });
    }
}