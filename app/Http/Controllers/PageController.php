<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;

class PageController extends Controller
{
    public function index()
    {
        $rooms = Room::where('active', 1)->orderBy('created_at', 'desc')->take(6)->get();
        return view('pages.home', compact('rooms'));
    }
}
