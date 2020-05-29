<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
    protected $table="admin";
    protected $primaryKey="admin_id";
    // 设置时间戳
    public $timestamps=false;
}
