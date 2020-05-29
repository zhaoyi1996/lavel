<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table="user_index";
    protected $primaryKey="user_id";
    // 设置时间戳
    public $timestamps=false;
}
