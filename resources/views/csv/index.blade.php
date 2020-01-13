@extends('layouts.user_app')

@section('content')

    <div class="row">
        <div class="content">
            <!-- Horizontal Form -->
            <div class="box box-info" style="padding-left: 20px; padding-right: 20px;">
                <!-- general form elements -->
                <div class="box-body">
                    <!-- general form elements -->
                    <form action="http://test.yamahalogistics.com/admin/upload" method="post"
                          enctype="multipart/form-data" onsubmit="uploadstart()">
                        <div class="col-md-4">
                            <input type="button" class="btn btn-block btn-primary btn-lg"
                                   onclick="document.getElementById('fu').click()" value="Select CSV file">
                            <input type="file" id="fu" name="pfilename" accept=".csv" onchange="FileSelected()"
                                   style="width: 0;">
                            <input type="hidden" name="ptype" id="csvtype" value="navision">
                        </div>
                        <div class="col-md-4">
                            <input id="fileName" disabled="" class="form-control input-lg" type="text"
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
                        <div class="panel-body">
                            <p class="bold">LIST OF FILES UPLOADED</p>
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
                                            <label>Search:<input
                                                        type="search" class="form-control input-sm" placeholder=""
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
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="dataTables_info" id="DataTables_Table_0_info" role="status"
                                             aria-live="polite">Showing 1 to 10 of 623 entries
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="dataTables_paginate paging_simple_numbers"
                                             id="DataTables_Table_0_paginate">
                                            <ul class="pagination">
                                                <li class="paginate_button previous disabled"
                                                    id="DataTables_Table_0_previous"><a href="#"
                                                                                        aria-controls="DataTables_Table_0"
                                                                                        data-dt-idx="0"
                                                                                        tabindex="0">Previous</a>
                                                </li>
                                                <li class="paginate_button active"><a href="#"
                                                                                      aria-controls="DataTables_Table_0"
                                                                                      data-dt-idx="1"
                                                                                      tabindex="0">1</a></li>
                                                <li class="paginate_button "><a href="#"
                                                                                aria-controls="DataTables_Table_0"
                                                                                data-dt-idx="2" tabindex="0">2</a>
                                                </li>
                                                <li class="paginate_button "><a href="#"
                                                                                aria-controls="DataTables_Table_0"
                                                                                data-dt-idx="3" tabindex="0">3</a>
                                                </li>
                                                <li class="paginate_button "><a href="#"
                                                                                aria-controls="DataTables_Table_0"
                                                                                data-dt-idx="4" tabindex="0">4</a>
                                                </li>
                                                <li class="paginate_button "><a href="#"
                                                                                aria-controls="DataTables_Table_0"
                                                                                data-dt-idx="5" tabindex="0">5</a>
                                                </li>
                                                <li class="paginate_button disabled"
                                                    id="DataTables_Table_0_ellipsis"><a href="#"
                                                                                        aria-controls="DataTables_Table_0"
                                                                                        data-dt-idx="6"
                                                                                        tabindex="0">…</a></li>
                                                <li class="paginate_button "><a href="#"
                                                                                aria-controls="DataTables_Table_0"
                                                                                data-dt-idx="7" tabindex="0">63</a>
                                                </li>
                                                <li class="paginate_button next" id="DataTables_Table_0_next"><a
                                                            href="#" aria-controls="DataTables_Table_0" data-dt-idx="8"
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
