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

        //查询订单表的信息       
        //ticket.uid=user.id  user.id=userDetail.uid 所以userDetail.uid = ticket.uid

        $res =  DB::table('ticket')
                ->join('userDetail','userDetail.uid','=','ticket.uid')   
                ->join('cinema','cinema.id','=','ticket.cid')
                ->join('roominfo','roominfo.id','=','ticket.rid')
                ->join('film','film.id','=','ticket.fid')
                ->select('ticket.id','userDetail.nickName','cinema.cinema','roominfo.roomname','film.filmname','ticket.seat','film.showtime','ticket.time','ticket.num')
                ->get();
                       
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
