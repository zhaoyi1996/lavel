<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>微商城-后台</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta name="csrf-token" content="{{csrf_token()}}">
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
<center><h2 style="color:red;">商品添加</h2><a href="/shop"  class="btn btn-info">去展示</a></center>
<form class="form-horizontal" action="/shop/store" method="post" enctype="multipart/form-data" role="form">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_name" id="firstname" 
				   placeholder="请输入商品名称">
				<b style="color:red;">{{$errors->first('goods_name')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_price" id="firstname" 
				   placeholder="请输入商品价格">
				<b style="color:red;">{{$errors->first('goods_price')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品介绍</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" name="goods_desc" id="lastname" 
				   placeholder="请输入商品介绍"></textarea>
				   <b style="color:red;">{{$errors->first('goods_desc')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_num" id="firstname" 
				   placeholder="请输入商品库存">
				<b style="color:red;">{{$errors->first('goods_num')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">赠送积分</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="goods_score" id="lastname" 
				   placeholder="请输入赠送积分">
				   <b style="color:red;">{{$errors->first('goods_score')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品图片</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" name="goods_img" id="lastname" >
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-10">
			<input type="file" class="form-control"  multiple  name="goods_imgs[]" id="lastname" >
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否新品</label>
		<div class="col-sm-10">
			<input type="radio"  name="is_new" id="lastname" value="1" checked >是
            <input type="radio"  name="is_new" id="lastname" value="2" >否   
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否热卖</label>
		<div class="col-sm-10">
			<input type="radio"  name="is_hot" id="lastname" value="1" checked >是
            <input type="radio"  name="is_hot" id="lastname" value="2" >否   
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio"  name="is_up" id="lastname" value="1" checked >是
            <input type="radio"  name="is_up" id="lastname" value="2" >否   
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否精品</label>
		<div class="col-sm-10">
			<input type="radio"  name="is_best" id="lastname" value="1" checked >是
            <input type="radio"  name="is_best" id="lastname" value="2" >否   
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品分类</label>
		<div class="col-sm-10">
			<select name="cate_id" id="">
                <option value="">--请选择--</option>
                @foreach($Catedata as $v)
                <option value="{{$v->cate_id}}">{{str_repeat('——',$v->level)}}{{$v->cate_name}}</option>
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
                <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                @endforeach
            </select>
				<b style="color:red;">{{$errors->first('brand_id')}}</b>
		</div>
	</div>
    
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="button" class="btn btn-default">提交</button>
		</div>
	</div>
</form>
<script>
	$(function(){
		// 商品名称验证
		$(document).on('blur','input[name="goods_name"]',function(){
			$(this).next().empty();
			// 获取当前值
			var goods_name=$(this).val();
			// 非空验证
			if(!goods_name){
				$(this).next().text('商品名称不能为空');
				return;
			}
			// 正则匹配规则
			var reg=/^[u4e00-\u9fa5\w]{2,50}$/;

			if(!reg.test(goods_name)){
				$(this).next().text('商品名称由中文、数字、字母、下划线组成，且不超过50位');
				return;
			}
			$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
			// 唯一性验证
			$.post('/shop/checkName',{goods_name:goods_name},function(res){
				if(res>0){
					$('input[name="goods_name"]').next().text('商品名称已存在');
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
			$(this).next().empty();
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
			$('form').submit();
		})
	})
</script>
</body>
</html>