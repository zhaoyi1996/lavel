<?php
/**
 * 公用的方法  返回json数据，进行信息的提示
 * @param $status 状态
 * @param string $message 提示信息
 * @param array $data 返回数据
 */
// 无限极分类
function getCateInfo($data,$pid=0,$level=1){
    if(!$data){
        return;
    }
    // 定义一个静态变量
    static $info=[];
    foreach($data as $v){
        if($v->p_id==$pid){
            $v->level=$level;
            $info[]=$v;
            getCateInfo($data,$v->cate_id,$v->level+1);
        }
    }
    // dd($info);
    return $info;
}
// 上传图片处理
function upload($name){
    $file = request()->file($name);
    if (request()->file($name)->isValid()){
        $path =$file->store('uploads');
    }
    return $path;
}
//多文件上传
function uploads($name){
    // 接受多文件上传
    $files = request()->file($name);
    if(!count($files)){
       return;
    }
    
        static $paths=[];
        foreach($files as $v){
            $paths[]=$v->store('uploads');
        }
    $paths=implode(',',$paths);
    return $paths;
}