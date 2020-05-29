<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EssayPost;
use Illuminate\Support\Facades\Redis;

use Illuminate\Validation\Rule;
use App\Etype;
use App\Essay;
class EssayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 搜索
        $type=request()->type;
        $name=request()->name;
        $where=[];
        if($type){
            $where[]=['essay.e_id','=',$type];
        }
        if($name){
            $where[]=['essay_name','like',"%$name%"];
        }
        $page=config('app.pageSize');
        // 查询分类数据
        $Etypedata=Etype::get();
        // 用redis获取
        $data=Redis::get('essaydata_'.$type.'_'.$name);
        dump($data);
        if(!$data){
            echo 'Db';
            $data=Essay::leftjoin('etype','essay.e_id','=','etype.e_id')->where($where)->paginate($page);
            // dd($data);
            // 将获取的结果集序列化   存入redis
            $data=serialize($data);
            Redis::setex('essaydata_'.$type.'_'.$name,60*5,$data);
            
            // dd($data);
        }
            // 反序列化
            $data=unserialize($data);
            // dd($data);
        
        
        
        
        return view('admin.essay.index',['data'=>$data,'Etypedata'=>$Etypedata,'type'=>$type,'name'=>$name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 查询分类数据
        $Etypedata=Etype::get();
        return view('admin.essay.create',['Etypedata'=>$Etypedata]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EssayPost $request)
    {
       
        $data=$request->except('_token');
        
        if ($request->hasFile('essay_img')) { 
            $data['essay_img']=upload('essay_img');
        }
        $data['essay_time']=time();
        $res=Essay::insert($data);
        if($res){
            return redirect('/essay');
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
        $Etypedata=Etype::get();
        $data=Essay::where('essay_id',$id)->first();
        return view('admin.essay.edit',['Etypedata'=>$Etypedata,'data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EssayPost $request, $id)
    {
       
        $data=$request->except('_token');
        if ($request->hasFile('essay_img')) { 
            $data['essay_img']=upload('essay_img');
        }
        
       
        $res=Essay::where('essay_id',$id)->update($data);
        if($res!==false){
            return redirect('/essay');
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
        // $res=Essay::where('essay_id',$id)->delete();
        //  // 搜索
        //  $type=request()->type;
        //  $name=request()->name;
        //  $where=[];
        //  if($type){
        //      $where[]=['essay.e_id','=',$type];
        //  }
        //  if($name){
        //      $where[]=['essay_name','like',"%$name%"];
        //  }
        //  $page=config('app.pageSize');
        //  // 查询分类数据
        //  $Etypedata=Etype::get();
        //  $data=Essay::leftjoin('etype','essay.e_id','=','etype.e_id')->where($where)->paginate($page);
         
        //  if($res){
        //     return view('admin.essay.delete',['data'=>$data,'Etypedata'=>$Etypedata,'type'=>$type,'name'=>$name]);
        //  }
        
    }
    public function destroys($id){
        $res=Essay::destroy($id);
        // echo $id;
        if($res){
            return json_encode(['code'=>'00000','msg'=>'删除成功']);
        }
    }
}
