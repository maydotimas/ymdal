<?php

namespace App\Http\Controllers\Admin;

use App\DR;
use App\DR_Item;
use App\Http\Controllers\Controller;
use App\Imports\DRImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\Cloner\Data;
use Yajra\DataTables\DataTables;


class ReportsController extends Controller
{
    public function per_transaction(Request $request)
    {

        if ($request->ajax()) {
            $type = $request->input('reptype');
            $status = str_replace("-","",$request->input('drtype'));
            $date_daily = $request->input('cur_date_daily');
            $date_monthly = $request->input('cur_date_monthly');


            $data = DB::table('dr')
                ->join('dr_items', 'dr_items.dr_no', '=', 'dr.dr_no')
                ->select(
                    "dr.dr_no",
                    "dr.dr_date",
                    "dr.outlet_code",
                    "dr_items.frame_no",
                    "dr_items.engine_no",
                    "dr_items.status",
                    "dr_items.guard_out",
                    "dr_items.confirm_date",
                    "dr_items.deliver_date");

            if($status != 'ALL'){
                if ($type == 'DAILY') {
                    $data = $data->whereBetween('dr_items.updated_at', [$date_daily." 00:00:00",$date_daily." 23:59:59"])
                        ->where('dr_items.status', $status);
                } else {
                    $date = explode("-", $date_monthly);
                    $data = $data->whereBetween('dr_items.updated_at', [$date[0] . "-" . $date[1] . "-01 00:00:00", $date_monthly." 23:59:59"])
                        ->where('dr_items.status', $status);
                }
            }else{
                if ($type == 'DAILY') {
                    $data = $data->whereBetween('dr_items.updated_at', [$date_daily." 00:00:00",$date_daily." 23:59:59"]);
                } else {
                    $date = explode("-", $date_monthly);
                    $data = $data->whereBetween('dr_items.updated_at', [$date[0] . "-" . $date[1] . "-01 00:00:00", $date_monthly." 23:59:59"]);
                }
            }

            return DataTables::of($data)
                ->make(true);
        }

        return view('admin.reports.index')
            ->with('active', 'reports')
            ->with('title', 'PER TRANSACTION REPORTS');
    }
}
