@extends('layouts.user_app')

@section('content')

    <div class="row">
        <div class="content">
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
                        <div class="panel-body">
                            <p class="bold">LIST OF FILES UPLOADED</p>
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

            /* iNitialize table */
            var table = $( "#DataTables_Table_0" );

            // Initialize DataTable
            table.DataTable( {
                "dom": 'frtip',
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "bStateSave": true
            });

            // Initalize Select Dropdown after DataTables is created
            table.closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
                minimumResultsForSearch: -1
            });
        });
    </script>
@endsection
