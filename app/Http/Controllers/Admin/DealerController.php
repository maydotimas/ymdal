<?php

namespace App\Http\Controllers\Admin;

use App\Dealer;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TransactionController;
use App\Outlet;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DealerController extends Controller
{
    /* get outlet details */
    public function dealers(Request $request){
        if ($request->ajax()) {
            $data = Dealer::all();

            return DataTables::of($data)
//                ->addIndexColumn()
                ->addColumn('details', function ($data) {

                    $btn = '<button type="button"   
                                    data-id="' . $data->csv_id . '"  
                                    data-name="' . $data->dealer_name . '"  
                                    class="btn_dealer_details edit btn btn-primary btn-sm btn-warning">DETAILS</button>';
                    return $btn;
                })
                ->rawColumns(['details'])
                ->make(true);
        }
        return view('admin.dealers.index')
            ->with('active', 'dealers')
            ->with('title', 'DEALERS');

    }


    /* get outlet details */
    public function outlets(Request $request, $csv_id){
        if ($request->ajax()) {
            $data = Outlet::where('csv_id',$csv_id)->get();

            return DataTables::of($data)
//                ->addIndexColumn()
                ->rawColumns(['details'])
                ->make(true);
        }

    }

    public function update_outlet(){

    }
}
