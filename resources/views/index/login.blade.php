@extends('layouts.shop')
@section('title', '微商城-登录')
@section('content')


     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="/loginDo" method="post" class="reg-login">
      <h3>还没有账号？点此<a class="orange" href="/reg">注册</a></h3>
      @csrf
      <input type="hidden" name="refer" @if(request()->refer) value="{{request()->refer}}" @endif id="">
      <div class="lrBox">
       <div class="lrList"><input type="text" name="user_name" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList"><input type="password" name="user_pwd" placeholder="输入密码" /></div>
       <b style="color:red;">{{session('msg')}}</b>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即登录" />
      </div>
     </form><!--reg-login/-->
     <script>

     </script>
     @endsection