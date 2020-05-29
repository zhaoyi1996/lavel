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
			<li><a href="/shop">商品管理</a></li>
			<li><a href="/brand">商品品牌管理</a></li>
			<li><a href="/cate">商品分类管理</a></li>
			<li><a href="/admin">管理员管理</a></li>
            <li class="active"><a href="/essay">文章管理</a></li>
		</ul>
	</div>
	</div>
</nav>
<table class="table">
	<center><h2 style="color:red;">文章展示</h2><a href="/essay/create"  class="btn btn-info">去添加文章</a></center>
    <form>
        文章分类：<select name="type" id="">
            <option value="">--全部分类--</option>
            @foreach($Etypedata as $v)
            <option value="{{$v->e_id}}"{{$type==$v->e_id?'selected':''}}>{{$v->e_name}}</option>
            @endforeach
        </select>
        文章标题：<input type="text" name="name" value="{{$name}}" >
        <input type="submit" class="btn btn-primary btn-sm" value="搜索">
    </form>
   <thead>
      <tr>
         <th>文章id</th>
         <th>文章标题</th>
         <th>文章分类</th>
         <th>文章重要性</th>
         <th>是否显示</th>
         <th>添加时间</th>
         <th>操作</th>
      </tr>
   </thead>
   <tbody id="class">
        @foreach($data as $v)
        <tr>
            <td>{{$v->essay_id}}</td>
            <td>{{$v->essay_name}}</td>
            <td>{{$v->e_name}}</td>
            <td>{{$v->is_sign==1?'普通':'置顶'}}</td>
            <td>{{$v->is_up==1?'√':'×'}}</td>
            <td>{{date('Y-m-d H:i:s',$v->essay_time)}}</td>
            <td>
                <a href="javascript:;" id="{{$v->essay_id}}" class="btn btn-warning">删除|</a>
                <a href="{{url('/essay/edit/'.$v->essay_id)}}"  class="btn btn-danger">|修改</a>
            </td>
        </tr>
        @endforeach
        <tr>
            <td>{{$data->appends(['type'=>$type,'name'=>$name])->links()}}</td>
        </tr>
   </tbody>
</table>

</body>
</html>
<script>
    
    $(function(){
        // 无刷新删除
        $(document).on('click','.btn-warning',function(){
            // 获取id
            var id=$(this).attr('id');
            var _this=$(this);
            if(confirm('您确定要删除这一条记录吗？')){
                $.get('/essay/destroys/'+id,function(res){
                    if(res.code=='00000'){
                        // alert(res.msg);
                        location.href="/essay";
                    }
                    
                },'json');
            }
        });
    });
</script>