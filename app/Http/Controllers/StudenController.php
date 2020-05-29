<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class StudenController extends Controller
{
    public function list(){
        dump('恭喜您，跳转成功！');
        
    }
    public function create(){
        return view('studen.create');
    }
    public function store(){
       
        return redirect('/studen');
    }
}
