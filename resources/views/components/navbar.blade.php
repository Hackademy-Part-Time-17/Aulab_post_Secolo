<nav class="navbar navbar-expand-lg navbar-light" style="background-color: yellow;">
  <div class="nav-item col-1 text-info " id="theaulabpost" ><b>TheAulabPost</b></div>
  <div class="collapse navbar-collapse col-8" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 container" >
        @auth
        <li class="nav-item dropdown ">
          <div class="nav-link dropdown-toggle" id="NavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <b>Benvenuto {{Auth::user()->name}}</b>
          </div>

          <ul class="dropdown-menu" aria-Labelledby="NavbarDropdown" >
              <li><a class="dropdown-item"  href="{{route('homepage')}}">Profilo</a></li>
              
              <li><hr class="dropdown-diveder"></li>
              <li><a class="dropdown-item" href="{{route('article.index')}}">Indice</a></li>

              <li><hr class="dropdown-diveder"></li>
              <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); document.querySelector('#form-logout').submit();" id="multiCollapse1">Logout</a></li>

              <form method="POST" action="{{route('logout')}}" id="form-logout" class="d-none">
                @csrf
              </form>
          </ul>
        </li>

        @if(Auth::user()->is_admin)
        <li class="nav-item dropdown ">
          <div class="nav-link dropdown-toggle"  role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dashboard Admin
          </div>

          <ul class="dropdown-menu" aria-Labelledby="NavbarDropdown">
            <li ><a class="dropdown-item" href="{{route('admin.dashboardRoles')}}">Gestione ruoli</a></li>

            <li ><hr class="dropdown-diveder"></li>
            <li ><a class="dropdown-item" href="{{route('admin.dashboardMetainfos')}}">Tag e Categorie</a></li>

          </ul>
        </li>
        @endif

        @if(Auth::user()->is_revisor)
        <li class="nav-item ">
          <a class="nav-link" href="{{route('revisor.dashboard')}}">
            Dashboard Revisore
          </a>
        </li>
        @endif

        @if(Auth::user()->is_writer)
        <li class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle"  id="NavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Dashboard Redattore
          </a>
          <ul class="dropdown-menu" aria-Labelledby="NavbarDropdown">
            <li ><a class="dropdown-item" href="{{route('writer.dashboard')}}">Articoli creati</a></li>

            <li ><hr class="dropdown-diveder"></li>
            <li ><a class="dropdown-item" href="{{route('article.create')}}">Inserisci un articolo</a></li>

          </ul>
        </li>  
        @endif

        <li class="nav-item">
          <a class="nav-link text-muted " href="{{route('careers')}}"><i>Lavora con noi</i></a>
        </li>

        @endauth
        @guest
        <li class="nav-item dropdown">
          <div class="nav-link dropdown-toggle " href="#" id="NavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <b>Benvenuto Ospite</b>
          </div>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{route('register')}}">Registrati</a></li>

            <li><hr class="dropdown-diveder"></li>
            <li><a class="dropdown-item" href="{{route('login')}}">Accedi</a></li>
          </ul>
        </li>
        @endguest
      </ul>
  </div>
  <form class="d-flex" method="GET" action="{{route('article.search')}}">
    <input class="form-control me-2" type="search" placeholder="Cosa stai cercando?" aria-label="Search"name="query">
    <button class="btn btn-outline-info bg-info text-white" type="submit">Cerca</button>
  </form>
  
</nav>