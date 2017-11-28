<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\model\ticket;
use App\Http\Model\user;
use App\Http\Model\cinema;
use App\Http\Model\roominfo;
use App\Http\Model\film;
use DB;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

       

        $res = DB::table('ticket')->get();

        foreach ($res as $k => $v) {
            
            $uid = $v->uid;
            $phone = DB::table('user')->where('id',$uid)->first();
            $v->phone = $phone->phone;

            $cid = $v->cid;
            $v->cinema = DB::table('cinema')->where('id',$cid)->first()->cinema;

            $fid = $v->fid;
            $v->filmname = DB::table('film')->where('id',$fid)->first()->filmname;

            $rid = $v->rid;
            $v->roomname = DB::table('roominfo')->where('id',$rid)->first()->roomname;
            
            $showid = $v->showid;
            $show = DB::table('showfilm')->where('id',$showid)->first();
            $v->showtime = $show->time;
        }
       
                       
        return view('admin.ticket.index',compact('res'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //直接删除ticket表里的信息
        $sql=ticket::find($id)->delete();
        if($sql){
            return redirect('/admin/ticket');
        }else{
            echo "删除失败";
        }



    }
}
