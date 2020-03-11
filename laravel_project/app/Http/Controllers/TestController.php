<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index($id)
    {
        return view('sample/index',['id' => $id]);
    }
}
