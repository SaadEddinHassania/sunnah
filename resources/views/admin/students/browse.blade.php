@extends('voyager::master')

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> {{ $dataType->display_name_plural }}
        @can('create', \App\Models\Student::class)
        <a href="{{ route($dataType->slug.'.create') }}" class="btn btn-success">
            <i class="voyager-plus"></i> إضافة جديد
        </a>
        @endcan
        @can('reports')
            <a href="students/reports" class="btn btn-success">
                <i class="voyager-book-download"></i> التقارير
            </a>
        @endcan
    </h1>
@stop

@section('page_header_actions')

@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                            <tr>
                                <?php error_log('browse: '.$dataType->browseRows);?>
                                @foreach($dataType->browseRows as $rows)
                                    <th>{{ $rows->display_name }}</th>
                                @endforeach
                                <th class="actions">الاجراءات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dataTypeContent as $data)
                                <tr>
                                    @foreach($dataType->browseRows as $row)
                                        <td>
                                            @if($row->type == 'image')
                                                <img src="@if( strpos($data->{$row->field}, 'http://') === false && strpos($data->{$row->field}, 'https://') === false){{ Voyager::image( $data->{$row->field} ) }}@else{{ $data->{$row->field} }}@endif"
                                                     style="width:100px">
                                            @elseif($row->type == 'select_dropdown')
                                                {{ getNameById($row->field, $data->{$row->field}) }}
                                            @else
                                                @if($row->field == 'sn')
                                                    {{date_parse($data->{'c_at'})['year'].'-'.$data->{$row->field} }}
                                                @else
                                                    {{ $data->{$row->field} }}
                                                @endif
                                            @endif
                                        </td>
                                    @endforeach
                                    <td class="no-sort no-click">
                                        @can('view', $data)
                                        <a href="{{ route($dataType->slug.'.show', $data->id) }}"
                                           class="btn-sm btn-warning pull-right">
                                            <i class="voyager-eye"></i> عرض
                                        </a>
                                        @endcan
                                        @can('update', $data)
                                        <a href="{{ route($dataType->slug.'.edit', $data->id) }}"
                                           class="btn-sm btn-primary pull-right edit">
                                            <i class="voyager-edit"></i> تعديل
                                        </a>
                                        @endcan
                                        @can('delete', $data)
                                        <div onclick="deleteRow(this)" class="btn-sm btn-danger pull-right delete" data-id="{{ $data->id }}"
                                             id="delete-{{ $data->id }}">
                                            <i class="voyager-trash"></i> حذف
                                        </div>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> Are you sure you want to delete
                        this {{ $dataType->display_name_singular }}?</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route($dataType->slug.'.index') }}" id="delete_form" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="Yes, Delete This {{ $dataType->display_name_singular }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @stop

    @section('javascript')
            <!-- DataTables -->
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });

        function deleteRow(div) {
            var form = $('#delete_form')[0];

            form.action = parseActionUrl(form.action, $(div).data('id'));

            $('#delete_modal').modal('show');
        }

        function parseActionUrl(action, id) {
            return action.match(/\/[0-9]+$/)
                    ? action.replace(/([0-9]+$)/, id)
                    : action + '/' + id;
        }
    </script>
@stop
