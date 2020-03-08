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
                ->rawColumns(['details','confirm'])
                ->make(true);
        }

        return view('agent.intransit.index')
            ->with('active', 'intransit')
            ->with('title', 'IN TRANSIT');
    }

    public function intransit_items(Request $request, $dr)
    {
        if ($request->ajax()) {
            $data = DB::table('dr_items')
                ->select("*")
                ->where('dr_no', $dr);

            return DataTables::of($data)
               ->addColumn('checkbox', function ($data) {
                    if ($data->status == 'INTRANSIT') {
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
                ->rawColumns(['span_status','checkbox'])
                ->make(true);
        }
    }


    public function update_pending_item(Request $request, $id, $status)
    {
        if ($request->ajax()) {

            DB::table('dr_items')
                ->where('id', $id)
                ->update([
                    'status' => $status,
                    'updated_by' => auth()->user()->id,
                    'is_updated' => 'NO',
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        }
    }

    public function check_all(Request $request, $dr)
    {

        DB::table('dr_items')
            ->where('dr_no', $dr)
            ->update([
                'status' => 'CONFIRMED',
                'updated_by' => auth()->user()->id,
                'is_updated' => 'NO',
                'updated_at' => date('Y-m-d H:i:s')
            ]);
    }

    public function uncheck_all(Request $request, $dr)
    {
        if ($request->ajax()) {
            DB::table('dr_items')
                ->where('dr_no', $dr)
                ->update([
                    'status' => 'INTRANSIT',
                    'updated_by' => auth()->user()->id,
                    'is_updated' => 'NO',
                    'guard_out' => null
                ]);
        }
    }

    public function confirm(Request $request, $dr, $date)
    {
        if ($request->ajax()) {

            // upload items that are set to CONFIRMED
            $status = DB::table('dr_items')
                ->where('dr_no', $dr)
                ->update([
                    'status' => 'CONFIRMED',
                    'original_status' => 'CONFIRMED',
                    'updated_by' => null,
                    'is_updated' => null,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'guard_out' => $date
                ]);

            // dr items count
            $dr_items_count = DB::table('dr_items')
                ->where('dr_no', $dr)
                ->get();

            // confirmed items
            $dr_items_confirmed = DB::table('dr_items')
                ->where('dr_no', $dr)
                ->where('status', 'CONFIRMED')
                ->where('original_status', 'CONFIRMED')
                ->get();

            // check if all items are in-transit, then set dr as CONFIRMED
            if (count($dr_items_count) == count($dr_items_confirmed)) {
                DB::table('dr')
                    ->where('dr_no', $dr)
                    ->update([
                        'status' => 'CONFIRMED',
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
            }

            // audit trail
            $audit = new Audit();
            $audit->prev_status = 'INTRANSIT';
            $audit->new_status = 'CONFIRMED';
            $audit->performed_by = auth()->user()->id;
            $audit->save();
        }
    }

    public function confirm_all(Request $request, $dr, $date)
    {
        if ($request->ajax()) {

            // upload items that are set to CONFIRMED
            DB::table('dr_items')
                ->where('dr_no', $dr)
                ->update([
                    'status' => 'CONFIRMED',
                    'original_status' => 'CONFIRMED',
                    'updated_by' => null,
                    'is_updated' => null,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'guard_out' => $date
                ]);

            DB::table('dr')
                ->where('dr_no', $dr)
                ->update([
                    'status' => 'CONFIRMED',
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

            // audit trail
            $audit = new Audit();
            $audit->prev_status = 'INSTRANSIT';
            $audit->new_status = 'CONFIRMED';
            $audit->performed_by = auth()->user()->id;
            $audit->save();
        }
    }
}
