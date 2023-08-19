<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }
}
