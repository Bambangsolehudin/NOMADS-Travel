<?php
namespace App;

use App\User;
use App\TravelPackage;
use App\Transaction;


use Maatwebsite\Excel\Concerns\FromCollection;

class Export implements FromCollection
{
    public function collection()
    {
        return Transaction::with([
            'details', 'travel_package', 'user'
        ])->get();
    }
}