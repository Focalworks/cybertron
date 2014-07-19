@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Permission table</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        {{GlobalHelper::dsm($groups)}}
        {{GlobalHelper::dsm($permissions)}}
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
            <tr>
                <td>Checki</td>
                <td>Yes</td>
            </tr>
            </tbody>
        </table>
        @foreach($permissions as $perm)

        @endforeach
    </div>
</div>
@stop