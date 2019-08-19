<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
    <a class="navbar-brand js-scroll-trigger" href="#page-top">
        <span class="d-block d-lg-none">{{config("app.name", "Fullstacktest")}}</span>
        <span class="d-none d-lg-block">
        <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="img/contact.png" alt="">
        </span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
            @guest
                <li class="nav-item">
                    <div class="subheading">
                        <h3 class="mb-4">My<span>  Contacts</span></h3>
                    </div>
                </li>
            @else
                <li class="nav-item">
                <div class="subheading">
                        <h3 class="mb-1"> {{ Auth::user()->name }} </h3>
                    </div>
                       
               
                </li>

                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
               
            @endguest
        </ul>
    </div>
</nav>