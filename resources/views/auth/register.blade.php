<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-3">
        <a class="navbar-brand d-none d-lg-block" href="{{ url('/') }}">Home</a>
        <div class="justify-content-between">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('posts.index') }}">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('exchange.index') }}">Exchange Rates</a>
                </li>
                @if(!Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="nav-link" href="{{ route('logout') }}">Logout</button>
                        </form>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-5 col-xl-4">
                <div class="card p-3">
                    <h1>Register</h1>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div>
                            <label>Name</label>
                            <input class="form-control" type="text" name="name" required>
                        </div>
                        <div>
                            <label>Email</label>
                            <input class="form-control" type="email" name="email" required>
                        </div>
                        <div>
                            <label>Password</label>
                            <input class="form-control" type="password" name="password" required>
                        </div>
                        <div>
                            <label>Confirm Password</label>
                            <input class="form-control" type="password" name="password_confirmation" required>
                        </div>
                        <button class="btn btn-primary mt-3" type="submit">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
