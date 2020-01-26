@extends('layouts.user_app')

@section('content')

    <div class="row">

        <!-- Horizontal Form -->
        <div class="box box-info" style="padding-left: 20px; padding-right: 20px;">
            <!-- general form elements -->
            <div class="box-body">
                <!-- general form elements -->
                <form action="/csv/upload" method="post" enctype="multipart/form-data">
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
                <div id="myloader" style="display: none;"><i id="myspinner"
                                                             class="fa fa-spinner fa-spin text-center"
                                                             style="color:red;"></i></div>
            </div>
        </div>


        <div class="row pt-50">
        </div>

        <div id="admincontent">
            <div class="col-md-12">
                <div class="panel panel-primary panel-table">
                    <div class="panel-body" id="div_files_uploaded">
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
                                                aria-label=" DR COUNT: activate to sort column ascending"
                                                style="width: 57px;"> DR COUNT
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1"
                                                aria-label=" ITEM COUNT: activate to sort column ascending"
                                                style="width: 68px;"> ITEM COUNT
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
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1"
                                                aria-label=" : activate to sort column ascending"
                                                style="width: 51px;"></th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body hidden" id="div_files_dr">
                        <p class="bold">LIST OF FILES UPLOADED</p>
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
                                            <th class="sorting_desc" tabindex="0"
                                                aria-controls="DataTables_Table_1" rowspan="1" colspan="1"
                                                aria-sort="descending"
                                                aria-label=" NO : activate to sort column ascending"
                                                style="width: 79px;"> NO
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                                rowspan="1" colspan="1"
                                                aria-label=" FILENAME: activate to sort column ascending"
                                                style="width: 207px;"> DR NO
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                                rowspan="1" colspan="1"
                                                aria-label=" DR COUNT: activate to sort column ascending"
                                                style="width: 57px;"> DR DATE
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                                rowspan="1" colspan="1"
                                                aria-label=" OUTLET CODE: activate to sort column ascending"
                                                style="width: 68px;"> OUTLET CODE
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                                rowspan="1" colspan="1"
                                                aria-label=" OUTLET NAME: activate to sort column ascending"
                                                style="width: 71px;"> OUTLET NAME
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                                rowspan="1" colspan="1"
                                                aria-label=" SDR NO: activate to sort column ascending"
                                                style="width: 99px;"> SDR NO
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                                rowspan="1" colspan="1"
                                                aria-label=" : activate to sort column ascending"
                                                style="width: 54px;"></th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                                rowspan="1" colspan="1"
                                                aria-label=" : activate to sort column ascending"
                                                style="width: 51px;">PO NO
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                                rowspan="1" colspan="1"
                                                aria-label=" : activate to sort column ascending"
                                                style="width: 51px;"></th>
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

            // Initialize DataTable
            table.DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('csv') }}",
                columns: [
                    // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'file_name', name: 'file_name'},
                    {data: 'dr_count', name: 'dr_count'},
                    {data: 'dr_item_count', name: 'dr_item_count'},
                    {data: 'file_size', name: 'file_size'},
                    {data: 'loaded_to_production_date', name: 'loaded_to_production'},
                    {data: 'details', name: 'details', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                drawCallback: function (settings) {
                    loadDRTable()
                },
                fnRowCallback: function (nRow, aData, iDisplayIndex) {
                    var action_btn = $(nRow).children().last().children().last();
                    var isloaded = aData.loaded_to_production;
                    if (isloaded == 0) {
                        $(nRow).addClass('danger');
                    }
                    else {
                        $(nRow).addClass('success');
                        action_btn.removeClass('btn-danger');
                        action_btn.addClass('btn');
                        action_btn.html('RECALL');
                        action_btn.css('backgroundColor', 'GRAY');
                    }
                }
            });

            function loadDRTable() {
                $('.btn_details').click(function () {
                    alert($(this).data('id'));
                    $("#div_files_uploaded").addClass('hidden');
                    $("#div_files_dr").removeClass('hidden');
                    dr_table.DataTable().clear().destroy();
                    // Initialize DataTable
                    dr_table.DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "/csv/upload/dr/" + $(this).data('id'),
                        columns: [
                            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                            {data: 'dr_no', name: 'dr_no'},
                            {data: 'dr_date', name: 'dr_date'},
                            {data: 'outlet_code', name: 'outlet_code'},
                            {data: 'outlet_code', name: 'outlet_code'},
                            {data: 'sdr_no', name: 'sdr_no'},
                            {data: 'po_no', name: 'po_no'},
                            {data: 'details', name: 'details', orderable: false, searchable: false}
                        ]
                    });
                });

            }


        });
    </script>
@endsection
