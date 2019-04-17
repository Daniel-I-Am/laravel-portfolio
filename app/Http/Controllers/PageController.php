<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index() {
        return view('index');
    }

    public function profile() {}

    public function dashboard() {}

    public function motivation() {}

    public function vision() {}
}
