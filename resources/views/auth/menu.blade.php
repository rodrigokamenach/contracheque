@section('menu')
    <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top ">
        <a href="#" class="navbar-brand">
            <img src="{{ asset('img/logologin.png') }}" class="img-fluid|thumbnail card-img-top" alt="">
        </a>
        
        <button class="navbar-toggler" data-toggle="collapse" data-target="#collapse_target">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="collapse_target">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link text-light"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contracheque') }}" class="nav-link text-light"><i class="fas fa-file-invoice-dollar    "></i> Contracheque</a>
                </li>                            
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link text-light dropdown-toggle" data-toggle="dropdown" data-target="dropdown_target">
                            <i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->nome }}
                        <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown_target">                        
                        <a href="{{ url('/logout') }}" class="dropdown-item"><i class="fas fa-sign-out-alt    "></i> Sair</a>                        
                    </div>
                </li>
            </ul>
        </div>        
    </nav>       
@endsection