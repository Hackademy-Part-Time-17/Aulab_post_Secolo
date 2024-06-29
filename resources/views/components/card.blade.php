<div class="col-12 col-md-3 my-2">
    <div class="card m-info">
        <img src="{{ Storage::url($article->image) }}"  alt="..." class="card-img-top "   width="300" height="300">
        <div class="card-body ">
            <h5 class="card-title" >{{$article->title}}</h5>
            <p class="card-text" >{{$article->subtitle}} </p>
            @if(!request()->routeIs('article.byCategory'))
                @if($article->category)
                    <a href="{{route('article.byCategory',['category'=>$article->category->id])}}" class="small text-muted fst-italic text-capitalize" >{{$article->category->name}}</a>
                @else    
                    <p class="small text-muted fst-italic text-capitalize" >Non categorizzato</p>
                @endif
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
            @if(!request()->routeIs('article.byWriter'))    
                <p>Redatto il {{$article->created_at->format('d/m/y')}} da 
                <a href="{{route('article.byWriter',['user'=>$article->user->id])}}" class="small text-muted fst-italic text-capitalize"> {{$article->user->name}} </a>.</p>
            @endif
            <a href="{{route('article.show',compact('article'))}}" class="btn btn-info text-white">Leggi</a>
        </div>
    </div>
</div>     