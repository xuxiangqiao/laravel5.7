<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>品牌编辑</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: left;
                padding:25px;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="content">
            <h3>品牌添加</h3><hr/>
            @if ($errors->any())
            <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            </ul>
            </div>
           @endif
            <form id="tf" action="{{url('/brand/update/'.$data->brand_id)}}" method="post" enctype="multipart/form-data"> 
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <p><b>品牌名称</b>:<input type="text" name="brand_name" value="{{$data->brand_name}}"><b class="errorname"></b></p>
                <p><b>品牌描述</b>:<textarea type="text" name="brand_desc">{{$data->brand_desc}}</textarea></p>
                <p><b>品牌LOGO</b>:<img src="{{config('app.img_url')}}{{$data->brand_logo}}"><input type="file" name="brand_logo"></p>
                <p><b>品牌网址</b>:<input type="text" name="brand_url" value="{{$data->brand_url}}"><b class="errorurl"></b></p>
                <p><b>分类</b>:
                    <select name="cate_id">
                        <option>请选择</option>
                        
                        @foreach($cate as $k=>$v)
                        <option value="{{$v->cate_id}}" @if($v->cate_id ==$data->cate_id) selected @endif>@php echo str_repeat("&nbsp;&nbsp;&nbsp;",$v->level)@endphp {{$v->cate_name}}</option>
                        @endforeach
                    </select>
                </p>
                <p><input class="btn" type="submit" value="提交"></p>
 
            </form>  
            <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
            <script>
                
//                $('.btn').click(function(){
//                   // alert($('#tf')[0]);
//                    var fd = new FormData($('#tf')[0]);
//                    
//                    $.ajax({
//                        method: "POST",
//                        url: "/brand/add_do",
//                        data: fd,
//                        dataType:'json',
//                        processData:false,
//                        contentType:false,
//                      }).done(function( msg ) {
//                          if(msg.code==0){
//                              if(msg.data.brand_name){
//                                  $('.errorname').text(msg.data.brand_name);
//                              }
//                              if(msg.data.brand_url){
//                                   $('.errorurl').text(msg.data.brand_name);
//                              }
//                              return;
//                          }
//                          if(msg.code==1){
//                              window.location.href='/brand/list';
//                          }
//                          
//                      });
//
//                    
//                });
                
            </script>
              
            </div>
        </div>
    </body>
</html>