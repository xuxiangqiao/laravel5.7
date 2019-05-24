<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Brand;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
class BrandController extends Controller
{
    public function logindo(){
        $email = request()->email;
        $password = request()->password;
        
        if( Auth::attempt(['name'=>$email,'password'=>$password]) ){
            dump(Auth::user());
             dd(Auth::id());
        }else{
            return '登录失败';
        }
        
    }
    
    public function testupload(){
        //文件上传
        if( request()->hasFile('brand_logo') ){
            $res = $this->upload(request(),'brand_logo');
            dd($res);
//            if($res['code']){
//               $data['brand_logo']  = $res['imgurl'];
//            }
        }
    }
    
    public function sendemail(){
        $email =  request()->email;
        
        $this->send($email);
        
    }
    public function send($email){
        \Mail::send('email' , ['name'=>$email] ,function($message)use($email){
        //设置主题
            $message->subject("欢迎注册滕浩有限公司");
        //设置接收方
            $message->to($email);
        });
}
    
    /**
     * Display a listing of the resource.
     * 列表展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        request()->session()->forget('name');
//        $name = request()->session()->get('name','kkk');
//        session(['name'=>'pppp']);
//        session(['age'=>'17']);
//        request()->session()->flush();
//        $name = request()->session()->all();
//        dd($name);
        
        $page = request()->page??1;
      //  dd($page);
        $query = request()->all();
        $brand_name = $query['brand_name']??'';
        $brand_url = $query['brand_url']??'';
       // dd('list_'.$page.'_'.$brand_name.'_'.$brand_url);
        $data = cache('list_'.$page.'_'.$brand_name.'_'.$brand_url);
      //  dd($data);
        if(!$data){
          //  echo "db";
                $where = [];
                if($brand_name){
                    $where[] = ['brand_name','like',"%$brand_name%"];
                }
                if($brand_url){
                    $where['brand_url'] = $brand_url ;
                }

                $pagesize = config('app.pageSize');
              //  DB::connection()->enableQueryLog();
               // $data =  DB::table('brand')->where($where)->orderBy('brand_id','desc')->paginate($pagesize);
                $data =  Brand::where($where)->orderBy('brand_id','desc')->paginate($pagesize);
        //        $logs = DB::getQueryLog();
        //       dd($logs);
                 cache(['list_'.$page.'_'.$brand_name.'_'.$brand_url=>$data],5);
        }
       
        if( request()->ajax()){
            return view('brand.ajaxlist',['data'=>$data,'query'=>$query]);
        }
        return view('brand.list',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     * 添加表单页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      // Cookie::queue('author', '学院君', 12);
        //return response('hi')->cookie('name','1811',12);
        return view('brand.add');
    }

    /**
     * Store a newly created resource in storage.
     * 执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    //第二种验证
    //public function store(\App\Http\Requests\StoreBrandPost $request)        
    {
       // dd($request->all());
        //获取所有
        $data = $request->except(['_token','id']); // 
        //第一种验证
//        $validatedData = $request->validate([
//            'brand_name' => 'required|unique:brand|max:10',
//            'brand_logo' => 'required',
//            'brand_url' => 'required',
//            'brand_desc' => 'required',
//        ],[
//            'brand_name.required'=>'品牌名称必填',
//        ]);
        
        $validator = \Validator::make($request->all(), [
                'brand_name' => 'required|unique:brand|max:10',
                'brand_logo' => 'required',
                'brand_url' => 'required',
                'brand_desc' => 'required',
            ],[
                 'brand_name.required'=>'品牌名称必填',
                 'brand_name.unique'=>'品牌名称已经存在',
            ]);
           // dd($validator->fails());
            if ($validator->fails()) {
              $errors  = $validator->errors();
               
                return ['code'=>0,'data'=>$errors];
                //return redirect('brand/add')->withErrors($validator)->withInput();
            }
        
//        $data = $request->input();// 
//         $data = request()->all();
//         $data = request()->input();
        //获取单个
        //$data = $request->brand_name;
       // $data = $request->input('brand_name');
        //$data = $request->post('brand_name');
        
        //文件上传
        if( $request->hasFile('brand_logo') ){
            $res = $this->upload($request,'brand_logo');
            if($res['code']){
               $data['brand_logo']  = $res['imgurl'];
            }
        }
       // dd($data);
        //$res = DB::table('brand')->insert($data);
        //$res = Brand::create($data);
        $res = Brand::insert($data);
  
        if( $res ){
            return redirect('/brand/list');
           // return ['code'=>1,'msg'=>'成功'];
        }
    }
    public function upload(Request $request, $file ){
        
        if( $request->file($file)->isValid() ){
            $photo = $request->file($file);
            //$extension = $photo->extension();
            $store_result = $photo->store(date('Ymd'));
           // $store_result = $photo->storeAs('photo', 'test.jpg');
          
            return ['code'=>1,'imgurl'=>$store_result];
        }else{
            return ['code'=>0,'message'=>'上传过程出错'];
        }
        
    }

    /**
     * Display the specified resource.
     * 展示详情页
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = cache('data_'.$id);
       // dd($data);
        if( !$data){
            //echo "db";
            $data = Brand::find($id);
            cache(['data_'.$id=>$data],5);
        }
        
        
        return view('brand.show',['data'=>$data]);
        
    }

    /**
     * Show the form for editing the specified resource.
     * 修改页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $cate = DB::table('category')->get()->toArray();
        //无限极分类
        $cate = $this->createTree($cate);
        
        $data = DB::table('brand')->where('brand_id',$id)->first();
        //$data = Brand::find($id);
     //   dd($data);

        return view('brand.edit',compact('data','cate'));
    }
    
    public function createTree($data,$parent_id=0,$level=1){
        if( !$data || !is_array($data)  ){
           return; 
        }
        static $newdata = [];
        foreach( $data as $k=>$v){
           
            if( $v->parent_id == $parent_id ){
                $v->level =$level; 
                $newdata[] = $v;
                $this->createTree($data,$v->cate_id,$level+1);
            }
        }
       return  $newdata;
    }
    
    
    /**
     * Update the specified resource in storage.
     * 执行修改
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
           $data = $request->except('_token');
            $validator = \Validator::make($data, [
                'brand_name' => [
                    'required',
                    'max:10',
                    Rule::unique('brand')->ignore($id,'brand_id'),
                ],
               // 'brand_logo' => '',
                'brand_url' => 'required',
                'brand_desc' => 'required',
            ],[
                 'brand_name.required'=>'品牌名称必填',
                 'brand_name.unique'=>'品牌名称已经存在',
            ]);
           // dd($validator->fails());
            if ($validator->fails()) {
              //$errors  = $validator->errors();
               // return ['code'=>0,'data'=>$errors];
                return redirect('brand/edit/'.$id)->withErrors($validator)->withInput();
            }
        
                   //文件上传
        if( $request->hasFile('brand_logo') ){
            $res = $this->upload($request,'brand_logo');
            if($res['code']){
               $data['brand_logo']  = $res['imgurl'];
            }
        } 
        //dd($data);
        $res = Brand::where('brand_id',$id)->update($data);
        if( $res ){
            return redirect('/brand/list');
        }  
        
    }

    /**
     * Remove the specified resource from storage.
     * 删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Brand::destroy($id);
        if( $res ){
            return ['code'=>1,'msg'=>'删除成功！'];
        }else{
            return ['code'=>0,'msg'=>'删除失败！'];
        }
    }
    
    
    
    /**
     * 检查品牌名称唯一性
     */
    public function checkName(){
        $brand_name = request()->brand_name;
        if( $brand_name ){
            $where['brand_name'] = $brand_name;
            $count = Brand::where($where)->count();
            return ['code'=>1,'count'=>$count];
        }
   
    }
}
