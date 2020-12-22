<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Broker extends Model
{
    protected $table = 'tbl_brokers';
    
    protected $fillable = [ 'alias_name', 'name' ];
}
