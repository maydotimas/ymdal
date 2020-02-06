<?php

namespace App\Http\Controllers\Admin;

use App\CsvUpload;
use App\DR;
use App\DR_Item;
use App\Imports\DRImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\Cloner\Data;
use Yajra\DataTables\DataTables;


class UploadCsvController extends Controller
{
    public $datatable;
    public function __construct()
    {
        $this->datatable = new DataTables();
    }
    /* get the data for csv datatable or display the index page*/
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CsvUpload::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('details', function($data){

                    $btn = '<button type="button" data-status="'.$data->status.'"  data-id="'.$data->id.'"  data-name="'.$data->file_name.'('.$data->created_at.')" class="btn_details edit btn btn-primary btn-sm btn-warning">DETAILS</button>';
                    return $btn;
                })
                ->addColumn('action', function($data){
                    if($data->status=='UPLOADED_TO_PROD'){
                        $btn = '<button data-toggle="modal" data-target="#recallModal"  data-id="'.$data->id.'"  data-name="'.$data->file_name.'('.$data->created_at.')"  type="button" class="edit btn btn-primary btn-sm btn-danger">DELETE</button>';

                      }elseif($data->status=='RECALLED'){
                        $btn = '<button data-toggle="modal" data-target="#recallModal"  data-id="'.$data->id.'"  data-name="'.$data->file_name.'('.$data->created_at.')" type="button" class="edit btn btn-primary btn-sm btn-danger">DELETE</button>';

                    }else{
                        $btn = '<button  data-toggle="modal" data-target="#deleteModal"  type="button"  data-id="'.$data->id.'"  data-name="'.$data->file_name.'('.$data->created_at.')" class="edit btn btn-primary btn-sm btn-danger">DELETE</button>';
                    }


                    return $btn;
                })
                ->rawColumns(['action','details'])
                ->make(true);
        }

        return view('csv.index')
            ->with('active', 'csv-upload')
            ->with('title', 'NAVISION');
    }

    /* upload csv */
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

    /* get csv history for page*/
    public function history()
    {
        return view('csv.history')
            ->with('active', 'csv-history')
            ->with('title', 'NAVISION');
    }

    /* upload data to production, basically mark the csv file as uploaded to 1*/
    public function upload_to_production(Request $request)
    {
        if ($request->ajax()) {
            $csv_id = $request->input('csv_id');
            $csv = CsvUpload::find($csv_id);
            $csv->status = 'UPLOADED_TO_PROD';
            $csv->loaded_to_production = 1;
            $csv->loaded_to_production_date = date('Y-m-d H:i:s');
            $csv->save();
        }
    }

    /* delete csv file. */
    public function delete(Request $request)
    {
        if ($request->ajax()) {
            $csv_id = $request->input('csv_id');
            CsvUpload::find($csv_id)->delete();
            DR::where('csv_id',$csv_id)->delete();
            DR_Item::where('csv_id',$csv_id)->delete();
        }
    }

    /* upload data to production, basically mark the csv file as uploaded to 1*/
    public function recall(Request $request)
    {
        if ($request->ajax()) {
            $csv_id = $request->input('csv_id');
            $csv = CsvUpload::find($csv_id);
            $csv->status = 'RECALLED';
            $csv->loaded_to_production = 0;
            $csv->recall_date = date('Y-m-d H:i:s');
            $csv->save();
        }
    }

    /* get datatable data for dr details*/
    public function get_dr_per_file(Request $request,$id)
    {
        if ($request->ajax()) {
            $data = DB::table('dr')->where('csv_id',$id);

            return DataTables::of($data)
                ->addColumn('details', function($data){
                    $btn = '<button  data-name="'.$data->dr_no.')"  data-id="'.$data->dr_no.'"  href="javascript:void(0)" class="edit btn btn-primary btn-sm btn-warning btn_item_details">DETAILS</button>';
                    return $btn;
                })
                ->rawColumns(['details'])
                ->make(true);
        }

    }

    /* get the datatable data for items per dr */
    public function get_items_per_file(Request $request,$id)
    {
        if ($request->ajax()) {
            $data = DB::table('dr_items')->where('dr_no',$id);

            return DataTables::of($data)
                ->make(true);
        }

    }


}

