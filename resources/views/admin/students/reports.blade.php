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
                 style="background-image:url({{ config('voyager.assets_path') }}/images/widget-backgrounds/03.png);">
                <div class="dimmer"></div>
                <div class="panel-content">
                    <i class="voyager-study"></i>
                    <h4>كافة الطلاب</h4>
                    <form role="form"
                          action="{{ route('admin.students.reports') }}"
                          method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary">تصدير</button>
                    </form>
                </div>
            </div>

            <div class="panel widget center bgimage"
                 style="background-image:url({{ config('voyager.assets_path') }}/images/widget-backgrounds/03.png);">
                <div class="dimmer"></div>
                <div class="panel-content">
                    <i class="voyager-certificate"></i>
                    <h4>طلاب حسب المؤهل العلمي</h4>
                    <form role="form"
                          action="{{ route('admin.students.reports') }}"
                          method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="col" value="qualification_id"/>
                        <div class="col-sm-10 col-centered">
                            <?php $types = \App\Models\Qualification::toDropDown()?>
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
                 style="background-image:url({{ config('voyager.assets_path') }}/images/widget-backgrounds/03.png);">
                <div class="dimmer"></div>
                <div class="panel-content">
                    <i class="voyager-bolt"></i>
                    <h4>طلاب حسب التخصص</h4>
                    <form role="form"
                          action="{{ route('admin.students.reports') }}"
                          method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="col" value="specialization_id"/>
                        <div class="col-sm-10 col-centered">
                            <?php $types = \App\Models\Specialization::toDropDown()?>
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
                 style="background-image:url({{ config('voyager.assets_path') }}/images/widget-backgrounds/03.png);">
                <div class="dimmer"></div>
                <div class="panel-content">
                    <i class="voyager-down-circled"></i>
                    <h4>طلاب حسب المنطقة</h4>
                    <form role="form"
                          action="{{ route('admin.students.reports') }}"
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