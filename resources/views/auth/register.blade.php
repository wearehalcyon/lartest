<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-3">
        <a class="navbar-brand" href="{{ url('/') }}">Home</a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="{{ route('login') }}">Login</a>
                <a class="nav-item nav-link active" href="{{ route('register') }}">Register</a>
                <a class="nav-item nav-link active" href="{{ route('posts.index') }}">Posts</a>
            </div>
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
