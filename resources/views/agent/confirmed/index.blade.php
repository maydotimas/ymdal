@extends('layouts.agents_app')

@section('content')

    <div class="row">
        <div id="admincontent">
            <div class="col-md-12">

                <div class="panel panel-primary panel-table" id="div_dr_list">
                    {{-- CSV LIST OF FILES UPLOADED TABLES --}}
                    <div class="panel-body">
                        <p class="bold">DR RECORD</p>
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
                                                aria-label=" DR NO : activate to sort column ascending"
                                            > DR NO
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1"
                                                aria-label=" ATP NO: activate to sort column ascending"
                                            > ATP NO
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1"
                                                aria-label=" DR DATE: activate to sort column ascending"
                                            > DR DATE
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1"
                                                aria-label=" OUTLET CODE: activate to sort column ascending"
                                            > OUTLET CODE
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1"
                                                aria-label=" OUTLET CODE: activate to sort column ascending"
                                            > OUTLET CODE
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1"
                                                aria-label=" DR QTY: activate to sort column ascending"
                                            > DR QTY
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1"
                                                aria-label=" PO NO: activate to sort column ascending"
                                            > PO NO
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

                {{-- DR ITEMS --}}
                <div class="row hidden" id="div_dr_items">

                    <div class="col-md-3">
                        <table class="table table-condensed table-responsive">
                            <tbody>
                            <tr>
                                <td class="no-border"><h3 class=" mt-3 bold text-danger" id="dr_no">DJ018660</h3></td>
                            </tr>
                            <tr>
                                <td class="no-border">
                                    <small>DR DATE</small>
                                    <h4 class=" mt-0 bold text-success" id="dr_date">2018-08-29</h4></td>
                            </tr>
                            <tr>
                                <td>
                                    <small>OUTLET CODE</small>
                                    <h4 class=" mt-0 bold text-success" id="outlet_code">202898</h4></td>
                            </tr>
                            <tr>
                                <td>
                                    <small>OUTLET NAME</small>
                                    <h4 class=" mt-0 bold text-success" id="outlet_name">PREMIUMBIKES Sta. Cruz</h4>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <small>ADDRESS</small>
                                    <h4 class=" mt-0 bold text-success" id="outlet_address">No. 9-A Regidor St., Brgy.
                                        5, Sta. Cruz,
                                        Laguna </h4></td>
                            </tr>
                            <tr>
                                <td>
                                    <small>ATP NO.</small>
                                    <h4 class=" mt-0 bold text-success" id="atp_no">0195729 </h4></td>
                            </tr>
                            <tr>
                                <td>
                                    <small>PO NO.</small>
                                    <h4 class=" mt-0 bold text-success" id="po_no">4124 </h4></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-9">
                        <div class="panel panel-primary panel-table">

                            <div class="panel-body">
                                <div id=""
                                     class="">

                                    <div class="row">

                                        <table class="table table-responsive table-bordered dataTable table-striped table-hover no-footer"
                                               id="DataTables_Table_1" role="grid"
                                               aria-describedby="DataTables_Table_1_info"
                                               style="color:black !important;">
                                            <thead>
                                            <tr role="row">
                                                {{--<th class="sorting_desc" tabindex="0"
                                                    aria-controls="DataTables_Table_1" rowspan="1" colspan="1"
                                                    aria-sort="descending"
                                                    aria-label=" NO : activate to sort column ascending"
                                                    style="width: 79px;"> NO
                                                </th>--}}
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                                    rowspan="1" colspan="1"
                                                    aria-label=" MODEL NO: activate to sort column ascending"
                                                    style="width: 207px;">MODEL NO
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                                    rowspan="1" colspan="1"
                                                    aria-label=" MODEL NAME: activate to sort column ascending"
                                                    style="width: 57px;"> MODEL NAME
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                                    rowspan="1" colspan="1"
                                                    aria-label=" FRAME NO: activate to sort column ascending"
                                                    style="width: 68px;"> FRAME NO
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                                    rowspan="1" colspan="1"
                                                    aria-label=" ENGINE NO: activate to sort column ascending"
                                                    style="width: 71px;"> ENGINE NO
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                                    rowspan="1" colspan="1"
                                                    aria-label=" STATUS: activate to sort column ascending"
                                                    style="width: 99px;"> STATUS
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

                    <div class="col-md-12">
                        <div class="form-group text-right">

                           <button
                                    class="btn btn-primary backToDR"> BACK
                            </button>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    {{-- MODAL FOR DELETE--}}
    <div id="deleteModal" class="modal fade danger" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">DELETE NAVISION FILE</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="input-group col-md-7">
                            <input disabled="" id="delete_csv_name" class="form-control input-lg text-center" value=""
                                   type="text">
                            <input type="hidden" id="delete_csv_id" class="form-control input-lg text-center" value=""
                                   type="text">
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="text-center"><br><h4>Are you sure you want to delete this file?</h4></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" data-dismiss="modal" id="btn_delete_csv"> YES</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
                </div>
            </div>

        </div>
    </div>
    {{-- modal for confirmation --}}
    <div id="confirmModal" class="modal fade in" role="dialog" aria-hidden="false">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">CONFIRM ALL ITEMS IN DR</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="input-group col-md-7">
                            <span class="input-group-addon">
                                <button class="btn btn-danger" id="btn_less_date">
                                    <i class="entypo-minus"></i>
                                </button>
                            </span>
                            <input disabled="" class="form-control input-lg text-center"
                                   value="" type="text" id="confirm_date" value="{{date('Y-m-d')}}">
                            <input type="hidden" id="hdn_is_confirm_all" val="0">
                            <input type="hidden" id="hdn_dr" val="0">
                            <span class="input-group-addon">
                                <button id="btn_add_date" class="btn btn-danger">
                                    <i class="entypo-plus"></i>
                                </button>
                            </span>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="text-center"><br><h4>Please check the date before you confirm.</h4></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" data-dismiss="modal" id="btn_confirm_final"> CONFIRM</button>
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
            var table = $("#DataTables_Table_0");
            var dr_table = $("#DataTables_Table_1");

            loadDRTables();

            /* LOAD CSV TABLES*/
            function loadDRTables() {

                table.DataTable().clear().destroy();

                // Initialize DataTable for CSV Upload list
                table.DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "/encoder/confirmed",
                    columns: [
                        // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'dr_no', name: 'dr_no'},
                        {data: 'atp_no', name: 'atp_no'},
                        {data: 'dr_date', name: 'dr_date'},
                        {data: 'outlet_code', name: 'outlet_code'},
                        {data: 'outlet_code', name: 'outlet_code'},
                        {data: 'dr_qty', name: 'dr_qty', orderable: false, searchable: false},
                        {data: 'po_no', name: 'po_no'},
                        {data: 'details', name: 'details', orderable: false, searchable: false},
                    ],
                    drawCallback: function (settings) {
                        // set the onclick button
                        loadDRItemsTable();

                    },
                    fnRowCallback: function (nRow, aData, iDisplayIndex) {

                    }
                });
            }

            /* LOAD DR TABLES*/
            function loadDRItemsTable() {

                $('.btn_dr_details').click(function () {

                    /* hide dr list table*/
                    $("#div_dr_list").addClass('hidden');

                    /* display dr table*/
                    $("#div_dr_items").removeClass('hidden');

                    /* confirm will come from dr items */
                    $("#hdn_is_confirm_all").val('0');

                    /* update sidebar details for dr */
                    $("#dr_no").html($(this).data('id'));
                    $("#dr_date").html($(this).data('date'));
                    $("#outlet_code").html($(this).data('outlet'));
                    $("#outlet_name").html($(this).data('outlet'));
                    $("#outlet_address").html($(this).data('address'));
                    $("#atp_no").html($(this).data('atp'));
                    $("#po_no").html($(this).data('po'));

                    updateItemTable($(this).data('id'));


                });

            }

            function updateItemTable(dr) {
                // alert();
                /* reset table*/
                dr_table.DataTable().clear().destroy();

                // Initialize DataTable
                dr_table.DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "/encoder/confirmed/items/" + dr,
                    columns: [
                        // {data: 'DT_Row_Index', name: 'DT_Row_Index'},
                        {data: 'model_code', name: 'model_code'},
                        {data: 'model_name', name: 'model_name'},
                        {data: 'frame_no', name: 'frame_no'},
                        {data: 'engine_no', name: 'engine_no'},
                        {data: 'span_status', name: 'span_status'}
                    ],
                    drawCallback: function (settings) {

                    },
                });
            }

            /* BACK BUTTONS*/
            $(".backToDR").click(function () {
                $("#div_dr_list").removeClass('hidden');
                $("#div_dr_items").addClass('hidden');
            });

        });
    </script>
@endsection
