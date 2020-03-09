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
            $data = User::latest()->where('id','<>', auth()->user()->id)->get();

            return DataTables::of($data)
                ->addColumn('edit', function ($data) {

                    $btn = '<button type="button" data-status="' . $data->status . '"
                                    data-id="' . $data->id . '"
                                    data-name="' . $data->first_name . ' ' . $data->last_name . '"
                                    title="Edit ' . $data->first_name . ' ' . $data->last_name . '"
                                    class="btn_details btn-xs edit btn btn-primary btn-sm btn-primary"><i class="entypo-pencil"></i></button>
                                    &nbsp;&nbsp;';
                    if ($data->status == 1) {
                        $btn .= '<button type="button" data-status="' . $data->status . '"
                                    data-id="' . $data->id . '"
                                    data-name="' . $data->first_name . ' ' . $data->last_name . '"
                                    title="Block ' . $data->first_name . ' ' . $data->last_name . '"
                                    class="btn_lock btn-xs edit btn btn-primary btn-sm btn-danger"><i class="entypo-lock"></i></button>';
                    } else {
                        $btn .= '<button type="button" data-status="' . $data->status . '"
                                    data-id="' . $data->id . '"
                                    data-name="' . $data->first_name . ' ' . $data->last_name . '"
                                    title="Unblock ' . $data->first_name . ' ' . $data->last_name . '"
                                    class="btn_lock btn-xs edit btn btn-primary btn-sm btn-success"><i class="entypo-lock-open"></i></button>';
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

    }

    /* save users */
    public function store_user(Request $request)
    {

    }

    /* get user details */
    public function details_user(Request $request, $id)
    {


    }

    /* edit users */
    public function edit_user(Request $request, $id)
    {

    }

    /* update users */
    public function update_user(Request $request, $id)
    {

    }

    /* block users */
    public function block_user(Request $request, $id)
    {
        if ($request->ajax()) {
            DB::table('users')
                ->where('id', $id)
                ->update([
                    'status' => '0',
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        }
    }

    /* block users */
    public function unblock_user(Request $request, $id)
    {
        if ($request->ajax()) {
            DB::table('users')
                ->where('id', $id)
                ->update([
                    'status' => '1',
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        }
    }


}
