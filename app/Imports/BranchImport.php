<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 2/10/2020
 * Time: 10:26 PM
 */

namespace App\Imports;

use App\BranchOutletContent;
use BranchOutletCsvContent;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Validators\Failure;

class BranchImport implements ToModel, WithBatchInserts, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new BranchOutletContent([
            'dealer_code' => $row[0],
            'dealer_name' => $row[1],
            'outlet_code' => $row[2],
            'outlet_name' => $row[3],
            'outlet_cluster' => $row[4],
            'outlet_address' => $row[5],
            'outlet_city' => $row[6],
            'outlet_province' => $row[7],
            'outlet_region' => $row[8],
            'outlet_area' => $row[9],
            'outlet_area_num' => $row[10],
            'outlet_mobile' => $row[11],
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
}