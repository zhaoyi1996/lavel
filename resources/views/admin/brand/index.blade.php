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
	<center><h2 style="color:red;">品牌展示</h2><a href="/brand/create"  class="btn btn-info">去添加品牌</a></center>
    <form>
        品牌名称：<input type="text" name="brand" value="{{$brand}}">
        <input type="submit" class="btn btn-primary btn-sm" value="搜索">
    </form>
   <thead>
      <tr>
         <th>品牌id</th>
         <th>品牌名称</th>
         <th>品牌地址</th>
         <th>品牌图片</th>
         <th>品牌介绍</th>
         <th>操作</th>
      </tr>
   </thead>
   <tbody id="1">
        @foreach($BrandData as $v)
        <tr>
            <td>{{$v->brand_id}}</td>
            <td>{{$v->brand_name}}</td>
            <td>{{$v->brand_url}}</td>
            <td>@if($v->brand_img)<img src="{{env('APP_URL')}}{{$v->brand_img}}" width="100" alt="">@endif</td>
            <td>{{$v->brand_desc}}</td>
            <td>
                <a href="{{url('/brand/destroy/'.$v->brand_id)}}" class="btn btn-warning">删除|</a>
                <a href="{{url('/brand/edit/'.$v->brand_id)}}"  class="btn btn-danger">|修改</a>
            </td>
        </tr>
        @endforeach
        <tr>
            <td>{{$BrandData->appends(['brand'=>$brand])->links()}}</td>
        </tr>
   </tbody>
</table>

</body>
</html>
<script>
    $(function(){
        $(document).on('click','.page-item a',function(){
            // 获取地址信息
            var url=$(this).attr('href');
            $.get(url,function(res){
                $('#1').html(res);
            });
            return false;
        });
    });
</script>