<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>微商城-后台</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
	<div class="navbar-header">
		<a class="navbar-brand" href="#">商品-后台</a>
	</div>
	<div>
		<ul class="nav navbar-nav">
			<li class="active"><a href="/shop">商品管理</a></li>
			<li><a href="/brand">商品品牌管理</a></li>
			<li><a href="/cate">商品分类管理</a></li>
			<li><a href="/admin">管理员管理</a></li>
		</ul>
	</div>
	</div>
</nav>
<center><h2 style="color:red;">商品修改展示</h2><a href="/shop"  class="btn btn-info">去展示</a></center>
<form class="form-horizontal" action="{{url('/shop/update/'.$data->goods_id)}}" method="post" enctype="multipart/form-data" role="form">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_name" id="firstname" 
				   placeholder="请输入商品名称" value="{{$data->goods_name}}">
				<b style="color:red;">{{$errors->first('goods_name')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_price" id="firstname" 
				   placeholder="请输入商品价格" value="{{$data->goods_price}}">
				<b style="color:red;">{{$errors->first('goods_price')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品介绍</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" name="goods_desc" id="lastname" 
				   placeholder="请输入商品介绍">{{$data->goods_desc}}</textarea>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_num" id="firstname" 
				   placeholder="请输入商品库存" value="{{$data->goods_num}}">
				<b style="color:red;">{{$errors->first('goods_num')}}</b>
		</div>
	</div>
	
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品图片</label>
		<div class="col-sm-10">
            <img src="{{env('APP_URL')}}{{$data->goods_img}}" width="100" alt="">
			<input type="file" class="form-control" name="goods_img" id="lastname" >
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-10">
        @if($data->goods_imgs)
			@php $imgs=explode(',',$data->goods_imgs); @endphp
            @foreach($imgs as $v)
            <img src="{{env('APP_URL')}}{{$v}}" width="30" alt="">
            @endforeach
        @endif
			<input type="file" class="form-control"  multiple  name="goods_imgs[]" id="lastname" >
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否新品</label>
		<div class="col-sm-10">
			<input type="radio"  name="is_new" id="lastname" value="1" {{$data->is_new==1?'checked':''}} >是
            <input type="radio"  name="is_new" id="lastname" value="2" {{$data->is_new==2?'checked':''}}>否   
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否热卖</label>
		<div class="col-sm-10">
			<input type="radio"  name="is_hot" id="lastname" value="1" {{$data->is_hot==1?'checked':''}}>是
            <input type="radio"  name="is_hot" id="lastname" value="2" {{$data->is_hot==2?'checked':''}} >否   
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio"  name="is_up" id="lastname" value="1" {{$data->is_up==1?'checked':''}} >是
            <input type="radio"  name="is_up" id="lastname" value="2" {{$data->is_up==2?'checked':''}}>否   
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否精品</label>
		<div class="col-sm-10">
			<input type="radio"  name="is_best" id="lastname" value="1" {{$data->is_best==1?'checked':''}} >是
            <input type="radio"  name="is_best" id="lastname" value="2" {{$data->is_best==2?'checked':''}}>否   
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品分类</label>
		<div class="col-sm-10">
			<select name="cate_id" id="">
                <option value="">--请选择--</option>
                @foreach($Catedata as $v)
                <option value="{{$v->cate_id}}"{{$data->cate_id==$v->cate_id?'selected':''}}>{{str_repeat('——',$v->level)}}{{$v->cate_name}}</option>
                @endforeach
            </select>
				<b style="color:red;">{{$errors->first('cate_id')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品品牌</label>
		<div class="col-sm-10">
			<select name="brand_id" id="">
                <option value="">--请选择--</option>
                @foreach($Branddata as $v)
                <option value="{{$v->brand_id}}"{{$data->brand_id==$v->brand_id?'selected':''}}>{{$v->brand_name}}</option>
                @endforeach
            </select>
				<b style="color:red;">{{$errors->first('brand_id')}}</b>
		</div>
	</div>
    
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
</form>

</body>
</html>