<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Essay extends Model
{
    //
    protected $table="essay";
    protected $primaryKey="essay_id";
    // 设置时间戳
    public $timestamps=false;
}
