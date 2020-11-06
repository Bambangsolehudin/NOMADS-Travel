<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TravelPackageRequest;
use Illuminate\Http\Request;
use App\Transaction;
use App\TransactionDetail;
use App\TravelPackage;
use App\Gallery;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        
        return view('pages.admin.dashboard',[
            'travel_package' =>  TravelPackage::count(),
            'gallery' =>  Gallery::count(),
            'transaction' =>  Transaction::count(),
            'transaction_pending' =>  Transaction::where('transaction_status', 'pending')->count(),
            'transaction_success' =>  Transaction::where('transaction_status', 'success')->count(),
        ]);
    }
}
