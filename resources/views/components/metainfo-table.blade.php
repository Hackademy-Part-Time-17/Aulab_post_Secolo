<div>
   <table class="table table-striped table-hover border">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Numero di articoli collegati</th>
                <th scope="col">Aggiorna</th>
                <th scope="col">Cancella</th>
            </tr>
        </thead>
        <tbody>
            @foreach($metaInfos as $metaInfo)
            <tr>
                <td scope="row">{{$metaInfo->id}}</td>
                <td scope="row">{{$metaInfo->name}}</td>
                <td scope="row">{{count($metaInfo->articles)}}</td>
                @if($metaType=="tags")
                <td>
                    <form action="{{route('admin.editTag',['tag'=>$metaInfo])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" name="name" placeholder="Nuovo nome tag" class="form-control w-50 d-inline">
                        <button type="submit" class="btn btn-info text-white">Aggiorna</button>
                    </form>
                </td>
                <td>
                    <form action="{{route('admin.deleteTag',['tag'=>$metaInfo])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger text-white">Cancella</button>
                    </form>
                </td>
                @else
                <td>
                    <form action="{{route('admin.editCategory',['category'=>$metaInfo])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" name="name" placeholder="Nuovo nome tag" class="form-control w-50 d-inline">
                        <button type="submit" class="btn btn-info text-white">Aggiorna</button>
                    </form>
                </td>
                <td>
                    <form action="{{route('admin.deleteCategory',['category'=>$metaInfo])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger text-white">Cancella</button>
                    </form>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
   </table>
</div>