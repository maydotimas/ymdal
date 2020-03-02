<?php

namespace App\Http\Controllers\Agent;

use App\Audit;
use App\DR_Item;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class InTransitController extends Controller
{
    public function intransit(Request $request)
    {
        /* allow update for ajax only for dataable*/
        if ($request->ajax()) {
            $data = DB::table('dr')
                ->select("*")
                ->selectRaw('GetDRItemQty(dr_no) as dr_qty')
                ->whereRaw('csv_id in (select id from csv_upload where loaded_to_production = 1)')
                ->whereRaw('dr_no in (select dr_no from dr_items where status = "INTRANSIT")');

            return DataTables::of($data)
                ->addColumn('confirm', function ($data) {

                    $btn = '<button type="button" id="row_' . $data->dr_no . '" data-id="' . $data->dr_no . '" data-toggle="modal" data-target="#confirmModal" class="hidden btn_confirm_all edit btn btn-success btn-sm">CONFIRM ALL</button>';
                    return $btn;
                })
                ->addColumn('details', function ($data) {
                    $btn = '<button type="button" data-id="' . $data->dr_no . '" data-date="' . $data->dr_date . '" data-outlet="' . $data->outlet_code . '" data-address="' . $data->outlet_code . '" data-atp="' . $data->atp_no . '" data-po="' . $data->po_no . '" class="edit btn btn-primary btn-sm btn-warning btn_dr_details">DETAILS</button>';
                    return $btn;
                })
                ->rawColumns(['details', 'confirm'])
                ->make(true);
        }

        return view('agent.intransit.index')
            ->with('active', 'intransit')
            ->with('title', 'INTRANSIT');
    }

    public function intransit_items(Request $request, $dr)
    {
        if ($request->ajax()) {
            $data = DB::table('dr_items')
                ->select("*")
                ->where('dr_no', $dr);

            return DataTables::of($data)
                ->addColumn('checkbox', function ($data) {
                    if ($data->status == 'PENDING') {
                        $btn = '<button type="button" class="btn btn-s btn-danger btn_check_uncheck" data-id="' . $data->id . '">
							<i id="icon_' . $data->id . '" class="fa fa-minus-square"></i>
							<input type="hidden" id="' . $data->id . '" class="dr_items" name="dr_items[]" value="0">
							</button>';
                    } else {
                        $btn = '<button type="button" class="btn btn-s btn-success btn_check_uncheck" data-id="' . $data->id . '">
							<i id="icon_' . $data->id . '" class="fa fa-check-square"></i>
							<input type="hidden" id="' . $data->id . '" class="dr_items" name="dr_items[]" value="' . $data->id . '">
							</button>';
                    }

                    return $btn;
                })
                ->addColumn('span_status', function ($data) {

                    $btn = '<span id="status_' . $data->id . '">' . $data->status . '</span>';

                    return $btn;
                })
                ->rawColumns(['checkbox', 'span_status'])
                ->make(true);
        }
    }
}
