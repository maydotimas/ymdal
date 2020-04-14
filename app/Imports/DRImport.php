<?php

namespace App\Imports;

use App\DrCsvContent;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Validators\Failure;

class DRImport implements ToModel, WithBatchInserts, SkipsOnFailure, SkipsOnError
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        /* do format checking first for multiple date format */
        $date = explode("-",$row[2]);
        if(count($date) < 3){
            $new_date = date('Y-m-d');
        }else{
            $months = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEPT", "OCT", "NOV", "DEC"];
            $month = array_keys($months, strtoupper($date[1]));
            $year = '20'.$date[2];

            if($date[0] < 10){
                $new_date = $year.'-'.($month[0]+1).'-0'.$date[0];
            }else{
                $new_date = $year.'-'.($month[0]+1).'-'.$date[0];
            }
        }


        return new DrCsvContent([
            'nav_dr_no' => $row[0],
            'nav_atp_no' => $row[1],
            'nav_dr_date' => $new_date,
            'dealer_code' => $row[3],
            'dealer_name' => $row[4],
            'outlet_cluster' => $row[5],
            'outlet_code' => $row[6],
            'outlet_name' => $row[7],
            'nav_model_code' => $row[8],
            'nav_model_name' => $row[9],
            'nav_frame_no' => $row[10],
            'nav_engine_no' => $row[11],
            'nav_transit_days' => $row[12],
            'nav_carrier' => $row[13],
            'nav_dispatch' => $row[14],
            'nav_region' => $row[15],
            'nav_sdr_no' => $row[16],
            'nav_po_no' => $row[17],
            'csv_id' => session('csv_id')
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }
    public function onFailure(Failure ...$failures)
    {
        // Handle the failures how you'd like.
    }

    public function rules(): array
    {
        return [
            '0' => 'required',
            '1' => 'required',
            '2' => 'required',
            '3' => 'required',
            '4' => 'required',
            '5' => 'required',
            '6' => 'required',
            '7' => 'required',
            '8' => 'required',
            '9' => 'required',
            '10' => 'required',
            '11' => 'required',
            '12' => 'required',
            '13' => 'required',
            '14' => 'required',
            '15' => 'required',
            '16' => 'required',
            '17' => 'required',
        ];
    }
    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
    }
}
