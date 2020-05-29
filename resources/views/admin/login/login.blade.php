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

<center><h2 style="color:red;">后台登录</h2></center>
<form class="form-horizontal" action="{{url('/login/loginDo')}}" method="post" role="form">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="admin_name" id="firstname" 
				   placeholder="请输入管理员名称">
				<b style="color:red;">{{session('msg')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员密码</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" name="admin_pwd" id="lastname" 
				   placeholder="请输入管理员密码">
				   <b style="color:red;">{{session('msg')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label"></label>
		<div class="col-sm-10">
			<input type="checkbox"  name="admin_cookie" >七天免登陆
				   
		</div>
	</div>
   
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">提交</button>
		</div>
	</div>
</form>

</body>
</html>