@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/css/select2-bootstrap.css" rel="stylesheet">
@stop

@section('page_header')
    {{--<h1 class="page-title">--}}
    {{--<i class="voyager-receipt"></i> Course Reports--}}
    {{--</h1>--}}
@stop

@section('page_header_actions')

@stop

@section('content')
    <div class="page-content">
        <div class="widgets">

            <div class="panel widget center bgimage"
                 style="background-image:url({{ config('voyager.assets_path') }}/images/widget-backgrounds/04.png);">
                <div class="dimmer"></div>
                <div class="panel-content">
                    <i class="voyager-receipt"></i>
                    <h4>كافة الدورات</h4>
                    <form role="form"
                          action="{{ route('admin.courses.all_report') }}"
                          method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary">تصدير</button>
                    </form>
                </div>
            </div>

            <div class="panel widget center bgimage"
                 style="background-image:url({{ config('voyager.assets_path') }}/images/widget-backgrounds/04.png);">
                <div class="dimmer"></div>
                <div class="panel-content">
                    <i class="voyager-news"></i>
                    <h4>دورة</h4>
                    <form role="form"
                          action="{{ route('admin.courses.c_report') }}"
                          method="POST" enctype="multipart/form-data">

                        <div class="col-sm-10 col-centered">
                            <?php $types = \App\Models\Course::toDropDown()?>
                            <select name="id" class='form-control'>
                                @foreach($types as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary">تصدير</button>
                    </form>
                </div>
            </div>

            <div class="panel widget center bgimage"
                 style="background-image:url({{ config('voyager.assets_path') }}/images/widget-backgrounds/04.png);">
                <div class="dimmer"></div>
                <div class="panel-content">
                    <i class="voyager-categories"></i>
                    <h4>الدورات حسب النوع</h4>
                    <form role="form"
                          action="{{ route('admin.courses.reports') }}"
                          method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="col" value="type_id"/>
                        <div class="col-sm-10 col-centered">
                            <?php $types = \App\Models\CourseType::toDropDown()?>
                            <select name="value" class='form-control'>
                                @foreach($types as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary">تصدير</button>
                    </form>
                </div>
            </div>

            <div class="panel widget center bgimage"
                 style="background-image:url({{ config('voyager.assets_path') }}/images/widget-backgrounds/04.png);">
                <div class="dimmer"></div>
                <div class="panel-content">
                    <i class="voyager-milestone"></i>
                    <h4>الدورات حسب المجال</h4>
                    <form role="form"
                          action="{{ route('admin.courses.reports') }}"
                          method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="col" value="field_id"/>
                        <div class="col-sm-10 col-centered">
                            <?php $types = \App\Models\CourseField::toDropDown()?>
                            <select name="value" class='form-control'>
                                @foreach($types as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary">تصدير</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="widgets">

            <div class="panel widget center bgimage"
                 style="background-image:url({{ config('voyager.assets_path') }}/images/widget-backgrounds/04.png);">
                <div class="dimmer"></div>
                <div class="panel-content">
                    <i class="voyager-down-circled"></i>
                    <h4>الدورات حسب المنطقة</h4>
                    <form role="form"
                          action="{{ route('admin.courses.reports') }}"
                          method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="col" value="region_id"/>
                        <div class="col-sm-10 col-centered">
                            <?php $types = \App\Models\Region::toDropDown()?>
                            <select name="value" class='form-control'>
                                @foreach($types as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary">تصدير</button>
                    </form>
                </div>
            </div>

            <div class="panel widget center bgimage"
                 style="background-image:url({{ config('voyager.assets_path') }}/images/widget-backgrounds/04.png);">
                <div class="dimmer"></div>
                <div class="panel-content">
                    <i class="voyager-group"></i>
                    <h4>الدورات حسب المشرف</h4>
                    <form role="form"
                          action="{{ route('admin.courses.reports') }}"
                          method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="col" value="supervisor_id"/>
                        <div class="col-sm-10 col-centered">
                            <?php $types = \App\Models\Supervisor::toDropDown()?>
                            <select name="value" class='form-control'>
                                @foreach($types as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary">تصدير</button>
                    </form>
                </div>
            </div>

            <div class="panel widget center bgimage"
                 style="background-image:url({{ config('voyager.assets_path') }}/images/widget-backgrounds/04.png);">
                <div class="dimmer"></div>
                <div class="panel-content">
                    <i class="voyager-pen"></i>
                    <h4>الدورات حسب المدرس</h4>
                    <form role="form"
                          action="{{ route('admin.courses.reports') }}"
                          method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="col" value="teacher_id"/>
                        <div class="col-sm-10 col-centered">
                            <?php $types = \App\Models\Teacher::toDropDown()?>
                            <select name="value" class='form-control'>
                                @foreach($types as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary">تصدير</button>
                    </form>
                </div>
            </div>

            <div class="panel widget center bgimage"
                 style="background-image:url({{ config('voyager.assets_path') }}/images/widget-backgrounds/04.png);">
                <div class="dimmer"></div>
                <div class="panel-content">
                    <i class="voyager-watch"></i>
                    <h4>الدورات حسب تاريخ البداية</h4>
                    <form role="form"
                          action="{{ route('admin.courses.d_report') }}"
                          method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="col" value="teacher_id"/>
                        <div class="col-sm-10 col-centered">
                            <div class="row">
                            <label style="color: white; padding-left: 5px;">من: </label><input type="date" name="from"/>
                            </div>
                            <div class="row">
                                <label style="color: white; padding-left: 4px;">إلى: </label><input type="date" name="to"/>
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary">تصدير</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@stop

@section('javascript')
    <script>
        $('document').ready(function () {
            if ($('[type="date"]').prop('type') != 'date') {
                $('[type="date"]').datepicker();
            }

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
        });
    </script>
@stop