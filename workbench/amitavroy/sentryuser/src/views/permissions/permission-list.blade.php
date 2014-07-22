@section('content')
<div class="row">
    <div class="col-md-12">
        <!--<h1>Permission table</h1>-->
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <!--{{GlobalHelper::dsm($groups)}}-->
        {{ Form::open(array('url' => 'user/permission/save', 'role' => 'form')) }}
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Permission name</th>
                @foreach ($groups as $group)
                <th>{{$group->name}}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            <!--{{GlobalHelper::dsm($permissions)}}-->
            @foreach ($permissions as $key => $permission)
            <tr>
                <td>{{ ucwords($key) }}</td>
                @foreach ($permission as $p)
                    @if ($p->allow == 1)
                    <td><input type="checkbox" checked name="{{$p->permission_name}}|{{$p->name}}" value="{{$p->permission_id}}|{{$p->group_id}}|{{$p->allow}}">
                        <input type="hidden" name="{{$p->permission_name}}|{{$p->name}}|hidden" value="{{$p->permission_id}}|{{$p->group_id}}|{{$p->allow}}"></td>
                    @else
                    <td><input type="checkbox" name="{{$p->permission_name}}|{{$p->name}}" value="{{$p->permission_id}}|{{$p->group_id}}|{{$p->allow}}">
                        <input type="hidden" name="{{$p->permission_name}}|{{$p->name}}|hidden" value="{{$p->permission_id}}|{{$p->group_id}}|{{$p->allow}}"></td>
                    @endif
                @endforeach
            </tr>
            @endforeach
            </tbody>
        </table>
        <input type="submit" class="btn btn-success" name="save" value="Save"/>
        {{ Form::close() }}
    </div>
</div>
@stop