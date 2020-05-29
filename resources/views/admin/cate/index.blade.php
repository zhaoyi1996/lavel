<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>后台-品牌管理</title>
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
<table class="table">
	<center><h2 style="color:red;">分类展示</h2><a href="/cate/create"  class="btn btn-info">去添加分类</a></center>
    
   <thead>
      <tr>
         <th>分类id</th>
         <th>分类名称</th>
         <th>是否显示</th>
         <th>是否导航显示</th>
         <th>分类描述</th>
         <th>操作</th>
      </tr>
   </thead>
   <tbody>
        @foreach($data as $v)
        <tr>
            <td>{{$v->cate_id}}</td>
            <td>{{str_repeat('——',$v->level)}}{{$v->cate_name}}</td>
            <td>@if($v->cate_show==1)√@endif @if($v->cate_show==2)×@endif</td>
            <td>@if($v->cate_nav_show==1)√@endif @if($v->cate_nav_show==2)×@endif</td>
            <td>{{$v->cate_desc}}</td>
            <td>
                <a href="{{url('/cate/destroy/'.$v->cate_id)}}" class="btn btn-warning">删除|</a>
                <a href="{{url('/cate/edit/'.$v->cate_id)}}"  class="btn btn-danger">|修改</a>
            </td>
        </tr>
        @endforeach
        
   </tbody>
</table>

</body>
</html>