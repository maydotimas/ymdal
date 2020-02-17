<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 2/17/2020
 * Time: 4:00 PM
 */

namespace App\Exports;


use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class TransactionReportExport implements FromQuery
{
    use Exportable;

    public function __construct($status, $date_from, $date_to)
    {
        $this->status = $status;
        $this->date_from = $date_from;
        $this->date_to = $date_to;
    }

    public function query()
    {
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

        if ($this->status != 'ALL') {
            $data = $data->whereBetween('dr_items.updated_at', [$this->date_from, $this->date_to])
                ->where('dr_items.status', $this->status);
        } else {
            $data = $data->whereBetween('dr_items.updated_at', [$this->date_from, $this->date_to]);
        }

        return $data->orderBy('dr_items.dr_no');
    }

}