<x-layout>
    <div class="container-fluid p-5 bg-info text-center text-white">
        <div class="row justify-content-center">
            <h1 class="display-1">
                Lavora con noi
            </h1>
        </div>
    </div>
    <div class="container my-5">
        <div class="row justify-content-center align-items-center border rounded p-2 shadow ">
            <div class="col-12 col-md-6">
                <h2>Lavora come amministratore</h2>
                <p><b style="color:darkblue;">Cosa farai:</b><br>Gestirai le richieste di utenti che vogliono collaborare per la piattaforma o licenziarli.<br>
                Dovrai moderare la creazione di tag da parte dei redattori, aggiungere o modificare delle categorie per una maggiore pertinenza sui contenuti degli articoli.</p>
                <h2>Lavora come revisore</h2>
                <p><b style="color:darkblue;">Cosa farai:</b><br>Visionerai ogni articolo pronto per essere pubblicato</p>
                <h2>Lavora come redattore</h2>
                <p><b style="color:darkblue;">Cosa farai:</b><br>Creerai e gestirai i tuoi articoli e i tag di riferimento.</p>
            </div>
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

                    <form action="{{route('careers.submit')}}" method="POST" class="p-5 ">
                        @csrf
                        <div class="mb-3">
                            <label for="role" class="form-label ">Per quale ruolo ti stai candidando?</label>
                            <select name="role" id="role" class="form-control">
                                <option value="">Scegli qui</option>
                                <option value="admin">Amministratore</option>
                                <option value="revisor">Revisore</option>
                                <option value="writer">Redattore</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{old('email') ?? Auth::user()->email}}">
                            <label for="message" class="form-label">Parlaci di te</label>
                            <textarea name="message" id="message" cols="30" rows="7" class="form-control" value="{{old('message')}}"></textarea>
                        </div>
                        <div class="mt-2">
                            <button class="btn btn-info text-white">Invia la tua candidatura</button>
                        </div>
                    </form>

            </div>
        </div>
    </div>

</x-layout>
