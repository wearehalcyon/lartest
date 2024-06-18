<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-3">
        <a class="navbar-brand" href="{{ url('/') }}">Home</a>
        <div class="collapse navbar-collapse justify-content-between" id="navbarText">
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

    @if(session('updated'))
        <div class="container mt-5">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-success" role="alert">
                        {{ session('updated') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(session('deleted'))
        <div class="container mt-5">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-success" role="alert">
                        {{ session('deleted') }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(Auth::check())
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-5 col-xl-4">
                    <div class="card p-3">
                        <h1>Create Post</h1>
                        <form id="postForm" method="POST" action="{{ route('posts.store') }}">
                            @csrf
                            <div>
                                <label>Title</label>
                                <input class="form-control" type="text" name="title" required>
                            </div>
                            <div>
                                <label>Content</label>
                                <textarea class="form-control" name="content" required></textarea>
                            </div>
                            <button class="btn btn-primary mt-3" type="submit">Create Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-5 col-xl-4">
                    <div class="card d-block p-3">
                        To create or edit/delete post - please <a href="{{ route('login') }}">Login</a> into your account.
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($posts->isNotEmpty())
        <div class="container mt-5 mb-5">
            <h2>Posts ({{ $postsAll->count() }})</h2>
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-12 col-lg-6 col-xl-4 mb-4">
                        <div class="card" style="height: 100%;">
                            <div class="card-body" data-post="{{ $post->id }}">
                                <p>{{ '#' . $post->id }}</p>
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ $post->content }}</p>
                                <a href="#" class="btn btn-primary view" data-id="{{ $post->id }}">View</a>
                                @if(Auth::check())
                                    <a href="#" class="btn btn-success edit" data-id="{{ $post->id }}" data-action="{{ route('posts.update', $post->id) }}">Edit</a>
                                    <a href="{{ route('posts.destroy', $post->id) }}" class="btn btn-danger confirm">Delete</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $posts->links('pagination.posts') }}
            </div>
        </div>
    @endif

    <div class="view-post-popup">
        <div class="card py-3 px-5 view-post-window">
            <div class="close-popup">
                <button class="btn-close" type="button"></button>
            </div>
            <div class="post-data">
                <h2 class="title"></h2>
                <p class="content"></p>
            </div>
        </div>
    </div>

    @if(Auth::check())
        <div class="edit-post-popup">
            <div class="card p-3 edit-post-window">
                <div class="close-popup">
                    <button class="btn-close" type="button"></button>
                </div>
                <form id="postEditForm" method="POST" action="">
                    @csrf
                    <div>
                        <label>Title</label>
                        <input class="form-control" type="text" name="title" required>
                    </div>
                    <div>
                        <label>Content</label>
                        <textarea class="form-control" rows="10" name="content" required></textarea>
                    </div>
                    <button class="btn btn-primary mt-3" type="submit">Update Post</button>
                </form>
            </div>
        </div>
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/view-post.js') }}"></script>
    @if(Auth::check())
        <script src="{{ asset('assets/js/edit-post.js') }}"></script>
        <script>
            $(document).ready(function($){
                let confirmBtn = $('.confirm');

                confirmBtn.on('click', function(){
                    if (confirm("Are you sure you want to delete this post card?") == true) {
                        return true;
                    }
                    return false;
                });
            });
        </script>
    @endif
</body>
</html>
