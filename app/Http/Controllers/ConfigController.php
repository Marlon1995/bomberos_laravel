<?php

namespace App\Http\Controllers;

use App\System;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    function __construct() {
        $this->middleware(['authUser','roles:1']);
    }

    public function index() {
        $data = System::all();
        return view( 'config' , compact('data') );
    }

}
