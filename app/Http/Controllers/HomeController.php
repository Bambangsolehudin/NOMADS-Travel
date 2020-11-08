<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TravelPackage;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $items = TravelPackage::take(4)->with(['galleries'])->get();
        return view('pages.home',[
            'items' => $items
        ]);
    }
    public function detailall()
    {
        $items = TravelPackage::with(['galleries'])->get();
        return view('pages.detailall',[
            'items' => $items
        ]);
    }
}
