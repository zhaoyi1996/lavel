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