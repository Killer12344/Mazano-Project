<!DOCTYPE html>
<html lang="en">
<head>
    @yield('meta')
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mazano</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
</head>
<body>

@include('inter-face.layouts.header')

<section class="container-fluid body">
    <div class="container">
        <div class="row min-vh-100 justify-content-center align-items-center">
            <div class="col-12 col-md-12">
                <h2 class="fw-bolder">Hello World</h2>
                <button type="button" id="btn"> Hello </button>
            </div>
        </div>
    </div>
</section>

<section class="container-fluid item">
    <div class="container">
        <div class="row my-4 py-4">

            @include('inter-face.layouts.left')

            <div class="col-12 col-md-9">
                <div class="right_side">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@include('inter-face.layouts.footer')

<script src="{{ asset('js/theme.js') }}"></script>
@yield('foot')
@include('toast.alert')
</body>
</html>


