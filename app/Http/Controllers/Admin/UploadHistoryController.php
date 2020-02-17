<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TransactionReportExport;
use App\Exports\UploadHistoryReportExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class UploadHistoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $status = str_replace("-", "", $request->input('status'));
            $date = $request->input('date');


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

            if ($status != 'ALL') {
                $data = $data->where('dr.dr_date', $date)
                    ->where('dr_items.status', $status);

            } else {
                $data = $data->where('dr.dr_date', $date);
            }

            return DataTables::of($data)
                ->make(true);
        }

        return view('admin.csv.history')
            ->with('active', 'csv-history')
            ->with('title', 'NAVISION');
    }

    public function download(Request $request)
    {
        $status = $request->input('status');
        $date = $request->input('date');

        return (new UploadHistoryReportExport($status,$date))->download('upload_csv_history.xlsx');
    }
}
