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
                <a href="{{url('/essay/destroy/'.$v->essay_id)}}" class="btn btn-warning">删除|</a>
                <a href="{{url('/essay/edit/'.$v->essay_id)}}"  class="btn btn-danger">|修改</a>
            </td>
        </tr>
        @endforeach
        <tr>
            <td>{{$data->appends(['type'=>$type,'name'=>$name])->links()}}</td>
        </tr>
   </tbody>