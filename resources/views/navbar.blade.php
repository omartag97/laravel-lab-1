<!doctype html>
<html lang="ar" >
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <title>@yield('title')</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <h3>
                ITI
            </h3>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a style="font" class="ml-3 nav-link active" aria-current="page" href="/posts">
                    <h3>
                        All posts
                    </h3>
                </a>
            </li>
            </ul>
            <div>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @if (Auth::guest())
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/user/register">
                            <h4>
                                Registeration
                            </h4>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/user/login">
                            <h4>
                                Login
                            </h4>
                        </a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/user/logout">
                            <h4>
                                Logout
                            </h4>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>

        </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

  </body>
</html>
