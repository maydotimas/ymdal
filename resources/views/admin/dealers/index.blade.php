@extends('layouts.admin_app')

@section('content')

    <div class="row">
    {{-- UPLOAD CSV DIV--}}
    <!-- Horizontal Form -->
        <div id="admincontent">
            <div class="col-md-12">

                {{-- DEALERS--}}
                <div class="row" id="div_files_dr">
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

                {{-- OUTLETS PER DR  --}}
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

            /* initialize datatable yey*/
            /* iNitialize table */
            var dr_table = $("#DataTables_Table_1");
            var item_table = $("#DataTables_Table_2");

            loadDRTable();

            /* LOAD DR TABLES*/
            function loadDRTable() {
                /* reset table*/
                dr_table.DataTable().clear().destroy();

                // Initialize DataTable
                dr_table.DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "/admin/dealers/",
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


            }

            /* LOAD ITEMS PER DR*/
            function loadOutletsTable() {
                $('.btn_dealer_details').click(function () {

                    /* update dr table label*/
                    $("#item_label").html("LIST OF OUTLETS FOR DR - " + $(this).data('name'));

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
                $("#div_files_dr").removeClass('hidden');
                $("#div_items_dr").addClass('hidden');
            });

            $(".backToCSV").click(function () {
                $("#div_files_dr").addClass('hidden');
                $("#div_items_dr").addClass('hidden');

                /* check if upload was done*/
                if ($("#is_uploaded").val() != "0") {
                    loadCSVTable();
                } else {
                    $("#is_uploaded").val("0");
                }

            });


        });
    </script>
@endsection
