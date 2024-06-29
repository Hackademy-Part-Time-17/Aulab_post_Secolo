<x-layout>

    <div class="container-fluid p-5 bg-info text-center text-white">
        <div class="row justify-content-center ">
            <h1 class="display-1">
                Bentornato Amministratore!
            </h1>
        </div>
    </div>

    @if(session('message'))
        <div class="alert alert-success text-center">
            {{session('message')}}
        </div>
    @endif

    <div class="container my-5">
        <div class="row justify-content-center ">
            <div class="col-12">
                <h2>Richieste per ruolo di amministratore</h2>
                <x-request-table :roleRequest="$adminRequest" role='amministratore'/>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row justify-content-center ">
            <div class="col-12">
                <h2>Richieste per ruolo di revisore</h2>
                <x-request-table :roleRequest="$revisorRequest" role='revisore'/>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row justify-content-center ">
            <div class="col-12">
                <h2>Richieste per ruolo di redattore</h2>
                <x-request-table :roleRequest="$writerRequest" role='redattore'/>
            </div>
        </div>
    </div>
    
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12">
            <h2>Ritiro di ruoli</h2>
                <x-delete-workers-table :usersNotAdmin="$usersNotAdmin"/>
            </div>
        </div>
    </div>
</x-layout>
