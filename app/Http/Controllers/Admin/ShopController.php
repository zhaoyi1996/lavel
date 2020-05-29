<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\Rule;
use App\Shop;
use App\Cate;
use App\Brand;
class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page=config('app.pageSize');
        $atPage=request()->page??'1';
        // dd($atPage);
        // 搜索
        $where=[];
        $name=request()->name;
        $price_min=request()->price_min;
        $price_max=request()->price_max;
        $cate=request()->cate;
        $brand=request()->brand;
        if($name){
            $where[]=['goods_name','like',"%$name%"];
        }
        if($price_min){
            $where[]=['goods_price','>=',$price_min];
        }
        if($price_max){
            $where[]=['goods_price','<=',$price_max];
        }
        if($cate){
            $where[]=['shop.cate_id','=',$cate];
        }
        if($brand){
            $where[]=['shop.brand_id','=',$brand];
        }
        //memecache取
        // $data=Cache::get('shop_'.$atPage.'_'.$name.'_'.$price_min.'_'.$price_max.'_'.$cate.'_'.$brand);
        // 取redis
        $data=Redis::get('shop_'.$atPage.'_'.$name.'_'.$price_min.'_'.$price_max.'_'.$cate.'_'.$brand);
        // dump($data);
        if(!$data){
            $data=Shop::select('shop.*','cate_name','brand_name')
                        ->leftjoin('shop_cate','shop.cate_id','=','shop_cate.cate_id')
                        ->leftjoin('brand','brand.brand_id','=','shop.brand_id')
                        ->where($where)
                        ->paginate($page);
            // 存memcache
            //序列化
            $data=serialize($data);
            
            Redis::setex('shop_'.$atPage.'_'.$name.'_'.$price_min.'_'.$price_max.'_'.$cate.'_'.$brand,30,$data);
        }
        // 反序列化
        $data=unserialize($data);
        // dd($data);   
        // 查询分类数据
        $Catedata=Cate::get();
        // dd($data);
        $Catedata=getCateInfo($Catedata);
        // 获取品牌信息
        $Branddata=Brand::get();
        return view('admin.shop.index',['data'=>$data,'Catedata'=>$Catedata,'Branddata'=>$Branddata,'name'=>$name,'price_min'=>$price_min,'price_max'=>$price_max,'cate'=>$cate,'brand'=>$brand]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 查询分类数据
        $Catedata=Cate::get();
        // dd($data);
        $Catedata=getCateInfo($Catedata);
        // 获取品牌信息
        $Branddata=Brand::get();
        
        
        return view('admin.shop.create',['Catedata'=>$Catedata,'Branddata'=>$Branddata]);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // 验证
        $validatedData = $request->validate(
            [
                // 'goods_name' => 'required|unique:shop|regex:/^[\u4e00-\u9fa5]{2,50}$/',
                'goods_name' => 'required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u|unique:shop',
                'goods_num' => 'required|numeric|between:1,99999999', 
                'goods_price' => 'required|numeric', 
                'cate_id' => 'required', 
                'brand_id' => 'required',
            ],[
                'goods_name.required'=>'商品名称必须填写',
                'goods_name.regex'=>'商品名称有汉字、字母、数字、下划线组成',
                'goods_name.unique'=>'商品名称已存在',
                'goods_num.required'=>'商品库存必须填写',
                'goods_num.numeric'=>'商品库存必须是数字',
                'goods_num.between'=>'商品库存不能大于8位',
                'goods_price.required'=>'商品价格必须填写',
                'goods_price.numeric'=>'商品价格必须是数字',
                'cate_id.required'=>'商品分类必须选择',
                'brand_id.required'=>'商品品牌必须选择',
            ]
        );
        $data=$request->except('_token');
        if ($request->hasFile('goods_img')) { 
            $data['goods_img']=upload('goods_img');
        }
        
        // dd($data);
        if (isset($data['goods_imgs'])) { 
            $data['goods_imgs']=uploads('goods_imgs');
        }
        // dd($data);
        $res=Shop::insert($data);
        if($res){
            return redirect('/shop');
        }
    }
    
    // 相册处理
    // public function uploads($name){
    //     $file = request()->file($name);
    //     static $paths='';
    //     foreach($file as $v){
    //         if ($v->isValid()){
    //             $paths .=$v->store('uploads').',';
    //         }
    //     }
    //     $paths=substr($paths, 0, -1);
    //     return $paths;
    // }
   
    // 商品名称ajax验证
    public function checkName(){
        $goods_name=request()->goods_name;
        $count=Shop::where('goods_name',$goods_name)->count();
        echo $count;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 查询分类数据
        $Catedata=Cate::get();
        // dd($data);
        $Catedata=getCateInfo($Catedata);
        // 获取品牌信息
        $Branddata=Brand::get();
        $data=Shop::where('goods_id',$id)->first();
        
            // $data['goods_imgs']=explode(',',$data['goods_imgs']);
        
        // dd($data);
        return view('admin.shop.edit',['Catedata'=>$Catedata,'Branddata'=>$Branddata,'data'=>$data]);
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
        // 验证
        // dd($id);
        $validatedData = $request->validate(
            [
                
                // 'goods_name' => 'required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u|unique:shop',
                'goods_name' =>[
                    'regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u',
                    Rule::unique('shop')->ignore($id,'goods_id')
                ],
                'goods_num' => 'required|numeric|between:1,99999999', 
                'goods_price' => 'required|numeric', 
                'cate_id' => 'required', 
                'brand_id' => 'required',
            ],[
                'goods_name.required'=>'商品名称必须填写',
                'goods_name.unique'=>'商品名称已存在',
                'goods_num.required'=>'商品库存必须填写',
                'goods_num.numeric'=>'商品库存必须是数字',
                'goods_num.between'=>'商品库存不能大于8位',
                'goods_price.required'=>'商品价格必须填写',
                'goods_price.numeric'=>'商品价格必须是数字',
                'cate_id.required'=>'商品分类必须选择',
                'brand_id.required'=>'商品品牌必须选择',
            ]
        );
        $data=$request->except('_token');
        if ($request->hasFile('goods_img')) { 
            $data['goods_img']=upload('goods_img');
        }
        
        // dd($data);
        if ($request->hasFile('goods_imgs')) { 
            $data['goods_imgs']=uploads('goods_imgs');
        }
        $res=Shop::where('goods_id',$id)->update($data);
        if($res!==false){
            return redirect('/shop');
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
        
        $res=Shop::where('goods_id',$id)->delete();
        if($res){
            return json_encode(['code'=>'00000','msg'=>'删除成功']);
        }
    }
}

