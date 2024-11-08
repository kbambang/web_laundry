<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function index() {
       return view("dashboard.index");
    }

    function admin() {
        return view("dashboard.index");
    }

    function petugas() {
        return view("dashboard.index");
    }

    function pimpinan() {
        return view("dashboard.index");
    }
}
