@extends('layouts.user_app')

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
                        <form id="form-filter" class="form-horizontal" method="POST" action="http://test.yamahalogistics.com/admin/export_csv">
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
                                        <option id="optfirst" value="">ALL</option>
                                        <option value="PENDING">PENDING</option>
                                        <option value="IN-TRANSIT">IN-TRANSIT</option>
                                        <option value="CONFIRMED">CONFIRMED</option>
                                        <option value="DELIVERED">DELIVERED</option>
                                        <option value="BACKLOAD">BACKLOAD</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <input type="text" name="str_dr_date" class="form-control" id="str_dr_date" placeholder="YYYY-MM-DD">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <button type="button" id="btn-filter" class="btn btn-primary btn-block">Filter</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-success btn-block">Export</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <button type="button" id="btn-reset" class="btn btn-default btn-block">Reset</button>
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

                        <div id="table_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="dataTables_length" id="table_length"><label>Show <select name="table_length" aria-controls="table" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div><div id="table_processing" class="dataTables_processing panel panel-default" style="display: none;">Processing...</div><table id="table" class="table table-responsive table-bordered table-striped table-hover dataTable" role="grid" aria-describedby="table_info">
                                <thead>
                                <tr role="row"><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 18px;"> NO </th><th class="sorting" tabindex="0" aria-controls="table" rowspan="1" colspan="1" style="width: 34px;"> DR NO </th><th class="sorting" tabindex="0" aria-controls="table" rowspan="1" colspan="1" style="width: 48px;"> DR DATE </th><th class="sorting" tabindex="0" aria-controls="table" rowspan="1" colspan="1" style="width: 80px;"> OUTLET CODE</th><th class="sorting" tabindex="0" aria-controls="table" rowspan="1" colspan="1" style="width: 80px;"> OUTLET NAME</th><th class="sorting" tabindex="0" aria-controls="table" rowspan="1" colspan="1" style="width: 59px;"> FRAME NO</th><th class="sorting" tabindex="0" aria-controls="table" rowspan="1" colspan="1" style="width: 63px;"> ENGINE NO</th><th class="sorting" tabindex="0" aria-controls="table" rowspan="1" colspan="1" style="width: 47px;"> STATUS</th><th class="sorting" tabindex="0" aria-controls="table" rowspan="1" colspan="1" style="width: 67px;"> GUARD OUT</th><th class="sorting" tabindex="0" aria-controls="table" rowspan="1" colspan="1" style="width: 73px;"> CONFIRMED</th><th class="sorting" tabindex="0" aria-controls="table" rowspan="1" colspan="1" style="width: 69px;"> DELIVERED</th></tr></thead>
                                <tbody>
                                </tbody>

                                <tfoot>
                                <tr><th rowspan="1" colspan="1"> NO </th><th rowspan="1" colspan="1"> DR NO </th><th rowspan="1" colspan="1"> DR DATE </th><th rowspan="1" colspan="1"> OUTLET CODE</th><th rowspan="1" colspan="1"> OUTLET NAME</th><th rowspan="1" colspan="1"> FRAME NO</th><th rowspan="1" colspan="1"> ENGINE NO</th><th rowspan="1" colspan="1"> STATUS</th><th rowspan="1" colspan="1"> GUARD OUT</th><th rowspan="1" colspan="1"> CONFIRMED</th><th rowspan="1" colspan="1"> DELIVERED</th></tr>
                                </tfoot>
                            </table><div class="dataTables_info" id="table_info" role="status" aria-live="polite"></div><div class="dataTables_paginate paging_simple_numbers" id="table_paginate"></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
