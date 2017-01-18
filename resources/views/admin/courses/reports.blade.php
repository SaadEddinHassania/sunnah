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
                    <h4>تقارير الدورات</h4>
                </div>
            </div>
        </div>

        <div class="row" style="margin-right: 10px; margin-top: 20px;">
            <div class="col-sm-2 text-center" style="margin-bottom: 0px !important;">تصدير</div>
            <div class="col-sm-2 text-center" style="margin-bottom: 0px !important;">الفترة الزمنية</div>
            <div class="col-sm-2 text-center" style="margin-bottom: 0px !important;">نوع الدورة</div>
            <div class="col-sm-2 text-center" style="margin-bottom: 0px !important;">عدد الساعات</div>
            <div class="col-sm-2 text-center" style="margin-bottom: 0px !important;">المنطقة</div>
            <div class="col-sm-2 text-center" style="margin-bottom: 0px !important;">الدورة</div>
        </div>

        <div class="row" style="margin-right: 10px;">
            <form role="form"
                  action="{{ route('admin.courses.reports') }}"
                  method="POST" enctype="multipart/form-data">

                <div class="col-sm-2 text-center">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-primary">تصدير</button>
                </div>
                <div class="col-sm-2">
                    <input type="date" class='form-control' placeholder="من" name="from">
                    <input type="date" class='form-control' placeholder="الى" name="to">
                </div>
                <div class="col-sm-2">
                    <select name="col[field_id]" class='form-control'>
                        @foreach($course_types as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-2">
                    <input type="number" class='form-control' placeholder="عدد الساعات" name="col[hours]">
                </div>
                <div class="col-sm-2">
                    <select name="col[region_id]" class='form-control'>
                        @foreach($regions as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-2">
                    <select name="col[id]" class='form-control'>
                        @foreach($courses as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>

            </form>
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
                    id: "",
                    text: "Select an option",
                    selected: 'selected'
                },
                allowClear: true,
                data: [
                    {
                        id: '',
                        text: '',
                        selected: 'selected',
                        search: '',
                        hidden: true
                    }]
            });
        });
    </script>
@stop