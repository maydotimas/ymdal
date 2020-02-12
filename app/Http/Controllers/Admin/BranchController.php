<?php

namespace App\Http\Controllers\Admin;

use App\BranchUpload;
use App\Dealer;
use App\Http\Controllers\Controller;
use App\Imports\BranchImport;
use App\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BranchController extends Controller
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
            $data = BranchUpload::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('details', function ($data) {

                    $btn = '<button type="button" data-status="' . $data->status . '"  
                                    data-id="' . $data->id . '"  
                                    data-name="' . $data->file_name . '(' . $data->created_at . ')" 
                                    class="btn_details edit btn btn-primary btn-sm btn-warning">DETAILS</button>';
                    return $btn;
                })
                ->rawColumns(['details'])
                ->make(true);
        }

        return view('admin.branch.index')
            ->with('active', 'branch')
            ->with('title', 'BRANCH');
    }

    /* upload csv */
    public function upload(Request $request)
    {
        /* get file details*/
        $filename = $request->input('name');
        $path = $request->file('pfilename')->store('csv');
        $size = $request->file('pfilename')->getSize();

        /* create a new csv upload file record*/
        $branch_upload = new BranchUpload();
        $branch_upload->file_name = $filename;
        $branch_upload->file_size = $size;
        $branch_upload->path = $path;
        $branch_upload->loaded_to_production = 0;
        $branch_upload->uploaded_by = auth()->user()->id;
        $branch_upload->save();

        /* store session to link csv content to csv file record*/
        session(['csv_id' => $branch_upload->id]);

        /* do import*/
        $import = new BranchImport();
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
        $dealer_count = DB::select('select ImportDealer(?) as dealer_count', [$branch_upload->id]);

        /* get and import all DR Items */
        $outlet_count = DB::select('select ImportDealerOutlet(?) as outlet_count', [$branch_upload->id]);


        $branch_upload->dealer_count = $dealer_count[0]->dealer_count;
        $branch_upload->outlet_count = $outlet_count[0]->outlet_count;
        $branch_upload->save();

        /*TO DO: Create branch and outlet details*/
        /* get and import all branch */
        /* get and import all outlet */
       // session()->flush();

        /* redirect to page with import details */
        return redirect('/admin/branch/upload')->with('success', 'All good!');
    }

    /* get outlet details */
    public function dealers(Request $request, $csv_id){
        if ($request->ajax()) {
            $data = Dealer::where('csv_id',$csv_id)->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('details', function ($data) {

                    $btn = '<button type="button"   
                                    data-id="' . $data->csv_id . '"  
                                    data-name="' . $data->dealer_name . '"  
                                    class="btn_dealer_details edit btn btn-primary btn-sm btn-warning">DETAILS</button>';
                    return $btn;
                })
                ->rawColumns(['details'])
                ->make(true);
        }

    }


    /* get outlet details */
    public function outlets(Request $request, $csv_id){
        if ($request->ajax()) {
            $data = Outlet::where('csv_id',$csv_id)->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->rawColumns(['details'])
                ->make(true);
        }

    }

}
