<table class="table table-striped table-hover border">
    <thead class="table-dark container">
        <tr class="col row-align-center">
            <th scope="col">#</th>
            <th scope="col" class="text-center">Titolo</th>
            <th scope="col" class="text-center">Sottotitolo</th>
            <th scope="col" class="text-center">Categoria</th>
            <th scope="col" class="text-center">Tag</th>
            <th scope="col" class="text-center">Creato il</th>
            <th scope="col" class="text-center">Azioni</th>
        </tr>
    </thead>
    <tbody>
        @foreach($articles as $article)
        <tr>
            <th scope="row">{{$article->id}}</th>
            <td>{{$article->title}}</td>
            <td>{{$article->subtitle}}</td>
            <td>{{$article->category->name ?? 'Non categorizzato'}}</td>
            <td>
                @foreach($article->tags as $tag)
                    {{$tag->name}}
                @endforeach
            </td>
            <td>{{$article->created_at->format('d/m/Y')}}</td>
            <td>
                <a href="{{route('article.show',compact('article'))}}" class="btn btn-info text-white margin:6px">Leggi l'articolo</a>
                <a href="{{route('article.edit',compact('article'))}}" class="btn btn-warning text-white">Modifica l'articolo</a>
                <form action="{{route('article.destroy',compact('article'))}}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Elimina l'articolo</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
