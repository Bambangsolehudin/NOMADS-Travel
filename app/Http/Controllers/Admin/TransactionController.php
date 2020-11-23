<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TransactionRequest;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PDF;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Excel;
use App\Export;

class TransactionController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Transaction::with([
            'details', 'travel_package', 'user'
        ])->get();

        return view('pages.admin.transaction.index',['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $data = $request->all();

        Transaction::create($data);
        return redirect()->route('transaction.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Transaction::with([
            'details', 'travel_package', 'user'
        ])->findOrFail($id);

        return view('pages.admin.transaction.detail',[
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Transaction::findOrFail($id);

        return view('pages.admin.transaction.edit',[
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, $id)
    {
        $data = $request->all();

        $item = Transaction::findOrFail($id);

        $item->update($data);

        return redirect()->route('transaction.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Transaction::findorFail($id);
        $item->delete();

        return redirect()->route('transaction.index');

    }


    public function generatePDF()
    {
        $items = Transaction::with([
            'details', 'travel_package', 'user'
        ])->get();
        $pdf = PDF::loadView('print.Transaction-PDF', ['items'=>$items]);
        return $pdf->download('Transaction-pdf.pdf');
    }

    public function laporanExcel()
    {
        // $items = Transaction::with([
        //     'details', 'travel_package', 'user'
        // ])->get();
        return Excel::download(new Export, 'Transaction.xlsx');   
        // Excel::create('new file', function($excel) {

        //     $excel->sheet('first sheet', function($sheet) {
        //         $sheet->loadView('print.Transaction-PDF', ['items'=>$items]);
        //     });
        // })->export('xls');
    }

}
