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
<center><h2 style="color:red;">管理员修改</h2><a href="/admin"  class="btn btn-info">去展示</a></center>
<form class="form-horizontal" action="{{url('/admin/update/'.$data->admin_id)}}" method="post" enctype="multipart/form-data" role="form">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="admin_name" value="{{$data->admin_name}}" id="firstname" 
				   placeholder="请输入管理员名称">
				<b style="color:red;">{{$errors->first('admin_name')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员密码</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" name="admin_pwd" value="{{$data->admin_pwd}}" id="lastname" 
				   placeholder="请输入管理员密码">
				   <b style="color:red;">{{$errors->first('admin_pwd')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">确认密码</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" value="{{$data->admin_pwd}}" name="admin_pwd_confirmation" id="lastname" 
				   placeholder="请输入管理员密码">
				   
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">手机号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="admin_tel" value="{{$data->admin_tel}}" id="lastname" 
				   placeholder="请输入管理员手机号">
				   <b style="color:red;">{{$errors->first('admin_tel')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">邮箱账号</label>
		<div class="col-sm-10">
			<input type="email" class="form-control" name="admin_email" value="{{$data->admin_email}}" id="lastname" placeholder="请输入管理员邮箱账号" >
            <b style="color:red;">{{$errors->first('admin_email')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员头像</label>
		<div class="col-sm-10">
        @if($data->admin_img)
            <img src="{{env('APP_URL')}}{{$data->admin_img}}" width="100" alt="">
        @endif
			<input type="file" name="admin_img">
            <b style="color:red;">{{$errors->first('admin_img')}}</b>
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