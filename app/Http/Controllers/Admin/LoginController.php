<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function login(){
        return view('admin.login.login');
    }
    public function loginDO(){
        $data=request()->except('_token');
        $admin_data=Admin::where('admin_name',$data['admin_name'])->first();
        // dd($data);
        if(!$admin_data){
            return redirect('/login')->with('msg','用户名或密码错误');
        }
        if($data['admin_pwd']!=decrypt($admin_data->admin_pwd)){
            return redirect('/login')->with('msg','用户名或密码错误');
        }
        
        if(isset($data['admin_cookie'])){
            Cookie::queue('admin',serialize($admin_data),60*24*7);
        }
        session(['admin'=>$data]);
        return redirect('/shop');
    }
    // cookie练习
    public function setcookie(){
        // 设置cookie
        // return response('欢迎来到德莱联盟')->cookie( 'name', '渣渣辉', 1 );

        // Cookie::queue(Cookie::make('name', '一刀999', 1));
        Cookie::queue('name', '嘻嘻哈哈', 1);
    }
    public function getcookie(Request $request){
        // 获取cookie
        $value = $request->cookie('name');
        // $value = Cookie::get('name');
        dd($value);
    }
}
