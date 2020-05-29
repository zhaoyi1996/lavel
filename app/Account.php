<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    //
    protected $table="account";
    protected $primaryKey="account_id";
    // 设置时间戳
    public $timestamps=false;
}
