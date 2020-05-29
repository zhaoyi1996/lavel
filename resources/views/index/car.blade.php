<link href="/static/index/css/bootstrap.min.css" rel="stylesheet">
@extends('layouts.shop')
@section('title', '微商城-购物车')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">{{$count}}</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
      @foreach($data as $v)
     <div class="dingdanlist">
      <table>
       <tr>
        <td width="4%"><input type="checkbox" goods_id="{{$v->goods_id}}" name="check" /></td>
        <td class="dingimg" width="15%"><img src="{{env('APP_URL')}}{{$v->goods_img}}" /></td>
        <td width="50%">
         <h3>{{$v->goods_name}}</h3>
         <time>下单时间：{{date('Y-m-d H:i:s',$v->car_time)}}</time>
        </td>
        <td align="right"><input type="text" car_id="{{$v->car_id}}" id="buy_{{$v->car_id}}" class="spinnerExample"/></td>
       </tr>
       <tr>
        <th colspan="4"><strong class="orange">¥{{$v->goods_price}}</strong></th>
       </tr>
       <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" /> 删除</a></td>
       </tr>
      </table>
     </div><!--dingdanlist/-->
     @endforeach
     <div class="height1"></div>
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange">¥</strong></td>
       <td width="40%"><a href="javascript:;" class="jiesuan">去结算</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/static/index/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/static/index/js/bootstrap.min.js"></script>
    
  <script>
    $(function(){
      $(document).on('click','.jiesuan',function(){
        var _id='';
        // 获取购买商品的数量
        var car_num='';
        // alert(car_num);
        // 获取要结算的商品id
        $('input[name="check"]:checked').each(function(){
          _id+=$(this).attr('goods_id')+',';
        });
        _id=_id.substr(0,_id.length-1);
        if(!_id){
          alert('请选择要购买的商品');
          return;
        }
        location.href="{{url('/account/')}}"+'/'+_id;
      })
    })
  </script>
  </body>
</html>
  @endsection