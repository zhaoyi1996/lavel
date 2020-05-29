@extends('layouts.shop')
@section('title', '微商城-商品详情')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
     @if($ShopData->goods_imgs)
      @php $ShopData->goods_imgs=explode(',',$ShopData->goods_imgs); @endphp
      @foreach($ShopData->goods_imgs as $v)
      <img src="{{env('APP_URL')}}{{$v}}" />
      @endforeach
     @endif
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
       <th><strong class="orange">{{$ShopData->goods_price}}</strong></th>
       <td>
        <input type="text" class="spinnerExample" />
       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$ShopData->goods_name}}</strong>
       </td>
       <td>
        <strong>当前访问量：{{$ShopData->visit}}</strong>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      {{$ShopData->goods_desc}}
      <!-- <img src="/static/index/images/image4.jpg" width="636" height="822" /> -->
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><a href="javascript:;" goods_id="{{$ShopData->goods_id}}" id="car">加入购物车</a></td>
      </tr>
     </table>
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/static/index/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/static/index/js/bootstrap.min.js"></script>
    <script src="/static/index/js/style.js"></script>
    
     <!--jq加减-->
    <script src="/static/index/js/jquery.spinner.js"></script>
   <script>
	$('.spinnerExample').spinner({});
	</script>
  </body>
</html>
<script>
  $(function(){
    $(document).on('click','#car',function(){
      // 获取购买商品的数量
      var car_num=$('.spinnerExample').val();
      // 获取商品id
      var goods_id=$(this).attr('goods_id');
      if(car_num==0){
        alert('请选择正确的购买数量');return;
      }
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
      $.ajax({
        url:"{{url('/carDo')}}",
        type:'post',
        data:{goods_id:goods_id,car_num:car_num},
        async:false,
        dataType:'json',
        success:function(red){
          if(red.code=='00000'){
            alert(red.msg);
            location.href="/login?refer="+location.href;
          }else if(red.code=='00001'){
            alert(red.msg);return;
          }else{
            alert(red.msg);
            location.href="{{url('/car')}}";
          }
        }
      });
    })
  })
</script>
@endsection