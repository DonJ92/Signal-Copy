<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class FileState extends Model
{
    protected $table = 'tbl_file_state';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'file_name',
        'previous_datetime',
        'current_datetime',
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