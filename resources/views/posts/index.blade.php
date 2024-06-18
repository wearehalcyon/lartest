<!DOCTYPE html>
<html>
<head>
    <title>Posts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-3">
        <a class="navbar-brand" href="{{ url('/') }}">Home</a>
        <div class="collapse navbar-collapse justify-content-between" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('posts.index') }}">Posts</a>
                </li>
                @if(!Auth::user())
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item active">
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

    @if($posts->isNotEmpty())
        <div class="container mt-5">
            <h2>Posts ({{ $posts->count() }})</h2>
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-12 col-lg-6 col-xl-4 mb-4">
                        <div class="card" style="height: 100%;">
                            <div class="card-body" data-post="{{ $post->id }}">
                                <p>{{ '#' . $post->id }}</p>
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ $post->content }}</p>
                                <a href="#" class="btn btn-success edit" data-id="{{ $post->id }}" data-action="{{ route('posts.update', $post->id) }}">Edit</a>
                                <a href="{{ route('posts.destroy', $post->id) }}" class="btn btn-danger confirm">Delete</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div id="editModal" style="display:none;">
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label>Title</label>
                <input type="text" name="title" id="editTitle" required>
            </div>
            <div>
                <label>Content</label>
                <textarea name="content" id="editContent" required></textarea>
            </div>
            <button type="submit">Update Post</button>
        </form>
    </div>

    <div class="edit-post-popup">
        <div class="card p-3 edit-post-window">
            <div class="close-popup">
                <button class="btn-close" type="button">✕</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
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
</body>
</html>
