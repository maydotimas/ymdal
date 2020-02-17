@extends('layouts.admin_app')

@section('content')
    <div class="row">
        <div class="content">
            <!-- Horizontal Form -->
            <div class="box box-info" style="padding-left: 20px; padding-right: 20px;">
                <!-- general form elements -->
                <div class="box-body">

                    <!-- FILTER TYPES AND STATUS -->
                    <div class="col-md-3">
                        <a id="drtypebtn" class="btn btn-block btn-blue btn-icon btn-lg">ALL
                            TYPES<i class="entypo-right"></i></a>
                        <input type="hidden" id="drtype" value="ALL">
                    </div>
                    <div class="col-md-2">
                        <a id="reptypebtn" class="btn btn-block btn-gold btn-icon btn-lg">SELECT<i
                                    class="entypo-right"></i></a>
                        <input type="hidden" id="reptype" value="ALL">
                    </div>

                    {{-- DAILY FILTER--}}
                    <div id="reportcontent_daily" class="col-md-7 hidden">
                        <div class="col-md-5" id="dr_date">
                            <div class="input-spinner">
                                <button class="btn btn-danger btn-lg" id="btn_sub_daily">-</button>

                                <input id="dr_date_daily" disabled="" class="form-control size-3 input-lg text-center"
                                       type="text">

                                <button class="btn btn-danger btn-lg" id="btn_add_daily">+</button>
                            </div>

                            <input id="cur_date_daily" type="hidden">
                        </div>

                        {{-- GENERATE BUTTON TO TABLE--}}
                        <div class="col-md-4">
                            <a id="drtypebtn"
                               class="btn btn-block btn-orange btn-icon btn-lg btn_generate">GENERATE<i
                                        class="entypo-print"></i></a>
                        </div>

                        {{-- GENERATE TO EXCEL --}}
                        <div class="col-md-3">
                            <a id="drtypebtn"
                               class="btn btn-block btn-green btn-icon btn-lg btn_export">EXPORT<i
                                        class="fa fa-file-excel-o"></i></a>
                        </div>
                    </div>

                    {{--  MONTH FILTER --}}
                    <div id="reportcontent_monthly" class="col-md-7 hidden">
                        <div class="col-md-5" id="dr_date">
                            <div class="input-spinner">
                                <button class="btn btn-danger btn-lg" id="btn_sub_monthly">-</button>

                                <input id="dr_date_monthy" disabled="" class="form-control size-3 input-lg text-center"
                                       type="text">

                                <button class="btn btn-danger btn-lg" id="btn_add_monthly">+</button>
                            </div>

                            <input id="cur_date_monthly" type="hidden">
                        </div>

                        {{-- GENERATE BUTTON --}}
                        <div class="col-md-4">
                            <a id="drtypebtn"
                               class="btn btn-block btn-orange btn-icon btn-lg btn_generate">GENERATE<i
                                        class="entypo-print"></i></a>
                        </div>

                        {{-- EXPORT TO EXCEL FILE--}}
                        <div class="col-md-3">
                            <a id="drtypebtn"
                               class="btn btn-block btn-green btn-icon btn-lg btn_export">EXPORT<i
                                        class="fa fa-file-excel-o"></i></a>
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                {{-- BORDER --}}
                <div class="row pt-50">
                </div>

                {{-- TABLE --}}
                <div id="admincontent">
                    <div>
                        <div class="panel panel-primary panel-table">
                            <div class="panel-body">
                                <p class="bold">REPORT GENERATED</p>

                                <div id="DataTables_Table_0_wrapper"
                                     class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-responsive table-bordered dataTable table-striped table-hover no-footer"
                                                   id="DataTables_Table_0" role="grid"
                                                   aria-describedby="DataTables_Table_0_info">
                                                <thead>
                                                <tr role="row">
                                                    <th class="sorting_desc" tabindex="0"
                                                        aria-controls="DataTables_Table_0"
                                                        rowspan="1" colspan="1" aria-sort="descending"
                                                        aria-label=" DR NO : activate to sort column ascending"
                                                        style="width: 38px;"> DR NO
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                        rowspan="1" colspan="1"
                                                        aria-label=" DR DATE : activate to sort column ascending"
                                                        style="width: 52px;"> DR DATE
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                        rowspan="1" colspan="1"
                                                        aria-label=" OUTLET CODE: activate to sort column ascending"
                                                        style="width: 85px;"> OUTLET CODE
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                        rowspan="1" colspan="1"
                                                        aria-label=" OUTLET NAME: activate to sort column ascending"
                                                        style="width: 86px;"> OUTLET NAME
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                        rowspan="1" colspan="1"
                                                        aria-label=" FRAME NO: activate to sort column ascending"
                                                        style="width: 64px;"> FRAME NO
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                        rowspan="1" colspan="1"
                                                        aria-label=" ENGINE NO: activate to sort column ascending"
                                                        style="width: 68px;"> ENGINE NO
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                        rowspan="1" colspan="1"
                                                        aria-label=" STATUS: activate to sort column ascending"
                                                        style="width: 47px;"> STATUS
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                        rowspan="1" colspan="1"
                                                        aria-label=" GUARD OUT: activate to sort column ascending"
                                                        style="width: 73px;"> GUARD OUT
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                        rowspan="1" colspan="1"
                                                        aria-label=" CONFIRMED: activate to sort column ascending"
                                                        style="width: 73px;"> CONFIRMED
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                        rowspan="1" colspan="1"
                                                        aria-label=" DELIVERED: activate to sort column ascending"
                                                        style="width: 69px;"> DELIVERED
                                                    </th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                <td colspan="10">NO DATA AVAILABLE</td>
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
    </div>
@endsection
@section('extra-scripts')

    <script src="/neon/assets/js/datatables/datatables.js"></script>
    <script>
        $(document).ready(function () {
            /* initialize vars*/
            var date = formatDate(Date.now());
            $("#dr_date_daily").val(date);
            $("#cur_date_daily").val(date);
            $("#dr_date_monthy").val(initializeMonthDate());
            $("#cur_date_monthly").val(date);

            /*
            *
            * ACTION BUTTONS
            *
            * */

            /* change filters*/
            $("#reptypebtn").click(function () {
                var reptype = $("#reptype").val();
                if (reptype == 'ALL') {

                    /* UPDATE FILTER VALUES */
                    $("#reptype").val('DAILY')
                    $("#reptypebtn").html('DAILY <i class="entypo-right"></i>')
                    $("#dr_date").removeClass('hidden');

                    $("#reportcontent_daily").removeClass('hidden')
                    $("#reportcontent_monthly").addClass('hidden')
                }
                else if (reptype == 'DAILY') {
                    /* UPDATE FILTER VALUES*/
                    $("#reptype").val('MONTHLY')
                    $("#reptypebtn").html('MONTHLY <i class="entypo-right"></i>')
                    $("#dr_date").removeClass('hidden')

                    $("#reportcontent_daily").addClass('hidden')
                    $("#reportcontent_monthly").removeClass('hidden')
                }
                else {
                    /* RESET VALUES */
                    $("#reptype").val('ALL')
                    $("#reptypebtn").html('ALL <i class="entypo-right"></i>')
                    $("#dr_date").addClass('hidden')

                    $("#reportcontent_daily").addClass('hidden')
                    $("#reportcontent_monthly").addClass('hidden')


                }
            });

            $("#drtypebtn").click(function () {
                var drtype = $("#drtype").val();
                if (drtype == 'ALL') {
                    $("#drtype").val('PENDING')
                    $("#drtypebtn").html('PENDING <i class="entypo-right"></i>')
                }
                else if (drtype == 'PENDING') {
                    $("#drtype").val('IN-TRANSIT')
                    $("#drtypebtn").html('IN-TRANSIT <i class="entypo-right"></i>')
                }
                else if (drtype == 'IN-TRANSIT') {
                    $("#drtype").val('CONFIRMED')
                    $("#drtypebtn").html('CONFIRMED <i class="entypo-right"></i>')
                }
                else if (drtype == 'CONFIRMED') {
                    $("#drtype").val('DELIVERED')
                    $("#drtypebtn").html('DELIVERED <i class="entypo-right"></i>')
                }
                else if (drtype == 'DELIVERED') {
                    $("#drtype").val('BACKLOAD')
                    $("#drtypebtn").html('BACKLOAD <i class="entypo-right"></i>')
                }
                else {
                    $("#drtype").val('ALL')
                    $("#drtypebtn").html('ALL <i class="entypo-right"></i>')
                }
            });

            /* add buttons daily*/
            $("#btn_add_daily").click(function () {
                var date = new Date($("#cur_date_daily").val());
                var new_date = addDate(date);
                $("#dr_date_daily").val(new_date);
                $("#cur_date_daily").val(new_date);
            })

            /* sub buttons daily*/
            $("#btn_sub_daily").click(function () {
                var date = new Date($("#cur_date_daily").val());
                var new_date = subDate(date);
                $("#dr_date_daily").val(new_date);
                $("#cur_date_daily").val(new_date);
            })

            /* date monthly */
            $("#btn_add_monthly").click(function () {
                var date = new Date($("#cur_date_monthly").val());
                var new_date = addDateMonth(date);
                $("#dr_date_monthy").val(new_date[0]);
                $("#cur_date_monthly").val(new_date[1]);
            })

            /* sub buttons monthly */
            $("#btn_sub_monthly").click(function () {
                var date = new Date($("#cur_date_monthly").val());
                var new_date = subDateMonth(date);
                $("#dr_date_monthy").val(new_date[0]);
                $("#cur_date_monthly").val(new_date[1]);
            })

            $(".btn_generate").click(function () {
                getReport();
            })

            $(".btn_export").click(function(){
                exportReport();
            })
            /*
            *
            * FUNCTIONS FOR DATE
            *
            * */

            /* update dates */
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

            /* add date*/
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

            /* sub month */
            function subDateMonth(date) {

                var months = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEPT", "OCT", "NOV", "DEC"];

                var d = new Date(date),
                    month = '' + (d.getMonth() - 1),
                    year = d.getFullYear();

                /* for december turn to january */
                if (parseInt(month) < 0) {

                    date = new Date((year - 1), 12, 0);

                    d = new Date(date),
                        month = d.getMonth(),
                        year = d.getFullYear();
                } else {
                    var new_month = parseInt(month) + 1;

                    date = new Date(year, new_month, 0);

                    d = new Date(date),
                        month = d.getMonth(),
                        year = d.getFullYear();
                }

                var display = [months[month], year].join('-');
                var date = formatDate(d);

                return [display, date];
            }

            /* add month */
            function addDateMonth(date) {

                var months = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEPT", "OCT", "NOV", "DEC"];

                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    year = d.getFullYear();

                /* for december turnover to january add year*/
                if (parseInt(month) < 0) {

                    date = new Date((year + 1), 12, 0);

                    d = new Date(date),
                        month = d.getMonth(),
                        year = d.getFullYear();
                } else {
                    var new_month = parseInt(month) + 1;

                    date = new Date(year, new_month, 0);

                    d = new Date(date),
                        month = d.getMonth(),
                        year = d.getFullYear();
                }

                var display = [months[month], year].join('-');
                var date = formatDate(d);

                return [display, date];
            }

            /* date format */
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

            /* initialize month date format */
            function initializeMonthDate() {

                var months = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEPT", "OCT", "NOV", "DEC"];

                var d = new Date(date),
                    month = '' + (d.getMonth()),
                    year = d.getFullYear();

                var display = [months[month], year].join('-');

                return display;
            }

            /* initialize table */
            function getReport() {
                var dr_table = $("#DataTables_Table_0");
                /* reset table*/
                dr_table.DataTable().clear().destroy();

                // Initialize DataTable
                dr_table.DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "/admin/reports/per-transaction?reptype=" + $("#reptype").val()
                                                                    + "&drtype=" + $("#drtype").val()
                                                                    + "&cur_date_daily=" + $("#cur_date_daily").val()
                                                                    + "&cur_date_monthly=" + $("#cur_date_monthly").val(),
                    dataSrc: "",
                    columns: [
                        {data: 'dr_no', name: 'dr_no'},
                        {data: 'dr_date', name: 'dr_date'},
                        {data: 'outlet_code', name: 'outlet_code'},
                        {data: 'outlet_code', name: 'outlet_code'},
                        {data: 'frame_no', name: 'frame_no'},
                        {data: 'engine_no', name: 'engine_no'},
                        {data: 'status', name: 'status'},
                        {data: 'guard_out', name: 'guard_out', orderable: false, searchable: false},
                        {data: 'confirm_date', name: 'confirmed', orderable: false, searchable: false},
                        {data: 'deliver_date', name: 'delivered', orderable: false, searchable: false},
                    ],
                    drawCallback: function (settings) {
                    },
                });
            }

            /* Export Report */
            function exportReport(){
                var url = "/admin/reports/per-transaction/download?reptype=" + $("#reptype").val()
                    + "&drtype=" + $("#drtype").val()
                    + "&cur_date_daily=" + $("#cur_date_daily").val()
                    + "&cur_date_monthly=" + $("#cur_date_monthly").val();
                window.open(url,"_blank");
            }

        });

    </script>
@endsection