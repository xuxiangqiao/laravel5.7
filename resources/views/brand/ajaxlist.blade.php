  
            @if($data)
            @foreach($data as $v)
               
                <p><b>ID</b>:{{$v->brand_id}} <b>品牌名称</b>:<a href="/brand/show/{{$v->brand_id}}"> {{$v->brand_name}}</a><b>品牌网址</b>:{{$v->brand_url}} <b>品牌描述</b>:{{$v->brand_desc}} <b>品牌Logo</b>:<img src="{{config('app.img_url')}}{{$v->brand_logo}}" width="100">
                <a href="/brand/edit/{{$v->brand_id}}"> 编辑</a>|<a href="javascript:void(0);" id="{{$v->brand_id}}" class="del">删除</a>
                </p>
            @endforeach
            @endif
              
       
        {{$data->appends($query)->links()}}
      