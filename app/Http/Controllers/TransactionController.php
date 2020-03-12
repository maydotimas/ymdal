<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DR_Item;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TransactionController extends Controller
{
    private $current_status;
    private $new_status;
    private $role;
    private $view;
    private $confirm_all;
    private $checkbox;
    private $edit;

    public function __construct($current_status, $new_status, $role, $view, $confirm_all = false, $checkbox = false, $edit = false)
    {
        $this->current_status = $current_status;
        $this->new_status = $new_status;
        $this->role = $role;
        $this->view = $view;
        $this->confirm_all = $confirm_all;
        $this->checkbox = $checkbox;
        $this->edit = $edit;
    }

    /* get list of all items per status*/
    public function index(Request $request)
    {
        /* allow update for ajax only for dataable*/
        if ($request->ajax()) {
            $data = DB::table('dr')
                ->select("*")
                ->selectRaw('GetDRItemQty(dr_no) as dr_qty')
                ->whereRaw('csv_id in (select id from csv_upload where loaded_to_production = 1)')
                ->whereRaw('dr_no in (select dr_no from dr_items where status = "' . $this->current_status . '")');

            return DataTables::of($data)
                ->addColumn('confirm', function ($data) {

                    $btn = '<button type="button" id="row_' . $data->dr_no
                        . '" data-id="' . $data->dr_no
                        . '" data-toggle="modal" 
                                                  data-target="#confirmModal" 
                                                  class="btn_confirm_all edit btn btn-success btn-sm">
                              CONFIRM ALL
                          </button>';
                    return $btn;
                })
                ->addColumn('details', function ($data) {
                    $btn = '<button type="button" data-id="' . $data->dr_no
                        . '" data-date="' . $data->dr_date
                        . '" data-outlet="' . $data->outlet_code
                        . '" data-address="' . $data->outlet_code
                        . '" data-atp="' . $data->atp_no
                        . '" data-po="' . $data->po_no
                        . '" class="edit btn btn-primary btn-sm btn-warning btn_dr_details">
                                DETAILS
                            </button>';
                    return $btn;
                })
                ->rawColumns(['details', 'confirm'])
                ->make(true);
        }

        return view($this->role .'.'. $this->view . '.index')
            ->with('edit', $this->edit)
            ->with('checkbox', $this->checkbox)
            ->with('confirm_all', $this->confirm_all)
            ->with('role', $this->role)
            ->with('current_status', $this->current_status)
            ->with('new_status', $this->new_status)
            ->with('active', $this->current_status)
            ->with('title', strtoupper($this->current_status));
    }

    /* get items per list */
    public function items(Request $request, $dr)
    {
        if ($request->ajax()) {
            $data = DB::table('dr_items')
                ->select("*")
                ->where('dr_no', $dr)
                ->where(function($query){
                    $query->where('status',  $this->current_status);
                    $query->orWhere('status',$this->new_status);
                });

            return DataTables::of($data)
                ->addColumn('checkbox', function ($data) {
                    if ($data->status != $this->current_status) {
                        $btn = '<button type="button" 
                                    class="btn btn-s btn-danger btn_check_uncheck" 
                                    data-id="' . $data->id . '">
							            <i id="icon_' . $data->id . '" class="fa fa-minus-square"></i>
							            <input type="hidden" id="' . $data->id . '" class="dr_items" name="dr_items[]" value="0">
							    </button>';
                    } else {
                        $btn = '<button type="button" 
                                    class="btn btn-s btn-success btn_check_uncheck" 
                                    data-id="' . $data->id . '">
                                        <i id="icon_' . $data->id . '" class="fa fa-check-square"></i>
                                        <input type="hidden" id="' . $data->id . '" 
                                                class="dr_items" name="dr_items[]" value="' . $data->id . '">
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

    /* update item status sa checkbox */
    public function update_item(Request $request, $id, $status)
    {
        if ($request->ajax()) {
            $result = DB::table('dr_items')
                ->where('id', $id);

            $this->update_status($result);
        }
    }

    /* update all*/
    public function update_all(Request $request, $dr, $mode)
    {
        if ($request->ajax()) {
            $result = DB::table('dr_items')
                    ->where('dr_no', $dr);

            if($mode=='check'){
                $result->update([
                    'status' => $this->new_status,
                    'updated_by' => auth()->user()->id,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }else{
                $result->update([
                    'status' => $this->current_status,
                    'updated_by' => auth()->user()->id,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }

        }
    }

    /* confirm sa second page */
    public function confirm(Request $request, $dr, $date)
    {
        if ($request->ajax()) {

            // upload items that are set to intransit
            $status = DB::table('dr_items')
                ->where('dr_no', $dr)
                ->update([
                    'status' => $this->new_status,
                    'original_status' => $this->new_status,
                    'updated_by' => auth()->user()->id,
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
                ->where('status', $this->new_status)
                ->where('original_status', $this->new_status)
                ->get();

            // check if all items are new status, then set dr as new status
            if (count($dr_items_count) == count($dr_items_confirmed)) {
                DB::table('dr')
                    ->where('dr_no', $dr)
                    ->update([
                        'status' => $this->new_status,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
            }
        }
    }

    /* confirm all sa may index page */
    public function confirm_all(Request $request, $dr, $date)
    {
        if ($request->ajax()) {
            // upload items that are set to intransit
            $result = DB::table('dr_items')
                ->where('dr_no', $dr);

            $this->update_status($result, $date);

            DB::table('dr')
                ->where('dr_no', $dr)
                ->update([
                    'status' => $this->new_status,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);


        }
    }

    /* helper para macheck kung guard_out, confirm_date o delivery_date ung gagawin*/
    private function update_status($result, $date){
        if($this->new_status=='INTRANSIT'){
            $result->update([
                'status' => $this->new_status,
                'updated_by' => auth()->user()->id,
                'guard_out' => $date
            ]);
        }else if($this->new_status=='CONFIRMED'){
            $result->update([
                'status' => $this->new_status,
                'updated_by' => auth()->user()->id,
                'confirm_date' => $date
            ]);
        }else if($this->new_status=='DELIVERED'){
            $result->update([
                'status' => $this->new_status,
                'updated_by' => auth()->user()->id,
                'delivery_date' => $date
            ]);
        }else{
            $result->update([
                'status' => $this->new_status,
                'updated_by' => auth()->user()->id,
                'is_updated' => 'NO'
            ]);
        }
    }

}
