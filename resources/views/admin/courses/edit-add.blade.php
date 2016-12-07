@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/css/select2.css" rel="stylesheet">
    <link href="/css/select2-bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="/js/select2.js"></script>
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> @if(isset($dataTypeContent->id)){{ 'Edit' }}@else{{ 'New' }}@endif {{ $dataType->display_name_singular }}
    </h1>
@stop
<?php $region_id = 0;?>
@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <!-- /.box-header -->
                <!-- form start -->
                <form role="form"
                      action="@if(isset($dataTypeContent->id)){{ route($dataType->slug.'.update', $dataTypeContent->id) }}@else{{ route($dataType->slug.'.store') }}@endif"
                      method="POST" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-md-7">
                            <div class="panel panel-body panel-bordered">

                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @foreach($dataType->addRows as $row)
                                    <div class="form-group">
                                        @if($row->type == "hidden" && !isset($dataTypeContent->id))
                                            <input type="hidden" class="form-control" id="{{ $row->field }}"
                                                   name="{{ $row->field }}"
                                                   value="@if($row->field == 'sn'){{'1'}}@else{{date("Y")}}@endif">
                                        @elseif($row->field == 'year')

                                        @else
                                            <label for="name">{{ $row->display_name }}</label>
                                        @endif
                                        @if($row->type == "text")
                                            <input type="text" class="form-control" name="{{ $row->field }}"
                                                   placeholder="{{ $row->display_name }}"
                                                   value="@if(isset($dataTypeContent->{$row->field})){{ old($row->field, $dataTypeContent->{$row->field}) }}@else{{old($row->field)}}@endif">

                                        @elseif($row->type == "date")
                                            <input type="date" class="form-control" name="{{ $row->field }}"
                                                   placeholder="{{ $row->display_name }}"
                                                   value="@if(isset($dataTypeContent->{$row->field})){{ old($row->field, $dataTypeContent->{$row->field}) }}@else{{old($row->field)}}@endif">

                                        @elseif($row->type == "hidden" && isset($dataTypeContent->id))
                                            @if($row->field == 'sn')
                                                <input type="text" class="form-control"
                                                       value="@if(isset($dataTypeContent->{$row->field})){{ old($row->field, $dataTypeContent->{'year'}.'-'.$dataTypeContent->{$row->field}) }}@else{{old($row->field)}}@endif"
                                                       readonly>
                                            @endif
                                        @elseif($row->type == "password")
                                            @if(isset($dataTypeContent->{$row->field}))
                                                <br>
                                                <small>Leave empty to keep the same</small>
                                            @endif
                                            <input type="password" class="form-control" name="{{ $row->field }}"
                                                   value="">
                                        @elseif($row->type == "text_area")
                                            <textarea class="form-control"
                                                      name="{{ $row->field }}">@if(isset($dataTypeContent->{$row->field})){{ old($row->field, $dataTypeContent->{$row->field}) }}@else{{old($row->field)}}@endif</textarea>
                                        @elseif($row->type == "rich_text_box")
                                            <textarea class="form-control richTextBox"
                                                      name="{{ $row->field }}">@if(isset($dataTypeContent->{$row->field})){{ old($row->field, $dataTypeContent->{$row->field}) }}@else{{old($row->field)}}@endif</textarea>
                                        @elseif($row->type == "image" || $row->type == "file")
                                            @if($row->type == "image" && isset($dataTypeContent->{$row->field}))
                                                <img src="{{ Voyager::image( $dataTypeContent->{$row->field} ) }}"
                                                     style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                            @elseif($row->type == "file" && isset($dataTypeContent->{$row->field}))
                                                <div class="fileType">{{ $dataTypeContent->{$row->field} }} }}</div>
                                            @endif
                                            <input type="file" name="{{ $row->field }}">
                                        @elseif($row->type == "select_dropdown")
                                            <?php
                                            if ($row->field == 'region_id' && isset($dataTypeContent->id)) {
                                                $region_id = $dataTypeContent->{$row->field};
                                            }
                                            ?>
                                            <?php $options = json_decode($options_);?>
                                            <?php $field_name = explode('_', $row->field)[0];?>
                                            <?php $selected_value = (isset($dataTypeContent->{$row->field}) && !empty(old($row->field,
                                                            $dataTypeContent->{$row->field}))) ? old($row->field,
                                                    $dataTypeContent->{$row->field}) : old($row->field); ?>
                                            <select class="form-control"
                                                    name="{{ $row->field }}"
                                                    onchange="onChangeDropDownn(this)"
                                                    @if(isset($dataTypeContent->id) && !$row->edit) disabled @endif>
                                                <?php $default = (isset($options->default) && !isset($dataTypeContent->{$row->field})) ? $options->default : NULL; ?>
                                                @if(isset($options->$field_name))
                                                    @foreach($options->$field_name as $key => $option)
                                                        <option value="{{ $key }}" @if($default == $key && $selected_value === NULL){{ 'selected="selected"' }}@endif @if($selected_value == $key){{ 'selected="selected"' }}@endif>{{ $option }}</option>
                                                    @endforeach
                                                @endif
                                            </select>

                                        @elseif($row->type == "radio_btn")
                                            <?php $options = json_decode($row->details); ?>
                                            <?php $selected_value = (isset($dataTypeContent->{$row->field}) && !empty(old($row->field,
                                                            $dataTypeContent->{$row->field}))) ? old($row->field,
                                                    $dataTypeContent->{$row->field}) : old($row->field); ?>
                                            <?php $default = (isset($options->default) && !isset($dataTypeContent->{$row->field})) ? $options->default : NULL; ?>
                                            <ul class="radio">
                                                @if(isset($options->options))
                                                    @foreach($options->options as $key => $option)
                                                        <li>
                                                            <input type="radio" id="option-{{ $key }}"
                                                                   name="{{ $row->field }}"
                                                                   value="{{ $key }}" @if($default == $key && $selected_value === NULL){{ 'checked' }}@endif @if($selected_value == $key){{ 'checked' }}@endif>
                                                            <label for="option-{{ $key }}">{{ $option }}</label>
                                                            <div class="check"></div>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>

                                        @elseif($row->type == "checkbox")

                                            <br>
                                            <?php $options = json_decode($row->details); ?>
                                            <?php $checked = (isset($dataTypeContent->{$row->field}) && old($row->field,
                                                            $dataTypeContent->{$row->field}) == 1) ? true : old($row->field); ?>
                                            @if(isset($options->on) && isset($options->off))
                                                <input type="checkbox" name="{{ $row->field }}" class="toggleswitch"
                                                       data-on="{{ $options->on }}" @if($checked) checked
                                                       @endif data-off="{{ $options->off }}">
                                            @else
                                                <input type="checkbox" name="{{ $row->field }}" class="toggleswitch"
                                                       @if($checked) checked @endif>
                                            @endif

                                        @endif

                                    </div>
                                @endforeach

                                <div class="panel-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>


                            </div><!-- panel-body -->
                        </div>
                        <div class="col-md-5">
                            <div class="panel panel panel-bordered panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="icon wb-clipboard"></i> Add Students</h3>
                                    <div class="panel-actions">
                                        <a class="panel-action icon wb-minus" data-toggle="panel-collapse"
                                           aria-hidden="true"></a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <select name="add_student" id="add_student" class="form-control">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Grade</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="form-group">
                                        <ul name='students' id="students" class="from-control list-group">
                                            @if(isset($dataTypeContent->id))
                                                <?php $students = json_decode($options_)->students;?>
                                                @foreach($students as $s)
                                                    <?php error_log($s->name);?>
                                                    <li class='list-group-item'>
                                                        <input type='hidden' name='students_ids[]'
                                                               value='{{$s->user_id}}'/>
                                                        <div class='row'>
                                                            <div class='col-xs-4 group-student'>
                                                                <label class='form-control'>{{$s->name}}</label>
                                                            </div>
                                                            <div class='col-xs-4 group-student'>
                                                                <select class='form-control'
                                                                        name='students_grade[{{$s->user_id}}][]'>
                                                                    <option value='1' @if($s->status == 1)selected="selected"@endif>aaa</option>
                                                                    <option value='2' @if($s->status == 2)selected="selected"@endif>bbb</option>
                                                                    <option value='3' @if($s->status == 3)selected="selected"@endif>ccc</option>
                                                                </select>
                                                            </div>
                                                            <div class='col-xs-4 group-student'>
                                                                <input class='form-control' type='number'
                                                                       name='students_grade[{{$s->user_id}}][]'
                                                                       value="{{$s->grade}}"
                                                                       placeholder='grade'/>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    {{--<li class='list-group-item'>--}}
                                                    {{--<input type='hidden' name='students_ids[]' value='{{$key}}'/>--}}
                                                    {{--{{$value}}--}}
                                                    {{--</li>--}}
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- PUT Method if we are editing -->
                    @if(isset($dataTypeContent->id))
                        <input type="hidden" name="_method" value="PUT">
                        @endif

                                <!-- CSRF TOKEN -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                </form>

                <iframe id="form_target" name="form_target" style="display:none"></iframe>
                <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                      enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                    <input name="image" id="upload_file" type="file"
                           onchange="$('#my_form').submit();this.value='';">
                    <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        var add_student = $('#add_student');

        $('document').ready(function () {

            @if(isset($dataTypeContent->id))
                $('select').select2({
                theme: "bootstrap",
                placeholder: {
                    id: "-1",
                    text: "Select an option"
                },
                allowClear: true,
                data: [
                    {
                        id: -1,
                        text: '',
                        search: '',
                        hidden: true
                    }]
            });
            getStudentByRegion({{$region_id}});
            @else
                $('select').select2({
                theme: "bootstrap",
                placeholder: {
                    id: "-1",
                    text: "Select an option",
                    selected: 'selected'
                },
                allowClear: true,
                data: [
                    {
                        id: -1,
                        text: '',
                        selected: 'selected',
                        search: '',
                        hidden: true
                    }]
            });
            @endif
            $('.toggleswitch').bootstrapToggle();
        });

        add_student.on("change", function (e) {
            $('#students').append(
                    "<li class='list-group-item'> " +
                    "<input type='hidden' name='students_ids[]' value='" + add_student.val() + "'/>" +
                    "<div class='row'>" +
                    "<div class='col-xs-4 group-student'>" +
                    "<label class='form-control'>" + add_student.text() + "</label></div>" +
                    "<div class='col-xs-4 group-student'>" +
                    "<select class='form-control' name='students_grade[" + add_student.val() + "][]'>" +
                    "<option value='1'>asd</option>" +
                    "</select></div>" +
                    "<div class='col-xs-4 group-student'>" +
                    "<input class='form-control' type='number' name='students_grade[" + add_student.val() + "][]' placeholder='grade'/>" +
                    "</div></div></li>");
            add_student.val(-1);
        });

        function setDropDown() {
            add_student.select2({
                theme: "bootstrap",
                placeholder: {
                    id: "-1",
                    text: "Select an option",
                    selected: 'selected'
                },
                allowClear: true,
                data: [
                    {
                        id: -1,
                        text: '',
                        selected: 'selected',
                        search: '',
                        hidden: true
                    }]
            });
        }

        function onChangeDropDownn(val) {
            var select = $(val);
            var field = select.attr('name');
            if (field == 'region_id') {
                $.get("/admin/studentsR/" + select.val(), function (data) {
//                    alert(JSON.stringify(data));
                    add_student.select2('destroy');
                    add_student.empty();
                    jQuery.each(data, function (key, val) {
                        add_student.append($('<option>', {
                            value: val,
                            text: key
                        }));
                    });
                    setDropDown();
                });

                $.get("/admin/coursesRY/" + select.val(), function (data) {
                    $('#sn').val(parseInt(data));
                });

            }
        }

        function getStudentByRegion(reg_id) {
            $.get("/admin/studentsR/" + reg_id, function (data) {
                add_student.select2('destroy');
                add_student.empty();
                jQuery.each(data, function (key, val) {
                    add_student.append($('<option>', {
                        value: val,
                        text: key
                    }));
                });
                setDropDown();
            });
        }
    </script>
    <script src="{{ config('voyager.assets_path') }}/lib/js/tinymce/tinymce.min.js"></script>
    <script src="{{ config('voyager.assets_path') }}/js/voyager_tinymce.js"></script>
@stop
