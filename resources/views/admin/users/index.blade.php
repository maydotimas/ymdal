@extends('layouts.admin_app')

@section('content')

    <div class="row">

        <div class="row pt-50">
        </div>


        <div id="admincontent">

            <div class="col-md-12">

                {{-- list of branches upload file --}}
                <div class="panel panel-primary panel-table" id="div_files_uploaded">
                    {{-- USER LISTS --}}
                    <div class="panel-body mt-1 mb-1">
                        <span class="bold">LIST OF USERS</span>
                        <a class="btn btn-success pull-right" href="/admin/users/create">NEW USER</a>
                        <div id="" class="">

                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-responsive table-bordered dataTable table-striped table-hover no-footer"
                                           id="DataTables_Table_0" role="grid"
                                           aria-describedby="DataTables_Table_0_info"
                                           style="color:black !important;">
                                        <thead>
                                        <tr role="row">

                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1"
                                                aria-label=" FIRST NAME: activate to sort column ascending"
                                                style="width: 20%;"> FIRST NAME
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1"
                                                aria-label=" LAST NAME: activate to sort column ascending"
                                                style="width: 20%;"> LAST NAME
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1"
                                                aria-label=" ROLE NAME: activate to sort column ascending"
                                                style="width: 15%;"> ROLE NAME
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1"
                                                aria-label=" EMAIL: activate to sort column ascending"
                                                style="width: 15%;"> EMAIL
                                            </th>
                                            <th class="sorting_desc" tabindex="0"
                                                aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                aria-sort="descending"
                                                aria-label=" CREATED AT : activate to sort column ascending"
                                                style="width: 15%;"> CREATED AT
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1"
                                                aria-label=" : activate to sort column ascending"
                                                ></th>

                                        </tr>
                                        </thead>

                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- DETAILS FOR USERS  --}}
                <div class="row hidden" id="div_files_dr">
                    <div class="row ml-3 mr-3">
                        <div class="col-md-6 col-md-offset-6">
                            <button class="btn btn-primary pull-right backToCSV">BACK</button>&nbsp;

                            <button class="btn btn-danger pull-right" id="btn_prod_upload"
                                    style="margin-right:3% !important;">UPLOAD TO
                                PRODUCTION
                            </button>
                        </div>
                    </div>
                    <div class="panel panel-primary panel-table">

                        <div class="panel-body">
                            <p class="bold" id="dr_label">LIST OF FILES UPLOADED</p>
                            <div id=""
                                 class="">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-responsive table-bordered dataTable table-striped table-hover no-footer"
                                               id="DataTables_Table_1" role="grid"
                                               aria-describedby="DataTables_Table_0_info"
                                               style="color:black !important;">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                                    rowspan="1" colspan="1"
                                                    aria-label=" FILENAME: activate to sort column ascending"
                                                    style="width: 207px;"> DEALER CODE
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                                    rowspan="1" colspan="1"
                                                    aria-label=" DR COUNT: activate to sort column ascending"
                                                    style="width: 57px;"> DEALER NAME
                                                </th>

                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                                    rowspan="1" colspan="1"
                                                    aria-label=" : activate to sort column ascending"
                                                    style="width: 51px;">
                                                </th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <div id="resetModal" class="modal fade in" role="dialog" aria-hidden="false">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">RESET PASSWORD FOR <span class="reset_name"></span></h4>
                </div>
                <div class="modal-body">

                    <div class="text-center"><br><h4>Do you want to reset <span class="reset_name"></span>'s password?</h4></div>
                    <input type="hidden" id="hdn_reset_password_id">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" data-dismiss="modal" id="btn_confirm_reset">RESET PASSWORD</button>
                    <button class="btn btn-warning" data-dismiss="modal" id="btn_cancel_reset">CANCEL</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('extra-scripts')

    <script src="/neon/assets/js/datatables/datatables.js"></script>
    <script>

        /* once page is loaded*/
        $(document).ready(function () {

            /* initialize datatable yey*/
            /* iNitialize table */
            var table = $("#DataTables_Table_0");

            loadUserTable();

            /* LOAD CSV TABLES*/
            function loadUserTable() {

                table.DataTable().clear().destroy();

                // Initialize DataTable for CSV Upload list
                table.DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "/admin/users",
                    columns: [
                        // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'first_name', name: 'first_name'},
                        {data: 'last_name', name: 'last_name'},
                        {data: 'role', name: 'role'},
                        {data: 'email', name: 'email'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'edit', name: 'details', orderable: false, searchable: false},
                        // {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                    drawCallback: function (settings) {
                        /* check and uncheck items*/
                        $(".btn_lock").click(function () {
                            var id = $(this).data('id');
                            var status = $(this).data('status');

                            if (status == '1') {
                               /* update temporary detail */
                                $.ajax({
                                    method: "get",
                                    url: "/admin/users/block/" + id
                                }).done(function(){
                                    loadUserTable();
                                });
                            } else {
                                /* update temporary detail */
                                $.ajax({
                                    method: "get",
                                    url: "/admin/users/unblock/" + id
                                }).done(function(){
                                    loadUserTable();
                                });
                            }

                        });

                        $(".btn_reset").click(function(){
                            var id = $(this).data('id');
                            var name = $(this).data('name');

                            $(".reset_name").html(name);
                            $("#hdn_reset_password_id").val(id);
                        });

                        $("#btn_cancel_reset").click(function(){
                            $(".reset_name").html("");
                            $("#hdn_reset_password_id").val("");
                        });

                        $("#btn_confirm_reset").click(function(){
                            $.ajax({
                                method: "get",
                                url: "/admin/users/password_reset/" +  $("#hdn_reset_password_id").val()
                            }).done(function(){
                                alert('password updated!')
                            });
                        });
                    }
                });
            }

        });
    </script>
@endsection
