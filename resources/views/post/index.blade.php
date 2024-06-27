<x-app-web-layout>
<div class="container mt-5 d-flex align-items-center justify-content-center flex-column">
    <h2 class="float">News feed</h2>
    @can ('create post')
    <a href="{{url('post/create')}}" class="btn btn-primary">Add post</a>
    @endcan
</div>
@foreach ($posts as $post )
<div class="container mt-3 mx-auto w-50">
    <div class="card">
        <div class="row no-gutters">
            <div class="col-md-4 d-flex align-items-center">
                <img src="{{asset($post->image)}}" class="card-img"  alt="Post Image">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <p class="card-text">{{$post->category->name}}</p>
                    <p class="card-text"><small class="text-muted">Author: {{$post->author}}</small></p>
                    <p class="card-text"><small class="text-muted">Post created at: {{ $post->created_at->format('F j, Y, g:i a') }}</small></p>
                    <a href="{{route('post.show', $post->id)}}" class="btn btn-primary mt-4 ">Show post</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
</x-app-web-layout>