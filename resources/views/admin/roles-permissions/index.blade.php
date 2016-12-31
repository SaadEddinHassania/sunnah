@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/css/select2-bootstrap.css" rel="stylesheet">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>{{ $dataType->display_name_singular }}
    </h1>
@stop

@section('page_header_actions')

@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post" enctype="multipart/form-data"
                      action="{{route('admin.roles-permissions.update')}}">
                    <div class="row">
                        <div class="col-md-6 pull-right">
                            <div class="panel panel-bordered panel-dark">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="icon wb-clipboard"></i> الدور</h3>
                                    <div class="panel-actions">
                                        <a class="panel-action icon wb-minus" data-toggle="panel-collapse"
                                           aria-hidden="true"></a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <select name="role_id" onchange="setTable(this)" class="form-control">
                                            @foreach($roles as $key => $value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" value="حفظ" class="btn btn-success  form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="panel panel-bordered panel-dark">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="icon wb-clipboard"></i> الصلاحيات</h3>
                                    <div class="panel-actions">
                                        <a class="panel-action icon wb-minus" data-toggle="panel-collapse"
                                           aria-hidden="true"></a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <table id="dataTable" class="table table-hover">
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $(document).ready(function () {
            $('select').select2({
                theme: "bootstrap"
            });
            $.get("/admin/roles-permissions/tbody/1", function (data) {
                $('#dataTable').html(data);
            });
            $('#dataTable').dataTable({
                destroy: true,
            });


        });
        function setTable(select) {
            $.get("/admin/roles-permissions/tbody/" + $(select).val(), function (data) {
                $('#dataTable').hide().html(data).fadeIn('slow');
            });
        }

        function unckeckGlobal(checkbox) {
            if ($(checkbox).is(':checked')) {
                $('#global_' + $(checkbox).attr('id').split('_')[1]).attr('disabled', false);
            } else {
                $('#global_' + $(checkbox).attr('id').split('_')[1]).attr('checked', false);
                $('#global_' + $(checkbox).attr('id').split('_')[1]).attr('disabled', true);
            }
        }

    </script>
@stop