@extends('layouts.admin_app')

@section('content')
    <div class="row">
        <div class="content">
            <!-- Horizontal Form -->
            <div class="box box-info" style="padding-left: 20px; padding-right: 20px;">
                <!-- general form elements -->
                <div class="box-body">
                    <!-- general form elements -->
                    <div class="col-md-3">
                        <a id="drtypebtn" onclick="changedrtype()" class="btn btn-block btn-blue btn-icon btn-lg">ALL
                            TYPES<i class="entypo-right"></i></a>
                        <input type="hidden" id="drtype" value="ALL">
                    </div>
                    <div class="col-md-2">
                        <a id="reptypebtn" onclick="changereptype()" class="btn btn-block btn-gold btn-icon btn-lg">SELECT<i
                                    class="entypo-right"></i></a>
                        <input type="hidden" id="reptype" value="ALL">
                    </div>
                    <div id="reportcontent" class="col-md-7 hidden">
                        <div class="col-md-5">
                            <div class="input-spinner">
                                <button class="btn btn-danger btn-lg" onclick="lessrepdate();">-</button>
                                <input id="condrdate" disabled="" class="form-control size-3 input-lg text-center"
                                       value="2020-02-01" type="text">
                                <button class="btn btn-danger btn-lg" onclick="addrepdate();">+</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <a id="drtypebtn_generate" onclick="generatereport()"
                               class="btn btn-block btn-orange btn-icon btn-lg">GENERATE<i class="entypo-print"></i></a>
                        </div>
                        <div class="col-md-3">
                            <a id="drtypebtn_export" onclick="generatereport()"
                               class="btn btn-block btn-green btn-icon btn-lg">EXPORT<i
                                        class="fa fa-file-excel-o"></i></a>
                        </div>
                        <input id="conrepdate" value="2020-02-01" type="hidden">
                    </div>

                    <!-- /.box -->
                </div>
            </div>

            <div class="row pt-50">
            </div>

            <div id="admincontent">
                <div>
                    <div class="panel panel-primary panel-table">
                        <div class="panel-body">
                            <p class="bold">REPORT GENERATED</p>

                            <div id="DataTables_Table_0_wrapper"
                                 class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="dataTables_length" id="DataTables_Table_0_length"><label>Show
                                                <select name="DataTables_Table_0_length"
                                                        aria-controls="DataTables_Table_0"
                                                        class="form-control input-sm">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select> entries</label></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                            <label>Search:<input type="search" class="form-control input-sm"
                                                                 placeholder=""
                                                                 aria-controls="DataTables_Table_0"></label></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-responsive table-bordered dataTable table-striped table-hover no-footer"
                                               id="DataTables_Table_0" role="grid"
                                               aria-describedby="DataTables_Table_0_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting_desc" tabindex="0" aria-controls="DataTables_Table_0"
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

                                            <tr role="row" class="odd">
                                                <td class="sorting_1"><h5 class="mt-0"></h5></td>
                                                <td><h5 class="mt-0"></h5></td>
                                                <td><h5 class="mt-0"></h5></td>
                                                <td><h5 class="mt-0"></h5></td>
                                                <td><h5 class="mt-0"></h5></td>
                                                <td><h5 class="mt-0"></h5></td>
                                                <td><h5 class="mt-0"></h5></td>
                                                <td><h5 class="mt-0"></h5></td>
                                                <td><h5 class="mt-0"></h5></td>
                                                <td><h5 class="mt-0"></h5></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="dataTables_info" id="DataTables_Table_0_info" role="status"
                                             aria-live="polite">Showing 1 to 1 of 1 entries
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="dataTables_paginate paging_simple_numbers"
                                             id="DataTables_Table_0_paginate">
                                            <ul class="pagination">
                                                <li class="paginate_button previous disabled"
                                                    id="DataTables_Table_0_previous"><a href="#"
                                                                                        aria-controls="DataTables_Table_0"
                                                                                        data-dt-idx="0" tabindex="0">Previous</a>
                                                </li>
                                                <li class="paginate_button active"><a href="#"
                                                                                      aria-controls="DataTables_Table_0"
                                                                                      data-dt-idx="1" tabindex="0">1</a>
                                                </li>
                                                <li class="paginate_button next disabled" id="DataTables_Table_0_next">
                                                    <a href="#" aria-controls="DataTables_Table_0" data-dt-idx="2"
                                                       tabindex="0">Next</a></li>
                                            </ul>
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
    <script>
    function changereptype(){
        var reptype = $("#reptype").val();
        if(reptype=='ALL'){
            $("#reptype").val('DAILY')
            $("#reptypebtn").html('DAILY <i class="entypo-right"></i>')
        }
        else if(reptype=='DAILY'){
            $("#reptype").val('MONTHLY')
            $("#reptypebtn").html('MONTHLY <i class="entypo-right"></i>')
        }
        else {
            $("#reptype").val('ALL')
            $("#reptypebtn").html('ALL <i class="entypo-right"></i>')
        }
    }
    function changedrtype(){
        var drtype = $("#drtype").val();
        if(drtype=='ALL'){
            $("#drtype").val('PENDING')
            $("#drtypebtn").html('PENDING <i class="entypo-right"></i>')
        }
        else if(drtype=='PENDING'){
            $("#drtype").val('IN-TRANSIT')
            $("#drtypebtn").html('IN-TRANSIT <i class="entypo-right"></i>')
        }
        else if(drtype=='IN-TRANSIT'){
            $("#drtype").val('CONFIRMED')
            $("#drtypebtn").html('CONFIRMED <i class="entypo-right"></i>')
        }
        else if(drtype=='CONFIRMED'){
            $("#drtype").val('DELIVERED')
            $("#drtypebtn").html('DELIVERED <i class="entypo-right"></i>')
        }
        else if(drtype=='DELIVERED'){
            $("#drtype").val('BACKLOAD')
            $("#drtypebtn").html('BACKLOAD <i class="entypo-right"></i>')
        }
        else {
            $("#drtype").val('ALL')
            $("#drtypebtn").html('ALL <i class="entypo-right"></i>')
        }
    }
    </script>
@endsection