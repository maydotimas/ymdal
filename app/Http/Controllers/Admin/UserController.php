<?php

namespace App\Http\Controllers\Admin;

use App\BranchUpload;
use App\Dealer;
use App\Http\Controllers\Controller;
use App\Imports\BranchImport;
use App\Outlet;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class UserController extends Controller
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
            $data = User::latest()->get();

            return DataTables::of($data)
                ->addColumn('edit', function ($data) {

                    $btn = '<button type="button" data-status="' . $data->status . '"
                                    data-id="' . $data->id . '"
                                    data-name="' . $data->first_name . ' ' . $data->last_name . '"
                                    title="Edit ' . $data->first_name . ' ' . $data->last_name . '"
                                    class="btn_details edit btn btn-primary btn-sm btn-success"><i class="entypo-pencil"></i></button>
                                    &nbsp;&nbsp;';
                    if( $data->status == 1){
                        $btn .= '<button type="button" data-status="' . $data->status . '"
                                    data-id="' . $data->id . '"
                                    data-name="' . $data->first_name . ' ' . $data->last_name . '"
                                    title="Block ' . $data->first_name . ' ' . $data->last_name . '"
                                    class="btn_details edit btn btn-primary btn-sm btn-danger"><i class="entypo-cancel"></i></button>';
                    }else{
                        $btn .= '<button type="button" data-status="' . $data->status . '"
                                    data-id="' . $data->id . '"
                                    data-name="' . $data->first_name . ' ' . $data->last_name . '"
                                    title="Unblock ' . $data->first_name . ' ' . $data->last_name . '"
                                    class="btn_details edit btn btn-primary btn-sm btn-danger"><i class="entypo-check"></i></button>';
                    }

                    return $btn;
                })
                ->rawColumns(['edit'])
                ->make(true);
        }

        return view('admin.users.index')
            ->with('active', 'users')
            ->with('title', 'USERS');
    }

    /* create users */
    public function create_user(Request $request)
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

    /* save users */
    public function store_user(Request $request)
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

    /* get user details */
    public function details_user(Request $request, $id){
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

    /* edit users */
    public function edit_user(Request $request,$id)
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

    /* update users */
    public function update_user(Request $request,$id)
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

    /* block users */
    public function block_user(Request $request,$id)
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

    /* block users */
    public function unblock_user(Request $request,$id)
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


}
