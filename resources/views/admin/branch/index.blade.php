@extends('layouts.admin_app')

@section('content')

    <div class="row">
    {{-- UPLOAD CSV DIV--}}
    <!-- Horizontal Form -->
        <div class="box box-info" style="padding-left: 20px; padding-right: 20px;">
            <!-- general form elements -->
            <div class="box-body">
                <!-- general form elements -->
                <form action="/admin/branch/upload" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-4">
                        <input type="button" class="btn btn-block btn-primary btn-lg"
                               onclick="document.getElementById('fu').click()" value="Select CSV file">
                        <input type="file" id="fu" name="pfilename" accept=".csv"
                               style="width: 0;">
                        <input type="hidden" name="ptype" id="csvtype" value="navision">
                        <input type="hidden" name="name" id="name">
                    </div>
                    <div class="col-md-4">
                        <input id="fileName" name="fileName" disabled="" class="form-control input-lg" type="text"
                               placeholder="No CSV file chosen">
                    </div>
                    <div class="col-md-4">
                        <input class="btn btn-block btn-success btn-lg" value="UPLOAD CSV" id="btnUploadCsv"
                               disabled="" type="submit">
                    </div>
                </form>

                <!-- /.box -->
                <!-- loader -->
                <div id="myloader" style="display: none;">
                    <i id="myspinner"
                       class="fa fa-spinner fa-spin text-center"
                       style="color:red;"></i></div>
            </div>
        </div>


        <div class="row pt-50">
        </div>

        <div id="admincontent">
            <div class="col-md-12">

                {{-- list of branches upload file --}}
                <div class="panel panel-primary panel-table" id="div_files_uploaded">
                    {{-- CSV LIST OF FILES UPLOADED TABLES --}}
                    <div class="panel-body">
                        <p class="bold">LIST OF FILES UPLOADED</p>
                        <div id=""
                             class="">

                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-responsive table-bordered dataTable table-striped table-hover no-footer"
                                           id="DataTables_Table_0" role="grid"
                                           aria-describedby="DataTables_Table_0_info"
                                           style="color:black !important;">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_desc" tabindex="0"
                                                aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                aria-sort="descending"
                                                aria-label=" DATE : activate to sort column ascending"
                                                style="width: 79px;"> DATE
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1"
                                                aria-label=" FILENAME: activate to sort column ascending"
                                                style="width: 207px;"> FILENAME
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1"
                                                aria-label=" DEALER COUNT: activate to sort column ascending"
                                                style="width: 57px;"> DEALER COUNT
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1"
                                                aria-label=" OUTLET COUNT: activate to sort column ascending"
                                                style="width: 57px;"> OUTLET COUNT
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1"
                                                aria-label=" FILE SIZE(kb): activate to sort column ascending"
                                                style="width: 71px;"> FILE SIZE(kb)
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1"
                                                aria-label=" LOADED TO PROD: activate to sort column ascending"
                                                style="width: 99px;"> LOADED TO PROD
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1"
                                                aria-label=" : activate to sort column ascending"
                                                style="width: 54px;"></th>

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

                {{-- DETAILS OR per branch uploaded  --}}
                <div class="row hidden" id="div_files_dr">
                    <div class="row ml-3 mr-3 hidden">
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

                {{-- ITEMS PER DR  --}}
                <div class="row hidden" id="div_items_dr">
                    <div class="row ml-3 mr-3">
                        <div class="col-md-6 col-md-offset-6">
                            <button class="btn btn-primary pull-right backToDR">BACK</button>&nbsp;
                        </div>
                    </div>
                    <div class="panel panel-primary panel-table">
                        <div class="panel-body">
                            <p class="bold" id="item_label">LIST OF ITEMS FOR DR ()</p>
                            <div id=""
                                 class="">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-responsive table-bordered dataTable table-striped table-hover no-footer"
                                               id="DataTables_Table_2" role="grid"
                                               aria-describedby="DataTables_Table_0_info"
                                               style="color:black !important;">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                                    rowspan="1" colspan="1"
                                                    aria-label=" OUTLET CODE : activate to sort column ascending"
                                                    style="width: 207px;"> OUTLET CODE
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                                    rowspan="1" colspan="1"
                                                    aria-label=" OUTLET NAME: activate to sort column ascending"
                                                    style="width: 57px;"> OUTLET NAME
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                                    rowspan="1" colspan="1"
                                                    aria-label=" OUTLET AREA: activate to sort column ascending"
                                                    style="width: 68px;"> OUTLET AREA
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                                    rowspan="1" colspan="1"
                                                    aria-label=" OUTLET LEADTIME: activate to sort column ascending"
                                                    style="width: 71px;"> OUTLET LEADTIME
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                                    rowspan="1" colspan="1"
                                                    aria-label=" TELEPHONE: activate to sort column ascending"
                                                    style="width: 99px;"> TELEPHONE
                                                </th>
                                               {{-- <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                                    rowspan="1" colspan="1"
                                                    aria-label=" : activate to sort column ascending"
                                                    style="width: 54px;">PO NO
                                                </th>--}}
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

    {{-- HIDDEN SWITCHES --}}
    <input type="hidden" id="active_csv_id">
    <input type="hidden" id="is_uploaded" value="0">

@endsection

@section('extra-scripts')

    <script src="/neon/assets/js/datatables/datatables.js"></script>
    <script>

        /* once page is loaded*/
        $(document).ready(function () {

            // part where user uploads a csv file
            /* do this when the click select csv file is clicked. trigger the file select*/
            $("#fu").change(function () {
                /* get file nam details*/
                var file = $(this).val();
                var filename = file.substr(file.lastIndexOf('\\') + 1, file.length);
                /* change the display value of the text box */
                $("#fileName").val(filename);
                $("#name").val(filename);
                /* enable the submit button*/
                $("#btnUploadCsv").removeAttr('disabled');
            });


            /* initialize datatable yey*/
            /* iNitialize table */
            var table = $("#DataTables_Table_0");
            var dr_table = $("#DataTables_Table_1");
            var item_table = $("#DataTables_Table_2");

            loadCSVTable();

            /* LOAD CSV TABLES*/
            function loadCSVTable() {

                table.DataTable().clear().destroy();

                // Initialize DataTable for CSV Upload list
                table.DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('branch') }}",
                    columns: [
                        // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'file_name', name: 'file_name'},
                        {data: 'dealer_count', name: 'dealer_count'},
                        {data: 'outlet_count', name: 'outlet_count'},
                        {data: 'file_size', name: 'file_size'},
                        {data: 'loaded_to_production_date', name: 'loaded_to_production'},
                        {data: 'details', name: 'details', orderable: false, searchable: false},
                        // {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                    drawCallback: function (settings) {
                        // set the onclick button
                        loadDRTable();
                    }
                });
            }

            /* LOAD DR TABLES*/
            function loadDRTable() {
                $('.btn_details').click(function () {

                    /*set active csv id*/
                    $("#active_csv_id").val($(this).data('id'));

                    /* hide csv table*/
                    $("#div_files_uploaded").addClass('hidden');

                    /* display dr table*/
                    $("#div_files_dr").removeClass('hidden');

                    /* reset table*/
                    dr_table.DataTable().clear().destroy();

                    // Initialize DataTable
                    dr_table.DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "/admin/branch/dealers/" + $(this).data('id'),
                        columns: [
                            // {data: 'DT_Row_Index', name: 'DT_Row_Index'},
                            {data: 'dealer_code', name: 'dealer_code'},
                            {data: 'dealer_name', name: 'dealer_name'},
                            {data: 'details', name: 'details', orderable: false, searchable: false}
                        ],
                        drawCallback: function (settings) {
                            loadOutletsTable();
                        },
                    });

                });

            }

            /* LOAD ITEMS PER DR*/
            function loadOutletsTable() {
                $('.btn_dealer_details').click(function () {

                    /* update dr table label*/
                    $("#item_label").html("LIST OF OUTLETS FOR DR - " + $(this).data('name'));

                    $("#div_files_uploaded").addClass('hidden');
                    $("#div_files_dr").addClass('hidden');
                    $("#div_items_dr").removeClass('hidden');

                    item_table.DataTable().clear().destroy();

                    // Initialize DataTable
                    item_table.DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "/admin/branch/outlets/" + $(this).data('id'),
                        columns: [
                            // {data: 'DT_Row_Index', name: 'DT_Row_Index'},
                            {data: 'outlet_code', name: 'outlet_code'},
                            {data: 'outlet_name', name: 'outlet_name'},
                            {data: 'outlet_area', name: 'outlet_area'},
                            {data: 'outlet_leadtime', name: 'outlet_leadtime'},
                            {data: 'outlet_mobile', name: 'outlet_mobile'},
                        ]
                    });

                });

            }

            /* BACK BUTTONS*/
            $(".backToDR").click(function () {
                $("#div_files_uploaded").addClass('hidden');
                $("#div_files_dr").removeClass('hidden');
                $("#div_items_dr").addClass('hidden');
            });

            $(".backToCSV").click(function () {
                $("#div_files_uploaded").removeClass('hidden');
                $("#div_files_dr").addClass('hidden');
                $("#div_items_dr").addClass('hidden');

                /* check if upload was done*/
                if ($("#is_uploaded").val() != "0") {
                    loadCSVTable();
                } else {
                    $("#is_uploaded").val("0");
                }

            });

            /*upload to production */
            $("#btn_prod_upload").click(function () {
                $.ajax({
                    method: "get",
                    url: "/admin/branch/upload/production/",
                    data: {csv_id: $("#active_csv_id").val()}
                })
                    .done(function (msg) {
                        $("#is_uploaded").val("1");
                        alert("Data Saved: " + msg);
                    });
            });


        });
    </script>
@endsection
