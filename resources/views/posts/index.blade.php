<!DOCTYPE html>
<html>
<head>
    <title>Posts</title>
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
                    <h1>Posts</h1>
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
            <h2>Posts</h2>
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-12 col-lg-6 col-xl-4">
                        <div class="card" style="height: 100%;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ $post->content }}</p>
                                <a href="#" class="btn btn-success">Edit</a>
                                <a href="{{ route('posts.destroy', $post->id) }}" class="btn btn-danger">Delete</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.editBtn').click(function() {
                var postId = $(this).parent().data('id');
                $.get('/posts/' + postId, function(post) {
                    $('#editTitle').val(post.title);
                    $('#editContent').val(post.content);
                    $('#editForm').attr('action', '/posts/' + post.id);
                    $('#editModal').show();
                });
            });

            $('#editForm').submit(function() {
                $('#editModal').hide();
            });
        });
    </script>
</body>
</html>
