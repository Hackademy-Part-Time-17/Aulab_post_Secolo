<x-layout>
    <div class="container-fluid p-5 bg-info text-center text-white" >
        <div class="row justify-content-center ">
            <h1 class="display-1">Tutti gli articoli</h1>
        </div>
    </div>

    <div class="container my-5">
        <div class="row justify-content-around ">
            @foreach($articles as $article)
                <x-card :article="$article"/>
            @endforeach
        </div>
    </div>
    
</x-layout>
