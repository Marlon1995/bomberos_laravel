<?php

namespace App\Http\Controllers;

use App\System;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function __construct() {
        $this->middleware(['authUser','roles:6']);
    }

    public function index() {
        return view( 'index'  );
    }


}
