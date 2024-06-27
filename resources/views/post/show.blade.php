<x-app-web-layout>
    <div class="container mt-5">
            <a href="{{ route('post.index') }}" class="btn btn-secondary">Back to posts</a>
    </div>
    <div class="container mt-5">
        <div class="card w-75 mx-auto">
            @if($post->image)
            <img src="{{ asset($post->image) }}" class="card-img-top img-fluid" alt="Post Image" style="max-height: 350px; object-fit: cover;">
            @endif
            <div class="card-body">
                <h2 class="card-title">{{ $post->title }}</h2>
                <p class="card-text"><small class="text-muted">Author: {{ $post->author }}</small></p>
                <p class="card-text"><small class="text-muted">{{ $post->category->name }}</small></p>
                <p class="card-text"><small class="text-muted">Post created at: {{ $post->created_at->format('F j, Y, g:i a') }}</small></p>
                <hr>
                <p class="card-text">{{ $post->body }}</p>
                <hr>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('post.index') }}" class="btn btn-secondary">Back to posts</a>
                    <div class="d-flex">
                        @can('edit post')
                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning">Edit post</a>
                        @endcan
                        @can('delete post')
                        <form action="{{ route('post.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger ms-2">Delete post</button>
                        </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card w-75 mx-auto mt-5">
            <div class="card-body">
                <h3 class="card-title">Comments</h3>
                @foreach($post->comments as $comment)
                <div class="border rounded p-3 mb-3">
                    <p><strong>{{ $comment->author }}</strong> said:</p>
                    <p>{{ $comment->body }}</p>
                    <p class="text-muted">{{ $comment->created_at->format('F j, Y, g:i a') }}</p>
                    @can('delete comment')
                        <form action="{{ route('comment.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    @endcan
                </div>
                @endforeach

                @auth
                    <h4 class="mt-4">Add a comment</h4>
                    <form action="{{ route('post.comment.store', $post->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="author" value="{{ Auth::user()->name }}">
                        <div class="mb-3">
                            <label for="body" class="form-label">Comment</label>
                            <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                @else
                    <p class="text-muted">You must be logged in to leave a comment. <a href="{{ route('login') }}">Login</a> or <a href="{{ route('register') }}">Register</a></p>
                @endauth
            </div>
        </div>
    </div>
</x-app-web-layout>