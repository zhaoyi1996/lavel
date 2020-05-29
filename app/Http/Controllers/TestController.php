<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function index(){
        echo '嘻嘻哈哈';
    }
    public function admin(){
        echo '呼呼哈嘿';
    }
    public function addDo(){
        echo '恭喜你，跳转成功';
    }
}
