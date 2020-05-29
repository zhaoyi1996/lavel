@extends('layouts.shop')
@section('title', '微商城-首页')
@section('content')
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
      <dl>
       <dt><a href="user.html"><img src="/static/index/images/touxiang.jpg" /></a></dt>
       <dd>
        <h1 class="username">三级分销终身荣誉会员</h1>
        <ul>
         <li><a href="prolist.html"><strong>34</strong><p>全部商品</p></a></li>
         <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
         <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
         <div class="clearfix"></div>
        </ul>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--head-top/-->
     <form action="#" method="get" class="search">
      <input type="text" class="seaText fl" />
      <input type="submit" value="搜索" class="seaSub fr" />
     </form><!--search/-->
     @if($session)
        <center>欢迎<h3 style="color:red;">{{$session->user_name}}</h3>登录</center>
        <center><a href="/login" class="btn btn-danger">退出登录</a></center>
      @else
     <ul class="reg-login-click">
      <li><a href="/login">登录</a></li>
      <li><a href="/reg" class="rlbg">注册</a></li>
      <div class="clearfix"></div>
     </ul><!--reg-login-click/-->
     @endif
     <div id="sliderA" class="slider">
     @if($slide)
      @foreach($slide as $v)
      <a href="{{url('/proinfo/'.$v->goods_id)}}"><img width="600" src="{{env('APP_URL')}}{{$v->goods_img}}" /></a>
      @endforeach
     @endif
     </div><!--sliderA/-->
     <ul class="pronav">
     <!-- 分类导航 -->
     @foreach($TopData as $v)
      <li><a href="/prolist">{{$v->cate_name}}</a></li>
    @endforeach
      <div class="clearfix"></div>
     </ul><!--pronav/-->
     <div class="index-pro1">
     @if($Shopdata)
     @foreach($Shopdata as $v)
      <div class="index-pro1-list">
       <dl>
        <dt><a href="{{url('/proinfo/'.$v->goods_id)}}">@if($v->goods_img)<img src="{{env('APP_URL')}}{{$v->goods_img}}" />@endif</a></dt>
        <dd class="ip-text"><a href="/proinfo/">{{$v->goods_name}}</a></dd>
        <dd class="ip-price"><strong>￥{{$v->goods_price}}</strong> </dd>
       </dl>
      </div>
     @endforeach
     @endif
      <div class="clearfix"></div>
     </div><!--index-pro1/-->
     <div class="prolist">
     @foreach($Shopdata as $v)
      <dl>
       <dt><a href="{{url('/proinfo/'.$v->goods_id)}}"><img src="{{env('APP_URL')}}{{$v->goods_img}}" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="proinfo.html">{{$v->goods_name}}</a></h3>
        <div class="prolist-price"><strong>￥{{$v->goods_price}}</strong></div>
        
       </dd>
       <div class="clearfix"></div>
      </dl>
      @endforeach
     </div><!--prolist/-->
     <div class="joins"><a href="fenxiao.html"><img src="/static/index/images/jrwm.jpg" /></a></div>
     <div class="copyright">Copyright &copy; <span class="blue">这是就是三级分销底部信息</span></div>
     @endsection
     