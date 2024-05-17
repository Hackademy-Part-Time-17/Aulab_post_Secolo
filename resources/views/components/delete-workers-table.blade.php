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
        @foreach($workers as $worker)
        <tr>
            @if(($worker->is_revisor && $worker->is_writer)||($worker->is_revisor || $worker->is_writer))
            <th scope="row">{{$worker->id}}</th>
            <td>{{$worker->name}}</td>
            <td>{{$worker->email}}</td>
            <td> 
                @if($worker->is_revisor)  
                <a href="{{route('admin.leftRevisor',compact('worker'))}}" class="btn btn-danger text-white ">Rimuovi revisore</a>
                @endif
                @if($worker->is_writer)
                <a href="{{route('admin.leftWriter',compact('worker'))}}" class="btn btn-danger text-white ">Rimuovi redattore</a>
                @endif
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>