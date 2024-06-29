<table class="table table-striped table-hover border ">
    <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col" class="text-center">Titolo</th>
            <th scope="col" class="text-center">Sottotitolo</th>
            <th scope="col" class="text-center">Redattore</th>
            <th scope="col" class="text-center">Azioni</th>
        </tr>
    </thead>
    <tbody>
        @foreach($articles as $article)
        <tr>
            <th scope="row">{{$article->id}}</th>
            <td class="text-center">{{$article->title}}</td>
            <td class="text-center">{{$article->subtitle}}</td>
            <td class="text-center">{{$article->user->name}}</td>
            <td>
                @if(is_null($article->is_accepted))
                <a href="{{route('article.show',compact('article'))}}" class="btn btn-info text-white">Leggi l'articolo</a>
                @else
                <a href="{{route('article.show',compact('article'))}}" class="btn btn-info text-white">Leggi l'articolo</a>
                <a href="{{route('revisor.undoArticle',compact('article'))}}" class="btn btn-warning text-white">Riporta in revisione</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
