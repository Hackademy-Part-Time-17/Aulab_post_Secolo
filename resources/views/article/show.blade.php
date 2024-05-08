<x-layout>
<div class="container-fluid p-5 bg-info text-center text-white">
        <div class="row justify-content-center">
            <h1 class="display-1">
                {{$article->title}}
            </h1>
        </div>
    </div>

    <div class="container my-5">
        <div class="row justify-content-around ">
            <div class="col-12 col-md-8">
                <img src= "{{ Storage::url($article->image) }}"  alt="..." class="card-img-top" width="600" height="640"> 
                <div class="text-center">
                    <h2>{{ $article->subtitle }}</h2>
                    <div class="my-3 text-muted fst-italic "> 
                    <p >Redatto da {{ $article->user->name }} il {{ $article->created_at->format('d/m/y') }}.</p>
                    </div>
                </div>
                <hr>
                <p>{{$article->body}}</p>
                <div class="text-center">
                    <a href="{{route('article.index')}}" class="btn btn-info text-white my-5">Torna indietro</a>                
                    @if(Auth::user() && Auth::user()->is_revisor)
                    <div class="d-flex justify-content-between">
                        <a href="{{route('revisor.acceptArticle',compact('article'))}}" class="btn btn-info text-white">Accetta l'articolo</a>
                        <a href="{{route('revisor.rejectArticle',compact('article'))}}" class="btn btn-info text-white">Rifiuta l'articolo</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>
