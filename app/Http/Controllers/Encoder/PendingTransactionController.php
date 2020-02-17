<?php

namespace App\Http\Controllers\Encoder;

use App\Audit;
use App\DR_Item;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PendingTransactionController extends Controller
{

    public function pending(Request $request)
    {
        /* reset all items with temp update */
        DB::select('select ResetTempUpdate(?)', [auth()->user()->id]);


        /* allow update for ajax only for dataable*/
        if ($request->ajax()) {
            $data = DB::table('dr')
                ->select("*")
                ->selectRaw('GetDRItemQty(dr_no) as dr_qty')
                ->where('status', 'PENDING');

            return DataTables::of($data)
                ->addColumn('confirm', function ($data) {

                    $btn = '<button type="button" id="row_' . $data->dr_no . '" data-id="' . $data->dr_no . '" data-toggle="modal" data-target="#confirmModal" class="btn_confirm_all edit btn btn-success btn-sm">CONFIRM ALL</button>';
                    return $btn;
                })
                ->addColumn('details', function ($data) {
                    $btn = '<button type="button" data-id="' . $data->dr_no . '" data-date="' . $data->dr_date . '" data-outlet="' . $data->outlet_code . '" data-address="' . $data->outlet_code . '" data-atp="' . $data->atp_no . '" data-po="' . $data->po_no . '" class="edit btn btn-primary btn-sm btn-warning btn_dr_details">DETAILS</button>';
                    return $btn;
                })
                ->rawColumns(['details', 'confirm'])
                ->make(true);
        }

        return view('encoder.transaction.index')
            ->with('active', 'pending')
            ->with('title', 'PENDING');
    }

    public function pending_items(Request $request, $dr)
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
                'status' => 'INTRANSIT',
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
                    'status' => 'PENDING',
                    'updated_by' => auth()->user()->id,
                    'is_updated' => 'NO'
                ]);
        }
    }

    public function confirm(Request $request, $dr, $date)
    {
        if ($request->ajax()) {

            // upload items that are set to intransit
            DB::table('dr_items')
                ->where('dr_no', $dr)
                ->where('updated_by', auth()->user()->id)
                ->where('original_status', 'PENDING')
                ->update([
                    'status' => 'INTRANSIT',
                    'original_status' => 'INTRANSIT',
                    'updated_by' => null,
                    'is_updated' => null,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

            // dr items count
            $dr_items_count = DB::table('dr_items')
                ->where('dr_no', $dr)
                ->get();

            // confirmed items
            $dr_items_confirmed = DB::table('dr_items')
                ->where('dr_no', $dr)
                ->where('status', 'INTRANSIT')
                ->where('original_status', 'INTRANSIT')
                ->get();

            // check if all items are in-transit, then set dr as intransit
            if ($dr_items_count == $dr_items_confirmed) {
                DB::table('dr')
                    ->where('dr_no', $dr)
                    ->update([
                        'status' => 'INTRANSIT',
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
            }

            // audit trail
            $audit = new Audit();
            $audit->prev_status = 'PENDING';
            $audit->new_status = 'INTRANSIT';
            $audit->performed_by = auth()->user()->id;
            $audit->save();
        }
    }

    public function confirm_all(Request $request, $dr, $date)
    {
        if ($request->ajax()) {

            // upload items that are set to intransit
            DB::table('dr_items')
                ->where('dr_no', $dr)
                ->update([
                    'status' => 'INTRANSIT',
                    'original_status' => 'INTRANSIT',
                    'updated_by' => null,
                    'is_updated' => null,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

            DB::table('dr')
                ->where('dr_no', $dr)
                ->update([
                    'status' => 'INTRANSIT',
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

            // audit trail
            $audit = new Audit();
            $audit->prev_status = 'PENDING';
            $audit->new_status = 'INTRANSIT';
            $audit->performed_by = auth()->user()->id;
            $audit->save();
        }
    }
}
