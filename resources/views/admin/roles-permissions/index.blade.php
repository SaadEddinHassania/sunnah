@extends('voyager::master')

@section('page_header')

    <h1 class="page-title">
        <i class=""></i> Roles Permissions
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
                        <div class="row">
                            <div class="col-sm-4">
                                <?php $roles = \App\Models\Role::toDropDown();?>
                                <select name="role" class="form-control">
                                    @foreach($roles as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <?php $permissions = \App\Models\Permission::toDropDownDis();?>
                                <select name="permission" class="form-control">
                                    @foreach($permissions as $value)
                                        <option value="{{$value->policy_name}}">{{trim(preg_replace('/(?<!\ )[A-Z]/', ' $0', $value->policy_name))}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <table id="dataTable" class="table table-hover">
                            <thead>
                            <tr>
                                <th>name</th>
                                <th>global</th>
                                <th class="actions">status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="no-sort no-click">
                                    View Course
                                </td>
                                <td class="no-sort no-click">
                                    <input type="checkbox" name="" class="toggleswitch" data-onstyle="success"
                                           data-offstyle="danger">
                                </td>
                                <td class="no-sort no-click">
                                    <input type="checkbox" name="" class="toggleswitch" data-onstyle="success"
                                           data-offstyle="danger">
                                </td>
                            </tr>
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
            $('.toggleswitch').bootstrapToggle();
        });
    </script>
@stop