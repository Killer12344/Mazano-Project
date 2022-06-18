<section class="container-fluid header">
    <div class="row">
        <div class="col-12 p-0 m-0">
            <nav class="navbar navbar-light bg-light shadow shadow-sm">
                <div class="container">
                    <div class="d-flex align-items-center justify-content-between w-100">
                        <button class="btn btn-white" id="sidebarBtn"><i class="bi-list"></i></button>
                        <h3 class="mb-0"><a href="{{ route('index') }}" class="text-black text-decoration-none">Mazon.</a></h3>
                        <div class="">
                            <a href="#" class="nav-link text-black"><i class="bi-search icon-width"></i></a>
                            @if(auth()->user())
                                <a href="#" class="nav-link text-black"><i class="bi-person" style="font-size: 21px;"></i></a>
                            @endif
                            <a href="#" class="nav-link text-black position-relative">
                                <i class="bi-bag icon-width"></i>
                                <span class="position-absolute translate-middle badge rounded-pill bg-danger" style="top: 10px; right: -10px;">
                                    <small>{{ \App\Order::count() }}</small>
                              </span>
                            </a>
                            @if(empty(auth()->user()))
                                <a href="{{ route('login') }}" class="nav-link text-black sign-in-btn">Sign In</a>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="row menu-sidebar shadow">
        <div class="col-12">
            <div class="position-relative">
                <div class="position-fixed" style="bottom: 5%; right: 35%;">
                    <button class="btn btn-dark" id="closeBtn" style="border-radius: 100px;"><i class="bi-x" style="font-size: 25px;"></i></button>
                </div>
            </div>
        </div>
    </div>
</section>
