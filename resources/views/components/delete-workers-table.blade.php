<table class="table table-striped table-hover border ">
    <thead class="table-dark">
    <tr>
            <th scope="col" class="">#</th>
            <th scope="col" class=>Nome</th>
            <th scope="col" class=>Email</th>
            <th scope="col" class=>Azioni</th>
        </tr>
    </thead>
    <tbody>
        @foreach($usersNotAdmin as $user)
        <tr>
            @if(($user->is_revisor && $user->is_writer)||($user->is_revisor || $user->is_writer))
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td> 
                @if($user->is_revisor)  
                <a href="{{route('admin.leftRevisor',compact('user'))}}" class="btn btn-danger text-white ">Rimuovi revisore</a>
                @endif
                @if($user->is_writer)
                <a href="{{route('admin.leftWriter',compact('user'))}}" class="btn btn-danger text-white ">Rimuovi redattore</a>
                @endif
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>