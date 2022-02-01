<?php

namespace App\Http\Controllers;

use App\Role;
use App\System;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolsController extends Controller
{
    function __construct()
    {
        $this->middleware(['authUser','roles:1']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = System::all();
        $rols = DB::table('roles')
            ->select('roles.id','roles.key','roles.role','roles.descripcion','roles.estado')
            ->orderBy('roles.role','ASC')
            ->get();
         return view( 'rols' , compact('data','rols') );
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
         $this->validate($request , [
            'key' => "required",
            'role' => "required",
            'descripcion' => "required"
        ]);

        $send = new Role();
        $send->key          =  $request->input('key');
        $send->role         =  $request->input('role');
        $send->descripcion  =  $request->input('descripcion');
        $send->estado      = 1;
        $send->save();
        return back()->with('Respuesta','Se ingreso una nuevo rol al sistema.');
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
        DB::table('roles')->where('id', $id)->update([
            'estado' => 1,
            'updated_at'  => Carbon::now()
        ]);
        return back()->with('Respuesta','Se Activo el ROL del sistema.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('roles')->where('id', $id)->update([
            'estado' => 0,
            'updated_at'  => Carbon::now()
        ]);
        return back()->with('Respuesta','Se desactivo el ROL del sistema.');
    }
}
