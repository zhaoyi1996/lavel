<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
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
<center><h2 style="color:red;">品牌修改</h2><a href="/brand"  class="btn btn-info">去展示</a></center>
<form class="form-horizontal" action="{{url('/brand/update/'.$data->brand_id)}}" method="post" enctype="multipart/form-data" role="form">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="brand_name" value="{{$data->brand_name}}" id="firstname" 
				   placeholder="请输入品牌名称">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌网址</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="brand_url" value="{{$data->brand_url}}" id="lastname" 
				   placeholder="请输入品牌网址">
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌图片</label>
		<div class="col-sm-10">
		@if($data->brand_img)<img src="{{env('APP_URL')}}{{$data->brand_img}}" width="100" alt="">@endif
			<input type="file" class="form-control" name="brand_img" id="lastname" >
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌简介</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" name="brand_desc" id="lastname" 
				   placeholder="请输入品牌简介">{{$data->brand_desc}}</textarea>
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