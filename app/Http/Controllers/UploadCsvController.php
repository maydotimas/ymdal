<?php

namespace App\Http\Controllers;

use App\CsvUpload;
use App\Imports\DRImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;


class UploadCsvController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CsvUpload::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('details', function($row){

                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">DETAILS</a>';

                    return $btn;
                })
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">ACTION</a>';

                    return $btn;
                })
                ->rawColumns(['action','details'])
                ->make(true);
        }

        return view('csv.index')
            ->with('active', 'csv-upload');
    }

    public function upload(Request $request)
    {
        /* get file details*/
        $filename = $request->input('name');
        $path = $request->file('pfilename')->store('csv');
        $size = $request->file('pfilename')->getSize();

        /* create a new csv upload file record*/
        $csv_upload = new CsvUpload;
        $csv_upload->file_name = $filename;
        $csv_upload->file_size = $size;
        $csv_upload->path = $path;
        $csv_upload->loaded_to_production = 0;
        $csv_upload->uploaded_by = 1;
        $csv_upload->save();

        /* store session to link csv content to csv file record*/
        session(['csv_id' => $csv_upload->id]);

        /* do import*/
        $import = new DRImport();
        $import->import($path);

        /* To Do: Store failures on a table, then display upload  */
        /*foreach ($import->failures() as $failure) {
            $failure->row(); // row that went wrong
            $failure->attribute(); // either heading key (if using heading row concern) or column index
            $failure->errors(); // Actual error messages from Laravel validator
            $failure->values(); // The values of the row that has failed.
        }*/

        /* TO DO: PENDING IS THE STATUS SO PWEDE PA SIYANG MAUPDATE HEHE */
        /* get and import all DRs */
        $dr_count = DB::select('select ImportDr(?,?) as dr_count', [$csv_upload->id,'PENDING']);

        /* get and import all DR Items */
        $dr_item_count = DB::select('select ImportDrItem(?,?) as dr_items_count', [$csv_upload->id,'PENDING']);

        $csv_upload->dr_count = $dr_count[0]->dr_count;
        $csv_upload->dr_item_count = $dr_item_count[0]->dr_items_count;
        $csv_upload->save();

        /*TO DO: Create branch and outlet details*/
        /* get and import all branch */
        /* get and import all outlet */
        session()->flush();

        /* redirect to page with import details */
        return redirect('/csv/upload')->with('success', 'All good!');
    }

    public function history()
    {
        return view('csv.history')
            ->with('active', 'csv-history');
    }

    public function upload_to_production()
    {

    }

}

