<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BackloadController extends Controller
{
    public function backload(Request $request)
    {
        /* allow update for ajax only for dataable*/
        if ($request->ajax()) {
            $data = DB::table('dr')
                ->select("*")
                ->selectRaw('GetDRItemQty(dr_no) as dr_qty')
                ->whereRaw('csv_id in (select id from csv_upload where loaded_to_production = 1)')
                ->whereRaw('dr_no in (select dr_no from dr_items where status = "BACKLOAD")');

            return DataTables::of($data)

                ->addColumn('details', function ($data) {
                    $btn = '<button type="button" data-id="' . $data->dr_no . '" data-date="' . $data->dr_date . '" data-outlet="' . $data->outlet_code . '" data-address="' . $data->outlet_code . '" data-atp="' . $data->atp_no . '" data-po="' . $data->po_no . '" class="edit btn btn-primary btn-sm btn-warning btn_dr_details">DETAILS</button>';
                    return $btn;
                })
                ->rawColumns(['details'])
                ->make(true);
        }

        return view('agent.confirmed.index')
            ->with('active', 'backload')
            ->with('title', 'BACKLOAD');
    }

    public function backload_items(Request $request, $dr)
    {
        if ($request->ajax()) {
            $data = DB::table('dr_items')
                ->select("*")
                ->where('dr_no', $dr);

            return DataTables::of($data)
                ->addColumn('span_status', function ($data) {

                    $btn = '<span id="status_' . $data->id . '">' . $data->status . '</span>';

                    return $btn;
                })
                ->rawColumns(['span_status'])
                ->make(true);
        }
    }
}
