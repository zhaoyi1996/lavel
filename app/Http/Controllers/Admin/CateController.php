<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cate;
class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 查询分类信息
        // $page=config('app.pageSize');
        $data=Cate::get();
        $data=getCateInfo($data);
        return view('admin.cate.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 查询分类数据
        $data=Cate::get();
        // dd($data);
        $data=getCateInfo($data);
        // dd($data);
        return view('admin.cate.create',['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [ 
                'cate_name' => 'required|unique:shop_cate',
                'p_id' => 'required',
                'cate_desc'=>'required',
            ],[
                'cate_name.required'=>'分类名称必须填写',
                'cate_name.unique'=>'分类名称已存在',
                'p_id.required'=>'所属分类必须选择',
                'cate_desc.required'=>'分类描述必须填写',
            ]
        );
        $data=$request->except('_token');
        $res=Cate::insert($data);
        if($data){
            return redirect('/cate');
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
        $CateData=Cate::where('cate_id',$id)->first();
        // dd($CateData);
         // 查询分类数据
         $data=Cate::get();
         // dd($data);
         $data=getCateInfo($data);
         return view('admin.cate.edit',['CateData'=>$CateData,'data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validatedData = $request->validate(
            [ 
                'cate_name' => 'required|unique:shop_cate',
                'p_id' => 'required',
                'cate_desc'=>'required',
            ],[
                'cate_name.required'=>'分类名称必须填写',
                'cate_name.unique'=>'分类名称已存在',
                'p_id.required'=>'所属分类必须选择',
                'cate_desc.required'=>'分类描述必须填写',
            ]
        );
        $data=$request->except('_token');
        $res=Cate::where('cate_id',$id)->update($data);
        if($res!==false){
            return redirect('/cate');
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
        // dd($id);
        $res=Cate::where('cate_id',$id)->delete();
        // dd($res);
        if($res){
            return redirect('/cate');
        }
    }
}
