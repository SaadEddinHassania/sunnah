@extends('voyager::master')

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> Viewing {{ ucfirst($dataType->display_name_singular) }}
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-6">

                <div class="panel panel-bordered" style="padding-bottom:5px;">


                    <!-- /.box-header -->
                    <!-- form start -->


                    @foreach($dataType->readRows as $row)

                        <div class="panel-heading" style="border-bottom:0;">
                            <h3 class="panel-title">{{ $row->display_name }}</h3>
                        </div>

                        <div class="panel-body" style="padding-top:0;">
                            @if($row->field == 'sn')
                                <p><?= $dataTypeContent->year . '-' . $dataTypeContent->{$row->field} ?></p>
                            @elseif($row->type == "image")
                                <img style="max-width:640px"
                                     src="<?= Voyager::image($dataTypeContent->{$row->field}) ?>">
                            @elseif($row->type == 'select_dropdown')
                                {{ getNameById($row->field, $dataTypeContent->{$row->field}) }}
                            @else
                                <p><?= $dataTypeContent->{$row->field} ?></p>
                            @endif
                        </div><!-- panel-body -->
                        @if(!$loop->last)
                            <hr style="margin:0;">
                        @endif
                    @endforeach


                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel panel-bordered panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="icon wb-clipboard"></i>Students</h3>
                        <div class="panel-actions">
                            <a class="panel-action icon wb-minus" data-toggle="panel-collapse"
                               aria-hidden="true"></a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table id="dataTable" class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Grade</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($students as $index=>$s)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>
                                        {{$s->name}}
                                    </td>
                                    <td>
                                        @if($s->status == 1)
                                            Tested
                                        @elseif($s->status == 2)
                                            attended
                                        @elseif($s->status == 3)
                                            not attended
                                        @endif
                                    </td>
                                    <td>
                                        {{$s->grade}}
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
@stop

@section('javascript')
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable({
                "sDom": '<"top">rt<"bottom"pi><"clear">',
                "pageLength": 20,
                "order": []
            });
        });
    </script>
@stop