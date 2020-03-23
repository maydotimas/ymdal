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
                                    data-id="' . $data->dealer_code . '"  
                                    data-name="' . $data->dealer_name . '"  
                                    title="Outlets for ' . $data->dealer_name . '"  
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
    public function outlets(Request $request, $id){
        if ($request->ajax()) {
            $data = Outlet::where('dealer_code',$id)->get();

            return DataTables::of($data)
//                ->addIndexColumn()
                ->addColumn('action', function ($data) {

                    $btn = '<button type="button"   
                                    data-id="' . $data->id . '"  
                                    data-name="' . $data->outlet_name . '"  
                                    data-email="' . $data->email . '"  
                                    data-telephone="' . $data->outlet_mobile . '"  
                                    title="Edit ' . $data->outlet_name . '"  
                                    class="btn_edit_outlet edit btn btn-primary btn-sm btn-warning"><i class="entypo entypo-pencil"</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

    }

    public function update_dealer(Request $request, $id){
        if ($request->ajax()) {
            $outlet = Outlet::find($id);
            $outlet->outlet_mobile = $request->input('telephone');
            $outlet->email = $request->input('email');
            $outlet->save();
        }

    }

}
