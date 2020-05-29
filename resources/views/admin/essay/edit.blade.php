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
			<li><a href="/shop">商品管理</a></li>
			<li><a href="/brand">商品品牌管理</a></li>
			<li><a href="/cate">商品分类管理</a></li>
			<li><a href="/admin">管理员管理</a></li>
            <li  class="active"><a href="/essay">文章管理</a></li>
		</ul>
	</div>
	</div>
</nav>
<center><h2 style="color:red;">文章添加</h2><a href="/essay"  class="btn btn-info">去展示</a></center>
<form class="form-horizontal" action="{{url('/essay/update/'.$data->essay_id)}}" method="post" enctype="multipart/form-data" role="form">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章标题</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="essay_name" value="{{$data->essay_name}}" id="firstname" 
				   placeholder="请输入文章标题">
                <b style="color:red;">{{$errors->first('essay_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章分类</label>
		<div class="col-sm-10">
			<select name="e_id" >
            <option value="">--请选择--</option>
            @foreach($Etypedata as $v)
                <option value="{{$v->e_id}}"{{$data->e_id==$v->e_id?'selected':''}}>{{$v->e_name}}</option>
            @endforeach
            </select>
            <b style="color:red;">{{$errors->first('e_id')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章重要性</label>
		<div class="col-sm-10">
			<input type="radio"  name="is_sign" id="lastname" value="1" {{$data->is_sign==1?'checked':''}} >普通
            <input type="radio"  name="is_sign" id="lastname" value="2"  {{$data->is_sign==2?'checked':''}}>置顶
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio"  name="is_up" id="lastname" value="1"  {{$data->is_up==1?'checked':''}}>是
            <input type="radio"  name="is_up" id="lastname" value="2" {{$data->is_up==2?'checked':''}}>否
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章作者</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="essay_man" value="{{$data->essay_man}}" id="firstname" 
				   placeholder="请输入文章作者">
                <b style="color:red;">{{$errors->first('essay_man')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">作者email</label>
		<div class="col-sm-10">
			<input type="email" class="form-control" name="essay_email" value="{{$data->essay_email}}" id="firstname" 
				   placeholder="请输入作者email">
                <b style="color:red;">{{$errors->first('essay_email')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">关键字</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="essay_key" value="{{$data->essay_key}}" id="firstname" 
				   placeholder="请输入文章关键字">
                <b style="color:red;">{{$errors->first('essay_key')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">网页描述</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" name="essay_desc" id="firstname" 
				   placeholder="请输入网页描述">{{$data->essay_desc}}</textarea>
                <b style="color:red;">{{$errors->first('essay_desc')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">上传文件</label>
		<div class="col-sm-10">
        @if($data->essay_img)
            <img src="{{env('APP_URL')}}{{$data->essay_img}}" width="100" alt="">
        @endif
			<input type="file" class="form-control" name="essay_img" id="firstname">
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