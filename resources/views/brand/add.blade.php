<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>品牌添加</title>

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
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
           <form id="tf" action="{{url('/brand/add_do')}}" method="post" enctype="multipart/form-data"> 
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <p><b>品牌名称</b>:<input type="text" name="brand_name"><b class="errorname"></b></p>
                <p><b>品牌描述</b>:<textarea type="text" name="brand_desc"></textarea></p>
                <p><b>品牌LOGO</b>:<input type="file" name="brand_logo"></p>
                <p><b>品牌网址</b>:<input type="text" name="brand_url"><b class="errorurl"></b></p>
               
                <p><input class="btn" type="button" value="提交"></p>
 
            </form>  
            <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
            <script>
                $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
               });
                $('input[name=brand_name]').blur(function(){
                    var brand_name = $(this).val();
                    if( brand_name==''){
                        alert('品牌名称不能为空');
                        return;
                    }
                    var reg = /^[\u4e00-\u9fa5\w]{3,30}$/;
                    if(!reg.test(brand_name)){
                      alert('品牌名称格式为中文字母数字下划线3-30位');  
                      return;
                    }
                    
                    $.post('/brand/checkName',{brand_name:brand_name},function(msg){
                        if(msg.count){
                            alert('品牌名称已存在');  
                        }
                    },'json');
                    
                });
                $('textarea[name=brand_desc]').blur(function(){
                    var brand_desc = $(this).val();
                    if( brand_desc==''){
                        alert('品牌描述不能为空');
                        return;
                    }
                   });  
                $('input[name=brand_url]').blur(function(){
                    var brand_url = $(this).val();
                    if( brand_url==''){
                        alert('品牌网址不能为空');
                        return;
                    }
                   });  
                   
                $('.btn').click(function(){
                    var obj_html = $('input[name=brand_name]');
                    var brand_name = obj_html.val();
                    var flag=true;
                    if( brand_name==''){
                        alert('品牌名称不能为空');
                        return;
                    }
                    var reg = /^[\u4e00-\u9fa5\w]{3,30}$/;
                    if(!reg.test(brand_name)){
                      alert('品牌名称格式为中文字母数字下划线3-30位');  
                      return;
                    }
 
                    $.ajax({
                        method: "POST",
                        url: "/brand/checkName",
                        dataType:'json',
                        async:false,
                        data: {brand_name:brand_name }
                        }).done(function( msg ) {
                        if(msg.count){
                            alert('品牌名称已存在');  
                            flag= false;
                        }
                      });

                    if(!flag){
                        return;
                    }
                    var desc_html = $('textarea[name=brand_desc]');
                    var brand_desc = desc_html.val();
                    if( brand_desc==''){
                        alert('品牌描述不能为空');
                        return;
                    }
                    
                    $('#tf').submit();
                    
                    
                });
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