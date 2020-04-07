@extends('layouts.encoder_app')

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
                                            @if($confirm_all)
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1"
                                                    aria-label=" : activate to sort column ascending"
                                                ></th>
                                            @endif
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
                                                @if($checkbox)
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_1"
                                                        rowspan="1" colspan="1"
                                                        aria-label=" : activate to sort column ascending"
                                                        style="width: 51px;">
                                                    </th>
                                                @endif
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

                            <!--- <button class="btn btn-success" data-toggle="modal" data-target="#alldrModal"> CONFIRM ALL</button> --->
                            @if($edit)
                            <button class="btn btn-info" id="btn_check_all" data-id=""> CHECK ALL</button>
                            <button class="btn btn-danger" id="btn_uncheck_all" data-id=""> UNCHECK ALL</button>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#confirmModal"
                                    id="btn_confirm"> CONFIRM
                            </button>
                            <input id="nav_url" type="hidden" value="encoder/pending">
                            @endif

                            <button
                                    class="btn btn-primary backToDR"> BACK
                            </button>
                        </div>
                    </div>
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

                // table.DataTable().clear().destroy();

                // Initialize DataTable for CSV Upload list
                table.DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "/{{$role}}/{{$current_status}}",
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
                            @if($confirm_all)
                        {
                            data: 'confirm', name: 'confirm', orderable: false, searchable: false
                        },
                        @endif
                    ],
                    drawCallback: function (data) {
                        console.log(data);
                        // set the onclick button
                        loadDRItemsTable();
                        @if($confirm_all)
                        /* confirm all*/
                        $(".btn_confirm_all").click(function () {
                            $("#hdn_is_confirm_all").val(1);
                            $("#hdn_dr").val($(this).data('id'));
                            var date = formatDate(Date.now());
                            $("#confirm_date").val(date);
                        });
                        @endif
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
                    ajax: "/{{$role}}/{{$current_status}}/items/" + dr,
                    columns: [
                        // {data: 'DT_Row_Index', name: 'DT_Row_Index'},
                        {data: 'model_code', name: 'model_code'},
                        {data: 'model_name', name: 'model_name'},
                        {data: 'frame_no', name: 'frame_no'},
                        {data: 'engine_no', name: 'engine_no'},
                        {data: 'span_status', name: 'span_status'},
                        @if($checkbox)
                            {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false}
                        @endif
                    ],
                    drawCallback: function (settings) {
                        /* check and uncheck items*/
                        $(".btn_check_uncheck").click(function () {
                            var id = $(this).data('id');

                            /* CHECK CURRENT STATUS*/
                            var status = $("#status_" + id).html();
                            if (status.toLowerCase() == '{{strtolower($current_status)}}') {
                                /* update the button class*/
                                $(this).removeClass('btn-danger');
                                $(this).addClass('btn-success');

                                /* update the symbol display*/
                                $("#icon_" + id).removeClass('fa-minus-square');
                                $("#icon_" + id).addClass('fa-check-square');

                                /* update the status span*/
                                $("#status_" + id).html('{{strtoupper($new_status)}}');

                                /* add the value for updating status*/
                                $("#" + id).val($(this).data('id'));


                                /* update temporary detail */
                                $.ajax({
                                    method: "get",
                                    url: "/{{$role}}/{{$current_status}}/update/" + id + "/{{$new_status}}"
                                });
                            } else {
                                /* update the button class*/
                                $(this).addClass('btn-danger');
                                $(this).removeClass('btn-success');

                                /* update the symbol display*/
                                $("#icon_" + id).addClass('fa-minus-square');
                                $("#icon_" + id).removeClass('fa-check-square');

                                /* update the status span*/
                                $("#status_" + id).html('{{strtoupper($current_status)}}');

                                /* add the value for updating status*/
                                $("#" + id).val('');

                                /* update temporary detail */
                                $.ajax({
                                    method: "get",
                                    url: "/{{$role}}/{{$current_status}}/update/" + id + "/{{$current_status}}/"
                                });
                            }

                        });
                    },
                });
            }

            /* check all */
            $("#btn_check_all").click(function () {
                var dr = $("#dr_no").html();
                /* update temporary detail */
                $.ajax({
                    method: "get",
                    url: "/{{$role}}/{{$current_status}}/dr/update_all/" + dr + "/check"
                }).done(function (msg) {
                    updateItemTable(dr);
                });
            });

            /* uncheck all */
            $("#btn_uncheck_all").click(function () {
                var dr = $("#dr_no").html();
                /* update temporary detail */
                $.ajax({
                    method: "get",
                    url: "/{{$role}}/{{$current_status}}/dr/update_all/" + dr + "/uncheck"
                }).done(function (msg) {
                    updateItemTable(dr);
                });
            });

            /* date add / less */
            function formatDate(date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + (d.getDate()),
                    year = d.getFullYear();

                if (month.length < 2)
                    month = '0' + month;
                if (day.length < 2)
                    day = '0' + day;

                return [year, month, day].join('-');
            }

            function subDate(date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + (d.getDate() - 1),
                    year = d.getFullYear();

                if (day == 0) {
                    month = d.getMonth();
                    date = new Date(year, month, 0);

                    d = new Date(date),
                        month = '' + (d.getMonth() + 1),
                        day = '' + (d.getDate()),
                        year = d.getFullYear();
                }

                if (month.length < 2)
                    month = '0' + month;
                if (day.length < 2)
                    day = '0' + day;

                return [year, month, day].join('-');
            }

            function addDate(date) {

                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + (d.getDate() + 1),
                    year = d.getFullYear();

                var cur_date = new Date();
                var cur_day = (cur_date.getDate());

                if (day >= cur_day) {
                    d = new Date(date),
                        month = '' + (cur_date.getMonth() + 1),
                        day = '' + (cur_date.getDate()),
                        year = cur_date.getFullYear();
                }

                if (month.length < 2)
                    month = '0' + month;
                if (day.length < 2)
                    day = '0' + day;

                return [year, month, day].join('-');
            }

            /* confirm */
            $("#btn_confirm").click(function () {
                var date = formatDate(Date.now());
                $("#confirm_date").val(date);
            });

            /* date subtract */
            $("#btn_less_date").click(function () {
                var date = new Date($("#confirm_date").val());
                $("#confirm_date").val(subDate(date));
            });

            /* date add */
            $("#btn_add_date").click(function () {
                var date = new Date($("#confirm_date").val());
                $("#confirm_date").val(addDate(date));
            });

            /* confirm final */
            $("#btn_confirm_final").click(function () {
                // check if transaction is normal confirm
                if ($("#hdn_is_confirm_all").val() != '1') {
                    var dr = $("#dr_no").html();
                    /* update temporary detail */
                    $.ajax({
                        method: "get",
                        url: "/{{$role}}/{{$current_status}}/confirm/" + dr + "/" + $("#confirm_date").val()
                    }).done(function (msg) {
                        updateItemTable(dr);
                    });
                }
                // update all
                else {
                    var dr = $("#hdn_dr").val();
                    /* update temporary detail */
                    $.ajax({
                        method: "get",
                        url: "/{{$role}}/{{$current_status}}/confirm_all/" + dr + "/" + $("#confirm_date").val()
                    }).done(function (msg) {
                        // hide the class
                        $("#row_" + dr).closest('tr').addClass('hidden');
                    });
                }
            });

            /* BACK BUTTONS*/
            $(".backToDR").click(function () {
                $("#div_dr_list").removeClass('hidden');
                $("#div_dr_items").addClass('hidden');
            });

        });
    </script>
@endsection
