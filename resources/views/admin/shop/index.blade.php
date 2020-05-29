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
            <li><a href="/essay">文章管理</a></li>
		</ul>
	</div>
	</div>
</nav>
<table class="table">
	<center><h2 style="color:red;">商品展示</h2><a href="/shop/create"  class="btn btn-info">去添加分商品</a></center>
    <form>
        商品名称：<input type="text" name="name" placeholder="请输入商品关键字" value="{{$name}}">
        商品价格：<input type="text" name="price_min" placeholder="请输入商品最低价" value="{{$price_min}}">-<input type="text" placeholder="请输入商品最高价"  name="price_max" value="{{$price_max}}">
        商品分类：<select name="cate" id="">
            <option value="">--请选择--</option>
            @foreach($Catedata as $v)
            <option value="{{$v->cate_id}}"{{$cate==$v->cate_id?'selected':''}}>{{str_repeat('——',$v->level)}}{{$v->cate_name}}</option>
            @endforeach
        </select>
        商品品牌：<select name="brand" id="">
            <option value="">--请选择--</option>
            @foreach($Branddata as $v)
            <option value="{{$v->brand_id}}"{{$brand==$v->brand_id?'selected':''}}>{{$v->brand_name}}</option>
            @endforeach
        </select>
        <input type="submit" value="搜索" >
    </form>
   <thead>
      <tr>
         <th>商品id</th>
         <th>商品名称</th>
         <th>商品价格</th>
         <th>商品介绍</th>
         <th>商品库存</th>
         <th>商品图片</th>
         <th>商品相册</th>
         <th>是否新品</th>
         <th>是否热卖</th>
         <th>是否显示</th>
         <th>是否精品</th>
         <th>商品分类</th>
         <th>商品品牌</th>
         <th>操作</th>
      </tr>
   </thead>
   <tbody>
        @foreach($data as $v)
        <tr>
            <td>{{$v->goods_id}}</td>
            <td>{{$v->goods_name}}</td>
            <td>{{$v->goods_price}}</td>
            <td>{{$v->goods_num}}</td>
            <td>{{$v->goods_score}}</td>
            <td><img src="{{env('APP_URL')}}{{$v->goods_img}}" width="50" alt=""></td>
            
            <td>
            @if($v->goods_imgs)
                @php $imgs=explode(',',$v->goods_imgs);@endphp
                @foreach($imgs as $vv)
                    <img src="{{env('APP_URL')}}{{$vv}}" width="20" alt="">
                @endforeach
            @endif
            </td>
            
            <td>@if($v->is_new==1)√@endif @if($v->is_new==2)×@endif</td>
            <td>@if($v->is_hot==1)√@endif @if($v->is_new==2)×@endif</td>
            <td>@if($v->is_up==1)√@endif @if($v->is_new==2)×@endif</td>
            <td>@if($v->is_best==1)√@endif @if($v->is_new==2)×@endif</td>
            <td>{{$v->cate_name}}</td>
            <td>{{$v->brand_name}}</td>
            <td>
                <a href="javascript:;" id="{{$v->goods_id}}" class="btn btn-warning">删除|</a>
                <a href="{{url('/shop/edit/'.$v->goods_id)}}"  class="btn btn-danger">|修改</a>
            </td>
        </tr>
        @endforeach
        <tr>
            <td>{{$data->appends(['name'=>$name,'price_min'=>$price_min,'price_max'=>$price_max,'cate'=>$cate,'brand'=>$brand])->links()}}</td>
        </tr>
   </tbody>
</table>
<script>
    $(function(){
        // ajax删除
        $(document).on('click','.btn-warning',function(){
            // 获取商品id
            var id=$(this).attr('id');
            if(confirm('您确定要删除这一条记录吗？')){
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    url:'/shop/destroy/'+id,
                    type:'post',
                    dataType:'json',
                    success:function(res){
                        if(res.code=='00000'){
                            location.href='/shop';  
                        }
                    }

                })
            }
        })
    })
</script>
</body>
</html>