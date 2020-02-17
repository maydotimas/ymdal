@extends('layouts.admin_app')

@section('content')
    <div class="content">
        <!-- Horizontal Form -->
        <div class="panel panel-success" data-collapsed="0">
            <div class="panel-heading">
                <h3 class="panel-title">CUSTOM FILTER </h3>
                <div class="panel-options">
                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                </div>
            </div>
            <div class="panel-body" style="display: none;">
                <div class="box box-info" style="padding-left: 20px; padding-right: 20px;">
                    <!-- general form elements -->
                    <div class="box-body">
                        <!-- general form elements -->
                        <form id="form-filter" class="form-horizontal" method="POST"
                              action="http://test.yamahalogistics.com/admin/export_csv">
                            <div class="col-md-4 text-right">
                                <div class="form-group">
                                    <label for="nav_status" class="col-sm-10 control-label">DR STATUS</label>

                                </div>
                                <div class="form-group">
                                    <label for="str_dr_date" class="col-sm-10 control-label">DR DATE</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select id="nav_status" name="nav_status" class="col-sm-8 selectboxit visible">
                                        <option id="optfirst" value="ALL">ALL</option>
                                        <option value="PENDING">PENDING</option>
                                        <option value="IN-TRANSIT">IN-TRANSIT</option>
                                        <option value="CONFIRMED">CONFIRMED</option>
                                        <option value="DELIVERED">DELIVERED</option>
                                        <option value="BACKLOAD">BACKLOAD</option>
                                    </select>
                                </div>

                                <div class="input-group">
                                    <input id="str_dr_date" type="text" class="form-control datepicker" readonly
                                           value="{{date('Y-m-d')}}"
                                           data-format="yyyy-mm-dd">

                                    <div class="input-group-addon">
                                        <a href="#"><i class="entypo-calendar"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <button type="button" id="btn-filter" class="btn btn-primary btn-block">Filter
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <button type="submit" id="btn-export" class="btn btn-success btn-block">Export</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <button type="button" id="btn-reset" class="btn btn-default btn-block">Reset
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- /.box -->
                    </div>
                </div>
            </div>
        </div>
        <div id="admincontent">
            <div>
                <div class="panel panel-primary panel-table">
                    <div class="panel-body">
                        <p class="bold">LIST OF ITEMS UPLOADED</p>

                        <div id="table_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                            <table id="table"
                                   class="table table-responsive table-bordered table-striped table-hover dataTable"
                                   role="grid" aria-describedby="table_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 18px;"> NO</th>
                                    <th class="sorting" tabindex="0" aria-controls="table" rowspan="1" colspan="1"
                                        style="width: 34px;"> DR NO
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="table" rowspan="1" colspan="1"
                                        style="width: 48px;"> DR DATE
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="table" rowspan="1" colspan="1"
                                        style="width: 80px;"> OUTLET CODE
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="table" rowspan="1" colspan="1"
                                        style="width: 80px;"> OUTLET NAME
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="table" rowspan="1" colspan="1"
                                        style="width: 59px;"> FRAME NO
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="table" rowspan="1" colspan="1"
                                        style="width: 63px;"> ENGINE NO
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="table" rowspan="1" colspan="1"
                                        style="width: 47px;"> STATUS
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="table" rowspan="1" colspan="1"
                                        style="width: 67px;"> GUARD OUT
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="table" rowspan="1" colspan="1"
                                        style="width: 73px;"> CONFIRMED
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="table" rowspan="1" colspan="1"
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
@endsection

@section('extra-scripts')

    <script src="/neon/assets/js/datatables/datatables.js"></script>
    <script>
        $(document).ready(function () {
            /* initialize vars*/

            /*
            *
            * ACTION BUTTONS
            *
            * */

            /* change filters*/
            $("#btn-filter").click(function () {
                getReport();
            })

            $("#btn-export").click(function () {
                exportReport();
            })

            $("#btn-reset").click(function () {
                resetFilter();
            })

            /*
            *
            * FUNCTIONS FOR DATE
            *
            * */

            /* initialize table */
            function getReport() {
                var dr_table = $("#table");
                /* reset table*/
                dr_table.DataTable().clear().destroy();

                // Initialize DataTable
                dr_table.DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "/admin/csv/history?status=" + $("#nav_status").val()
                    + "&date=" + $("#str_dr_date").val(),
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
            function exportReport() {
                var url = "/admin/reports/per-transaction/download?reptype=" + $("#reptype").val()
                    + "&drtype=" + $("#drtype").val()
                    + "&cur_date_daily=" + $("#cur_date_daily").val()
                    + "&cur_date_monthly=" + $("#cur_date_monthly").val();
                window.open(url, "_blank");
            }

            /* Reset Filter */
            function resetFilter(){

            }

        });

    </script>
@endsection
