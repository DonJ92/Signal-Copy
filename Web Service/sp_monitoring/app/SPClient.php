<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class SPClient extends Model
{
    protected $table = 'tbl_spclient';

    const CREATED_AT = 'register_date';
    const UPDATED_AT = 'update_date';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'client_id',
        'account_id',
        'vps_id',
        'signal_type',
        'parent_id',
        'active',		    // 활성화기발
        'token'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

	protected $appends = ['vps_name', 'customer_id', 'file_name', 'parent_file_name'];

    public static function generateToken()
    {
        $today = date("Ymd");
        // $rand = rand().microtime();
        $rand = strtoupper(substr(uniqid(sha1(microtime())),0,4));
        
        $token = $today.$rand;

        return $token;
    }

    public static function generate_app_code($application_id) { 
        do
        {
            $token = self::getToken(6, $application_id);
            $code = $token . substr(uniqid(sha1(microtime())),2,4);
            $user_code = self::where('token', $code)->first();
        }
        while(!empty($user_code));

        return $code;
    }

    private static function getToken($length, $seed){    
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvxyz";
        $codeAlphabet.= "0123456789";

        mt_srand($seed);      // Call once. Good since $application_id is unique.

        for($i=0;$i<$length;$i++){
            $token .= $codeAlphabet[mt_rand(0,strlen($codeAlphabet)-1)];
        }
        return $token;
    }

	public function getVPSNameAttribute()
	{
        $vps = VPSList::find($this->vps_id);

		return !is_null($vps) ? $vps->vps_name : '';
	}
	
	public function getCustomerIDAttribute()
	{
        $account = AccountList::find($this->account_id);

		return !is_null($account) ? $account->customer_id : '';
	}

    public function getParentFileNameAttribute()
    {
        if ($this->parent && $this->parent->account) {
            return $this->parent->account->account_id.'-'.$this->parent->account->broker_name.'.txt';
        }
        
        return "";
    }

    public function getFileNameAttribute()
    {
        if ($this->account) {
            return $this->account->account_id.'-'.$this->account->broker_name.'.txt';
        }
        
        return "";
    }

    public function parent()
    {
        return $this->belongsTo('App\SPClient', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\SPClient', 'parent_id');
    }

    // AccountList테이블과 1:1 관계
    public function account()
    {
        return $this->belongsTo('App\AccountList', 'account_id');
    }

    public function vps()
    {
        return $this->belongsTo('App\VPSList', 'vps_id');
    }
}