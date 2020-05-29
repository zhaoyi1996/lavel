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
<center><h2 style="color:red;">管理员添加</h2><a href="/admin"  class="btn btn-info">去展示</a></center>

<form class="form-horizontal" action="/admin/store" method="post" enctype="multipart/form-data" role="form">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="admin_name" id="firstname" 
				   placeholder="请输入管理员名称">
				<b style="color:red;">{{$errors->first('admin_name')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员密码</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" name="admin_pwd" id="lastname" 
				   placeholder="请输入管理员密码">
				   <b style="color:red;">{{$errors->first('admin_pwd')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">确认密码</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" name="admin_pwd_confirmation" id="lastname" 
				   placeholder="请输入管理员密码">
				   
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">手机号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="admin_tel" id="lastname" 
				   placeholder="请输入管理员手机号">
				   <b style="color:red;">{{$errors->first('admin_tel')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">邮箱账号</label>
		<div class="col-sm-10">
			<input type="email" class="form-control" name="admin_email" id="lastname" placeholder="请输入管理员邮箱账号" >
            <b style="color:red;">{{$errors->first('admin_email')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员头像</label>
		<div class="col-sm-10">
			<input type="file" name="admin_img">
            <b style="color:red;">{{$errors->first('admin_img')}}</b>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">提交</button>
		</div>
	</div>
</form>
<script>
	$(function(){
		// 管理员名称验证
		$(document).on('blur','input[name="admin_name"]',function(){
			$(this).next().empty();
			// 获取当前值
			var admin_name=$(this).val();
			// 非空验证
			if(!admin_name){
				$(this).next().text('管理员名称不能为空');
				return;
			}
			// 正则匹配规则
			var reg=/^[u4e00-\u9fa5\w]{2,50}$/;

			if(!reg.test(admin_name)){
				$(this).next().text('管理员名称由中文、数字、字母、下划线组成，且不超过50位');
				return;
			}
			$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
			// 唯一性验证
			$.post('/admin/checkName',{admin_name:admin_name},function(res){
				if(res>0){
					$('input[name="admin_name"]').next().text('管理员名称已存在');
					return;
				}
			})
		})
		// 商品价格验证
		$(document).on('blur','input[name="goods_price"]',function(){
			$(this).next().empty();
			// 获取商品价格的值
			var goods_price=$(this).val();
			// 商品价格非空验证
			if(!goods_price){
				$(this).next().text('商品价格必须填写');
				return;
			}
			// 商品价格规则验证
			var reg=/^\d{1,8}$/;
			if(!reg.test(goods_price)){
				$(this).next().text('商品价格必须由数字组成，且不能超过八位');
				return;
			}
		})
		// 商品库存验证
		$(document).on('blur','input[name="goods_num"]',function(){
			// alert(1);
			$(this).next().empty();
			// 获取库存的值
			var goods_num=$(this).val();
			if(!goods_num){
				$(this).next().text('库存数量必须填写');
				return;
			}
		})
		// 商品介绍验证
		$(document).on('blur','textarea',function(){
			// 获取商品介绍的值
			var goods_desc=$(this).val();
			if(!goods_desc){
				$(this).next().text('商品介绍必须填写');
				return;
			}
		})
		// 提交验证
		$(document).on('click','button',function(){
			// alert(123444);
			var goods_name=$('input[name="goods_name"]').val();
			// 名称非空验证
			if(!goods_name){
				$('input[name="goods_name"]').next().text('商品名称不能为空');
				return;
			}
			// 名称正则匹配规则
			var reg=/^[u4e00-\u9fa5\w]{2,50}$/;

			if(!reg.test(goods_name)){
				$('input[name="goods_name"]').next().text('商品名称由中文、数字、字母、下划线组成，且不超过50位');
				return;
			}
			var flag=true;
			$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
			// 名称唯一性验证
			$.ajax({
				url:'/shop/checkName',
				type:'post',
				data:{goods_name:goods_name},
				async:false,
				success:function(res){
					if(res>0){
						$('input[name="goods_name"]').next().text('商品名称已存在');
						flag=false;
					}
				}
			})
			if(!flag) return;
			// 获取商品价格的值
			var goods_price=$('input[name="goods_price"]').val();
			// 商品价格非空验证
			if(!goods_price){
				$('input[name="goods_price"]').next().text('商品价格必须填写');
				return;
			}
			// 商品价格规则验证
			var regprice=/^\d{1,8}$/;
			if(!regprice.test(goods_price)){
				$('input[name="goods_price"]').next().text('商品价格必须由数字组成，且不能超过八位');
				return;
			}
			// 商品介绍验证
			var goods_desc=$('textarea').val();
			if(!goods_desc){
				$('textarea').next().text('商品介绍必须填写');
				return;
			}
			// 获取库存的值
			var goods_num=$('input[name="goods_num"]').val();
			if(!goods_num){
				$('input[name="goods_num"]').next().text('库存数量必须填写');
				return;
			}
		})
	})
</script>
</body>
</html>