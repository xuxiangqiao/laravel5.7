<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>品牌添加</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="{{asset('css/page.css')}}" rel="stylesheet" type="text/css">
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
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <div class="content">
            <h3>品牌添加</h3><hr/>
            <form>
                <input type="text" name="brand_name" value="{{$query['brand_name']??''}}" placeholder="请输入名称关键字">
                <input type="text" name="brand_url" value="{{$query['brand_url']??''}}" placeholder="请输入网址">
                <button>搜索</button>
            </form>  
            <div id="con">
            @if($data)
            @foreach($data as $v)
               
                <p><a href="/pcpay">PC端支付</a>|<a href="/mobilepay">mobile端支付</a><b>ID</b>:{{$v->brand_id}} <b>品牌名称</b>:<a href="/brand/show/{{$v->brand_id}}"> {{$v->brand_name}}</a><b>品牌网址</b>:{{$v->brand_url}} <b>品牌描述</b>:{{$v->brand_desc}} <b>品牌Logo</b>:<img src="{{config('app.img_url')}}{{$v->brand_logo}}" width="100">
                <a href="/brand/edit/{{$v->brand_id}}"> 编辑</a>|<a href="javascript:void(0);" id="{{$v->brand_id}}" class="del">删除</a>
                </p>
            @endforeach
            @endif
               {{$data->appends($query)->links()}}
               </div>
            </div>
       
        </div>
    </body>
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script>
        $(document).on('click','.pagination a',function(){
       // $('.pagination a').click(function(){
            var url = $(this).attr('href');  
            $.get(url, function(data){
                $('#con').html(data);
            });
            return false;
        });
        
        
        
        $('.del').click(function(){
            var brand_id = $(this).attr('id');
            if(!brand_id){
                alert('请选择一条记录');
            }
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
           });
            $.post('/brand/del/'+brand_id,'',function(msg){
                    alert(msg.msg); 
                    window.location.reload();
                },'json');
                   
            
            
            
        });
        
        
    </script>    
    
    
    
</html>