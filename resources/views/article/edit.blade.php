<x-layout>
<div class="container-fluid p-5 bg-info text-center text-white">
        <div class="row justify-content-center ">
            <h1 class="display-1">
                Modifica un articolo
            </h1>
        </div>
    </div>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 ">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="card p-5 shadow " action="{{route('article.update',compact('article'))}}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    @method('PUT')
                    <div class="mt-2"><div class="mb-3">
                        <label for="title" class="form-label">Titolo:</label>
                        <input name="title" type="text" class="form-control" id="title" value="{{$article->title}}">
                    </div>

                    <div class="mb-3">
                        <label for="subtitle" class="form-label">Sottotitolo:</label>
                        <input name="subtitle" type="text" class="form-control" id="subtitle" value="{{$article->subtitle}}">
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Immagine:</label>
                        <input name="image" type="file" id="image" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Categoria:</label>
                        <select name="category" id="category" class="form-control text-capitalize">
                            @foreach($categories as $category)
                            <option value="{{$category->id}}" @if($article->category && $category->id===$article->category->id) selected @endif>{{$category->name}}</option>
                            @endforeach
                            <!--nel caso ci fosse una categoria collegata all’articolo,verrà scelta automaticamente tra quelle disponibili-->
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tags" class="form-label">Tags:</label>
                        <input name="tags" type="text" id="tags" class="form-control" value="{{$article->tags->implode('name',', ')}}">
                        <span class="span fst-italic">Dividi ogni tag con la virgola</span>
                    </div>

                    <div class="mb-3">
                        <label for="body" class="form-label">Corpo del testo:</label>
                        <textarea name="body" id="body" cols="30" rows="7" class="form-control">{{$article->body}}</textarea>
                    </div>
                    
                        <button class="btn btn-info text-white">Inserisci un articolo</button>
                        <a class="btn btn-outline-info" href="{{route('homepage')}}">Torna alla home</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
    
</x-layout>