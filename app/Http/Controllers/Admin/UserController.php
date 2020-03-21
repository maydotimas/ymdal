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
use Illuminate\Support\Facades\Hash;
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

                    $btn = '<a type="button" data-status="' . $data->status . '"
                                    data-id="' . $data->id . '"
                                    data-name="' . $data->first_name . ' ' . $data->last_name . '"
                                    title="Edit ' . $data->first_name . ' ' . $data->last_name . '"
                                    class="btn_details btn-sm edit btn btn-success btn-sm btn-success"
                                    href="/admin/users/edit/'.$data->id.'"><i class="entypo-pencil"></i></a>
                                    &nbsp;&nbsp;';
                    if ($data->status == 1) {
                        $btn .= '<button type="button" data-status="' . $data->status . '"
                                    data-id="' . $data->id . '"
                                    data-name="' . $data->first_name . ' ' . $data->last_name . '"
                                    title="Block ' . $data->first_name . ' ' . $data->last_name . '"
                                    class="btn_lock btn-sm edit btn btn-primary btn-sm btn-danger"><i class="entypo-lock"></i></button>';
                    } else {
                        $btn .= '<button type="button" data-status="' . $data->status . '"
                                    data-id="' . $data->id . '"
                                    data-name="' . $data->first_name . ' ' . $data->last_name . '"
                                    title="Unblock ' . $data->first_name . ' ' . $data->last_name . '"
                                    class="btn_lock btn-sm edit btn btn-primary btn-sm btn-success"><i class="entypo-lock-open"></i></button>';
                    }

                    $btn .= '&nbsp;&nbsp; <button type="button" data-status="' . $data->status . '"
                                    data-id="' . $data->id . '"
                                    data-toggle="modal" 
                                    data-name="' . ucwords($data->first_name) . ' ' . ucwords($data->last_name) . '"
                                    title="Reset Password for ' . ucwords($data->first_name) . ' ' . ucwords($data->last_name) . '"
                                    data-target="#resetModal"
                                    class="btn_reset btn-sm edit btn btn-primary btn-sm btn-info"><i class="entypo-key"></i></button>';

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
        return view('admin.users.create')
            ->with('active', 'users')
            ->with('title', 'USERS');
    }

    /* save users */
    public function store_user(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users'
        ]);

        $new = new User();
        $new->first_name = $request->input('first_name');
        $new->last_name = $request->input('last_name');
        $new->role = $request->input('role');
        $new->email = $request->input('email');
        $new->password = Hash::make('123456');
        $new->save();

        return redirect('/admin/users');
    }

    /* get user details */
    public function details_user(Request $request, $id)
    {

    }

    /* edit users */
    public function edit_user(Request $request, $id)
    {
        $user = User::find($id);
        return view('admin.users.edit')
            ->with('active', 'users')
            ->with('title', 'USERS')
            ->with('user',$user);
    }

    /* update users */
    public function update_user(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'role' => 'required',
            'email' => "required|email|unique:users,email,".$id
        ]);

        $new = User::find($id);
        $new->first_name = $request->input('first_name');
        $new->last_name = $request->input('last_name');
        $new->role = $request->input('role');
        $new->email = $request->input('email');
        $new->password = Hash::make('123456');
        $new->updated_at = date('Y-m-d H:i:s');
        $new->save();

        return redirect('/admin/users');
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

    public function password_reset(Request $request, $id){
        $new = User::find($id);
        $new->password = Hash::make('123456');
        $new->save();
    }


}
