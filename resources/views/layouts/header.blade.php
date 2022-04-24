<div class="col-12">
    <div class="p-2 bg-primary d-flex justify-content-between align-items-center rounded">
        <button class="show-sidebar-btn btn btn-primary d-block d-lg-none">
            <i class="feather-menu text-light" style="font-size: 2em;"></i>
        </button>
        <form action="" method="post" class="d-none d-md-block">
            <div class="form-inline">
                <input type="text" class="form-control mr-2" placeholder="Search Everything">
                <button class="btn btn-light">
                    <i class="feather-search text-primary"></i>
                </button>
            </div>
        </form>
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="feather-user"></i> {{ auth()->user()->name }}
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="{{ route('logoutAcc') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="feather-log-out"></i> logout
                </a>

            </div>
            <form id="logout-form" action="{{ route('logoutAcc') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</div>
