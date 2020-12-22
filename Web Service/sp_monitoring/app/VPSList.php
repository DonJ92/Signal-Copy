<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class VPSList extends Model
{
    protected $table = 'tbl_vps_list';

    const CREATED_AT = 'register_date';
    const UPDATED_AT = 'update_date';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'customer_id',
        'vps_name',
        'vps_ip',
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
}