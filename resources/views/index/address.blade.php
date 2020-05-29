@extends('layouts.shop')
@section('title', '微商城-收货地址')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>收货地址</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="/addressAddDo" method="post" class="reg-login">
     @csrf
      <div class="lrBox">
       <div class="lrList"><input type="text" name="address_name" placeholder="收货人" /></div>
       <div class="lrList"><input type="text" name="address_detail" placeholder="详细地址" /></div>
       <div class="lrList">
        <select  name="address_province">
         <option>省份/直辖市</option>
         @foreach($area as $v)
         <option value="{{$v->id}}">{{$v->name}}</option>
         @endforeach
        </select>
       </div>
       <div class="lrList">
        <select  name="address_city">
         <option>区县</option>
        </select>
       </div>
       <div class="lrList">
        <select  name="address_area">
         <option>详细地址</option>
        </select>
       </div>
       <div class="lrList"><input type="text" placeholder="手机" name="address_tel" /></div>
       <div><input type="radio" name="address_default" value="2" placeholder="设为默认地址" />设为默认地址</div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="保存" />
      </div>
     </form><!--reg-login/-->
     <script>
          $(function(){
              $(document).on('change','select[name="address_province"]',function(){
               //     获取省级的id
                    var id=$(this).val();
                    // 通过ajax将省级id传入后台   获取区县信息
                    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                    $.ajax({
                         url:"{{url('addressCity')}}",
                         type:'post',
                         data:{id:id},
                         success:function(res){
                            $('select[name="address_city"]').html(res);
                         }
                    })
              }) 
          //     获取下拉详细地址
              $(document).on('change','select[name="address_city"]',function(){
               //     获取区县级的id
                    var id=$(this).val();
                    // 通过ajax将区县级id传入后台   获取区县信息
                    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                    $.ajax({
                         url:"{{url('addressArea')}}",
                         type:'post',
                         data:{id:id},
                         success:function(res){
                            $('select[name="address_area"]').html(res);
                         }
                    })
              }) 
          })
     </script>
    
    @endsection