<table class="table table-striped table-hover border ">
    <thead class="container table-dark">
        <tr>
            <th scope="col" class="">#</th>
            <th scope="col" class=>Nome</th>
            <th scope="col" class=>Email</th>
            <th scope="col" class=>Azioni</th>
        </tr>
    </thead>
    <tbody>
        @foreach($roleRequest as $user)
        <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>
                @switch($role)
                    @case('amministratore')
                        <a href="{{route('admin.setAdmin',compact('user'))}}" class=" btn btn-info text-white ">Attiva {{$role}}</a>
                    @break
                    @case('revisore')
                        <a href="{{route('admin.setRevisor',compact('user'))}}" class=" btn btn-info text-white ">Attiva {{$role}}</a>
                    @break
                    @case('redattore')
                        <a href="{{route('admin.setWriter',compact('user'))}}" class=" btn btn-info text-white ">Attiva {{$role}}</a>
                    @break
                @endswitch
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
