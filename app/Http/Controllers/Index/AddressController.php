<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Address;
use App\Area;
class AddressController extends Controller
{
    public function addressAdd(){
        $area=Area::where('pid',0)->get();
        return view('index.address',['area'=>$area]);
    }
    // 获取区县级信息
    public function addressCity(){
        $id=request()->id;
        $city=Area::where('pid',$id)->get();
        $option='<option value="0">--请选择--</option>';
        foreach($city as $v){
            $option.="<option value='".$v->id."'>".$v->name."</option>";
        }
        return $option;
    }
    // 获取下拉详细信息
    public function addressArea(){
        $id=request()->id;
        $area=Area::where('pid',$id)->get();
        $option='<option value="0">--请选择--</option>';
        foreach($area as $v){
            $option.="<option value='".$v->id."'>".$v->name."</option>";
        }
        return $option;
    }
    // 地址信息添加入库
    public function addressAddDo(){
        $data=request()->except('_token');
        $user=session('user');
        $data['user_id']=$user['user_id'];
        $res=Address::insert($data);
        if($res){
            return redirect('/car');
        }
    }
}
