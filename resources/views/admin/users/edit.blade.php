@extends('layouts.admin_app')

@section('content')

    <div class="row">

        <div class="row pt-50">
        </div>


        <div id="admincontent">

            <div class="col-md-12">

                <div class="panel panel-primary" data-collapsed="0">

                    <div class="panel-heading">
                        <div class="panel-title">
                            Edit User {{ucwords($user->first_name)}}
                        </div>


                    </div>
                    <div class="panel-body">

                        <form role="form" action="/admin/users/update/{{$user->id}}" method="post"
                              class="form-horizontal form-groups-bordered">
                            {{csrf_field()}}
                            <div class="form-group @if($errors->has('first_name')) has-error @endif">
                                <label for="field-1" class="col-sm-3 control-label" >First Name</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                           placeholder="First Name" required value="{{$user->first_name}}">
                                </div>
                            </div>
                            <div class="form-group @if($errors->has('last_name')) has-error @endif">
                                <label for="field-1" class="col-sm-3 control-label">Last Name</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                           placeholder="Last Name" required  value="{{$user->first_name}}">
                                </div>
                            </div>


                            <div class="form-group @if($errors->has('role')) has-error @endif">
                                <label class="col-sm-3 control-label">Role</label>

                                <div class="col-sm-5">
                                    <select class="form-control" required name="role">
                                        <option @if($user->role=='CS') selected @endif value="CS">Agent</option>
                                        <option @if($user->role=='ENCODER') selected @endif value="ENCODER">Encoder</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group @if($errors->has('email')) has-error @endif">
                                <label for="field-1" class="col-sm-3 control-label">Email</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="email" name="email"
                                           placeholder="user@domain.com" required  value="{{$user->email}}">
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <button type="submit" class="btn btn-default">Save</button>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

@section('extra-scripts')

@endsection
