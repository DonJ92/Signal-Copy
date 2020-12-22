<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class ParamState extends Model
{
    protected $table = 'tbl_param_state';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'client_id',
        'symbol_name',
        'b_auto_open',
        'b_auto_fill_lots',
        'b_auto_close',
        'b_price_min',
        'b_price_max',
        'b_delta_pt',
        'b_target_pt',
        's_auto_open',
        's_auto_fill_lots',
        's_auto_close',
        's_price_min',
        's_price_max',
        's_delta_pt',
        's_target_pt',
        'b_lots',
        's_lots',
        'balance',
        'equity',
        'margin',
        'free_margin',
        'margin_level',
        'daily_profit',
        'position_profit',
        'point_value',
        'update_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}