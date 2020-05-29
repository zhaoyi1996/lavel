<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminPost;
use App\Admin;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // //session测试
        // request()->session()->put('name','哈哈');
        // session(['sex'=>'男']);
        // dump(request()->session()->all());
        // echo request()->session()->get('name');
        
        // dump(request()->session()->has('name'));
        // request()->session()->forget('name');
        
        // dump(request()->session()->has('name'));
        // dump(request()->session()->get('name'));
        // dump(request()->session()->exists('name'));

        
        // dump(request()->session()->exists('sex'));
        // echo session('sex');
        // // session(['sex'=>null]);
        // request()->session()->forget('sex');
        // dump(request()->session()->exists('sex'));
        // dump(session('sex'));

        //查询管理员数据
        $page=config('app.pageSize');
        $data=Admin::paginate($page);
        // dd($data);
        return view('admin.admin.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminPost $request)
    {
        $data=$request->except('_token','admin_pwd_confirmation');
        // dd($data);
        if ($request->hasFile('admin_img')) {
            $data['admin_img']=upload('admin_img');
        }
        $data['admin_time']=time();
        $data['admin_pwd']=encrypt($data['admin_pwd']);
        // dd($data);
        $res=Admin::insert($data);
        if($res){
            return redirect('/admin');
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Admin::where('admin_id',$id)->first();
        return view('admin.admin.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminPost $request, $id)
    {
        $data=$request->except('_token','admin_pwd_confirmation');
        // dd($data);
        if ($request->hasFile('admin_img')) {
            $data['admin_img']=upload('admin_img');
        }
        $data['admin_time']=time();
        $res=Admin::where('admin_id',$id)->update($data);
        if($res){
            return redirect('/admin');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Admin::where('admin_id',$id)->delete();
        if($res){
            return redirect('/admin');
        }
    }
    public function checkName(){
        
    }
}
