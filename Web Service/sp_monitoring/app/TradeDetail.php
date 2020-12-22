<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class TradeDetail extends Model
{
    protected $table = 'tbl_trade_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'account_id',
        'symbol',
        'pos_profit_s',
        'pos_profit_b',
        'pos_cnt_s',
        'pos_cnt_b',
        'pos_lots_s',
        'pos_lots_b',
        'lmt_cnt_s',
        'lmt_cnt_b',
        'lmt_lots_s',
        'lmt_lots_b',
        'stp_cnt_s',
        'stp_cnt_b',
        'stp_lots_s',
        'stp_lots_b'
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