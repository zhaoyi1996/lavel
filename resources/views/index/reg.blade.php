@extends('layouts.shop')
@section('title', '微商城-注册')
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
     <form action="/regDo" method="post" class="reg-login">
      <h3>已经有账号了？点此<a class="orange" href="/login">登陆</a></h3>
      @csrf
      <div class="lrBox">
       <div class="lrList"><input type="text" name="user_name"  placeholder="输入手机号码或者邮箱号" /><b style="color:red;">{{session('msg')}}</b></div>
       <div class="lrList2"><input type="text" name="code" placeholder="输入短信验证码" /> <button type="button" id="code">获取验证码</button><b style="color:red;">{{session('msg')}}</b></div>
       <div class="lrList"><input type="password" name="user_pwd" placeholder="设置新密码（6-18位数字或字母）" /><b style="color:red;">{{$errors->first('user_pwd')}}</b></div>
       <div class="lrList"><input type="password" name="repwd" placeholder="再次输入密码" /><b style="color:red;">{{$errors->first('repwd')}}</b></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="tutton" id="form" value="立即注册" />
      </div>
     </form><!--reg-login/-->
     <script>
     
          $(document).on('click','#code',function(){
               var name=$('input[name="user_name"]').val();
               var namereg=/^1[3|4|5|6|7|8|9]\d{9}$/;
               var emailreg=/^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/;
               if(namereg.test(name)){
                    $.get('/telSms',{name:name},function(res){
                         alert(res.msg);return;
                    },'json')
               }else if(emailreg.test(name)){
                    $.get('/emailSms',{name:name},function(res){
                         alert(res.msg);return;
                    },'json')
               }else{
                    alert('请输入正确的邮箱或手机号');return;
               }
          })
          // 验证码
          $(document).on('blur','input[name="code"]',function(){
               var code=$(this).val();
               var codereg=/^\d{6}$/;
               if(!codereg.test(code)){
                    alert('请输入正确的验证码');return;
               }
          })
          // 密码
          $(document).on('blur','input[name="user_pwd"]',function(){
               $(this).next().empty();
               var pwd=$(this).val();
               var pwdreg=/^[0-9a-zA-Z]{6,18}$/;
               if(!pwdreg.test(pwd)){
                    $(this).next().text('密码由数字、字母组成，最少6位，最多18位');return;
               }
          })
          // 确认密码
          $(document).on('blur','input[name="repwd"]',function(){
               $(this).next().empty();
               // 获取确认密码的值
               var repwd=$(this).val();
               // 获取密码
               var pwd=$('input[name="user_pwd"]').val(); 
               if(repwd!=pwd){
                    $(this).next().text('两次密码不一致');
                    return;
               }
          })
          // 提交验证
          $(document).on('click','#form',function(){
               // 验证手机号或邮箱
               var name=$('input[name="user_name"]').val();
               if(!name){
                    alert('请正确填写手机号或邮箱');return;
               }
               // 验证验证码
               var code=$('input[name="code"]').val();
               var codereg=/^\d{6}$/;
               if(!codereg.test(code)){
                    alert('请输入正确的验证码');return;
               }
               // 验证密码
               $('input[name="user_pwd"]').next().empty();
               var pwd=$('input[name="user_pwd"]').val();
               var pwdreg=/^[0-9a-zA-Z]{6,18}$/;
               if(!pwdreg.test(pwd)){
                    $('input[name="user_pwd"]').next().text('密码由数字、字母组成，最少6位，最多18位');return;
               }
               // 验证确认密码
               $('input[name="repwd"]').next().empty();
               // 获取确认密码的值
               var repwd=$('input[name="repwd"]').val(); 
               if(repwd!=pwd){
                    $('input[name="repwd"]').next().text('两次密码不一致');
                    return;
               }
               $('form').submit();


          })
     </script>
     @endsection
