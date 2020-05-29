<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use App\Http\Requests\StoreBrand;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 搜索
        $brand=request()->get('brand');
        // dump($brand);
        $pageSize=config('app.pageSize');
        // dd($pageSize);
        $where=[];
        if($brand){
            $where[]=['brand_name','like',"%$brand%"];
        }
        // 查询品牌信息
        $BrandData=Brand::where($where)->paginate($pageSize);
        if(request()->ajax()){
            return view('admin.brand.ajaxindex',['BrandData'=>$BrandData,'brand'=>$brand]);
        }
        // dd($BrandData);
        return view('admin.brand.index',['BrandData'=>$BrandData,'brand'=>$brand]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    // 第二种表单验证
    public function store(Request $request)
    // public function store(StoreBrand $request)
    {
        // 第一种表单验证
        // $validatedData = $request->validate(
        //     [
        //         'brand_name' => 'required|unique:brand',
        //         'brand_url' => 'required', 
        //     ],[
        //         'brand_name.required'=>'品牌名称必填',
        //         'brand_name.unique'=>'品牌名称已存在',
        //         'brand_url.required'=>'品牌网址必填',
        //     ]
        // );
        $data=$request->except('_token');
        // dd($data);
        if ($request->hasFile('brand_img')) { 
            $data['brand_img']=upload('brand_img');
         }
        // dump($data);
        $res=Brand::insert($data);
        // dd($res);
        if($res){
            return redirect('/brand');
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
        $data=Brand::where('brand_id',$id)->first();
        return view('admin.brand.edit',['data'=>$data]);
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
        $validatedData = $request->validate(
                [
                    'brand_name' => 'required|unique:brand',
                    'brand_url' => 'required', 
                ],[
                    'brand_name.required'=>'品牌名称必填',
                    'brand_name.unique'=>'品牌名称已存在',
                    'brand_url.required'=>'品牌网址必填',
                ]
            );
        $data=$request->except('_token');
        // dd($data);
        if ($request->hasFile('brand_img')) { 
            $data['brand_img']=upload('brand_img');
         }
        $res=Brand::where('brand_id',$id)->update($data);
        if($res!==false){
            return redirect('/brand');
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
        $res=Brand::where('brand_id',$id)->delete();
        if($res){
            return redirect('/brand');
        }
    }
}
