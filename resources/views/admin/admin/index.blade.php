<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>后台-管理员管理</title>
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
	<center><h2 style="color:red;">管理员展示</h2><a href="/admin/create"  class="btn btn-info">去添加</a></center>

   <thead>
      <tr>
         <th>管理员id</th>
         <th>管理员名称</th>
         <th>管理员电话</th>
         <th>管理员邮箱</th>
         <th>管理员头像</th>
         <th>添加时间</th>
         <th>操作</th>
      </tr>
   </thead>
   <tbody id="1">
        @foreach($data as $v)
        <tr>
            <td>{{$v->admin_id}}</td>
            <td>{{$v->admin_name}}</td>
            <td>{{$v->admin_tel}}</td>
            <td>{{$v->admin_email}}</td>
            <td>@if($v->admin_img)<img src="{{env('APP_URL')}}{{$v->admin_img}}" width="100" alt="">@endif</td>
            <td>{{date('Y-m-d H:i:s',$v->admin_time)}}</td>
            <td>
                <a href="{{url('/admin/destroy/'.$v->admin_id)}}" class="btn btn-warning">删除|</a>
                <a href="{{url('/admin/edit/'.$v->admin_id)}}"  class="btn btn-danger">|修改</a>
            </td>
        </tr>
        @endforeach
        <tr>
            <td>{{$data->links()}}</td>
        </tr>
   </tbody>
</table>

</body>
</html>
<script>
    // $(function(){
    //     $(document).on('click','.page-item a',function(){
    //         // 获取地址信息
    //         var url=$(this).attr('href');
    //         $.get(url,function(res){
    //             $('#1').html(res);
    //         });
    //         return false;
    //     });
    // });
</script>