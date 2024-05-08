<x-layout>
<div class="container-fluid p-5 bg-info text-center text-white">
        <div class="row justify-content-center">
            <h1 class="display-1">
                Tutti gli articoli per:{{$query}}
            </h1>
        </div>
    </div>

    <div class="container my-5">
        <div class="row justify-content-around ">
        @foreach($articles as $article)
            <div class="col-12 col-md-3 my-2">
                <div class="card">
                    <img src= "{{ Storage::url($article->image) }}"  alt="..." class="card-img-top" width="300" height="320"> 
                    <div class="card-body">                    
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ $article->subtitle }}</p>
                        @if
                            <a href="{{route('article.byCategory',['category'=>$article->category->id])}}" class="small text-muted fst-italic text-capitalize">{{$article->category->name}}</a>
                        @else    
                            <p class="small text-muted fst-italic text-capitalize">Non categorizzato</p>
                        @endif    
                        <div class="text-muted small fst-italic">Tempo di lettura:{{$article->readDuration()}} min</div>
                            <hr>
                            <p class="small fst-italic text-capitalize">
                                @foreach($article->tags as $tag)
                                #{{$tag->name}}
                                @endforeach
                            </p>
                    </div>        
                    <div class="card-footer text-muted d-flex justify-content-between align-items-center">
                        <p>Redatto il {{ $article->created_at->format('d/m/y') }} da 
                        <a href="{{route('article.byWriter',['user'=>$article->user->id])}}" class="small text-muted fst-italic text-capitalize">{{ $article->user->name }}</a>.</p>
                        <a href="{{route('article.show',compact('article'))}}" class="btn btn-info text-white">Leggi</a>
                    </div>
                </div>                    
            </div>
        @endforeach
        </div>
    </div>

</x-layout>
