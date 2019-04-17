<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index() {
        return view('index');
    }

    public function profile() {
        return view('profile');
    }

    public function dashboard() {
        return view('dashboard');
    }

    public function motivation() {
        return view('motivation');
    }

    public function vision() {
        return view('vision');
    }
}
