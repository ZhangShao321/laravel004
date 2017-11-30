<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // echo"<pre>";

        $res = DB::table('film')    

             //链接两个表的方法join
             //join('表名','主表id','与主表关联的附表的关联id')
            ->join('cinema','film.cid', '=', 'cinema.id')

            //选择需要用的字段查询

            ->select('cinema.cinema','film.id','film.filmname','film.filmtime','film.keywords','film.director','film.protagonist','film.summary','film.price','film.status')

            ->where('film.filmname','like','%'.$request->input('search').'%')
            ->where('film.status','=',1)
            ->orderBy('film.id','asc')
            ->paginate($request->input('num',10));

            // var_dump($res);die;
            
            return view('admin.movie.index',['res'=>$res,'request'=>$request]);
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //下架电影
        // echo "11111111";
        $res = DB::table('film')    

             //链接两个表的方法join
             //join('表名','主表id','与主表关联的附表的关联id')
            ->join('cinema','film.cid', '=', 'cinema.id')

            //选择需要用的字段查询

            ->select('cinema.cinema','film.id','film.filmname','film.filmtime','film.keywords','film.director','film.protagonist','film.summary','film.price','film.status')

            ->where('film.filmname','like','%'.$request->input('search').'%')
            ->where('film.status','=',0)
            ->orderBy('film.id','asc')
            ->paginate($request->input('num',10));

            // var_dump($res);die;
            
            return view('admin.movie.xiajia',['res'=>$res,'request'=>$request]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res = DB::table('film')  

            ->join('cinema','film.cid', '=', 'cinema.id')

            //选择需要用的字段查询

            ->select('cinema.cinema','film.id','film.cid','film.filmname','film.filmtime','film.keywords','film.director','film.protagonist','film.summary','film.price','film.status')  
            ->first();

            // echo "<pre>";
            // var_dump($res);die;
        return view('admin.movie.edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->only('filmname','filmtime','keywords','director','price','status');
        
        // $res = DB::table('cinema')->where('id')->update($input1);
        $res = DB::table('film')->where('id',$id)->update($input);

        if($res){
            return redirect('/admin/movie');
        } else {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function xiajia($id)
    {

        // echo "11111111";die;
        $res = DB::table('film')    
            ->where('film.id',$id)
            ->orwhere('film.status','=',1)->first();

            // echo "<pre>";
            // var_dump($aa);die; 
        $ress = DB::table('film')->where('id',$id)->update(['status'=>0]);

        if($ress){

            return redirect('/admin/movie/create');
        }else{
            return back();
        }
    }

    public function huifu($id)
    {

        // echo "11111111";die;
        $res = DB::table('film')    
            ->where('film.id',$id)
            ->orwhere('film.status','=',0)->first();

            // echo "<pre>";
            // var_dump($aa);die; 
        $ress = DB::table('film')->where('id',$id)->update(['status'=>1]);

        if($ress){

            return redirect('/admin/movie');
        }else{
            return back();
        }
    }
}
