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
                <p class="card-text"><small class="text-muted">Post created at: {{ $post->created_at->format('F j, Y, g:i a') }}</small></p>
                <hr>
                <p class="card-text">{{ $post->body }}</p>
                <hr>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('post.index') }}" class="btn btn-secondary">Back to posts</a>
                    <div class="d-flex">
                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning">Edit post</a>
                        <form action="{{ route('post.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger ms-2">Delete post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-web-layout>