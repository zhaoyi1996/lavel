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
<center><h2 style="color:red;">分类添加</h2><a href="/cate"  class="btn btn-info">去展示</a></center>
<form class="form-horizontal" action="{{url('/cate/update/'.$CateData->cate_id)}}" method="post" role="form">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="cate_name" id="firstname" 
				   placeholder="请输入品牌名称" value="{{$CateData->cate_name}}">
                <b style="color:red;">{{$errors->first('cate_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">所属分类</label>
		<div class="col-sm-10">
			<select name="p_id" >
            <option value="">--请选择--</option>
            @foreach($data as $v)
                <option value="{{$v->cate_id}}"{{$CateData->p_id==$v->cate_id?'selected':''}}>{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</option>
            @endforeach
            </select>
            <b style="color:red;">{{$errors->first('p_id')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio"  name="cate_show" id="lastname" value="1"{{$CateData->cate_show==1?'checked':''}} >是
            <input type="radio"  name="cate_show" id="lastname" value="2"{{$CateData->cate_show==2?'checked':''}} >否
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否在前台显示</label>
		<div class="col-sm-10">
            <input type="radio"  name="cate_nav_show" id="lastname" value="1" {{$CateData->cate_nav_show==1?'checked':''}}>是
            <input type="radio"  name="cate_nav_show" id="lastname" value="2" {{$CateData->cate_nav_show==2?'checked':''}}>否
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类描述</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" name="cate_desc" id="firstname" 
				   placeholder="请输入分类描述">{{$CateData->cate_desc}}</textarea>
                <b style="color:red;">{{$errors->first('cate_desc')}}</b>
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