<table class="table table-striped table-hover border">
    <thead class="table-dark container">
        <tr class="col row-align-center">
            <th scope="col">#</th>
            <th scope="col" class="text-center">Titolo</th>
            <th scope="col" class="text-center">Sottotitolo</th>
            <th scope="col" class="text-center">Categoria</th>
            <th scope="col" class="text-center">Tags</th>
            <th scope="col" class="text-center">Creato il</th>
            <th scope="col" class="text-center">Azioni</th>
        </tr>
    </thead>
    <tbody>
        @foreach($articles as $article)
        <tr>
            <th scope="row" class="col-1">{{$article->id}}</th>
            <td class="col-2 text-center">{{$article->title}}</td>
            <td class="col-2 text-center">{{$article->subtitle}}</td>
            <td class="col-1 text-center">{{$article->category->name ?? 'Non categorizzato'}}</td>
            <td class="col-1">
                @foreach($article->tags as $tag)
                    #{{$tag->name}}
                @endforeach
            </td>
            <td class="col-1 text-center">{{$article->created_at->format('d/m/Y')}}</td>
            <td class="col-4">
                <a href="{{route('article.show',compact('article'))}}" class="btn btn-info text-white m-2">Leggi</a>
                <a href="{{route('article.edit',compact('article'))}}" class="btn btn-warning text-white m-2">Modifica</a>
                <form action="{{route('article.destroy',compact('article'))}}" method="POST" class="d-inline ">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger text-white m-2">Elimina</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
