<x-app-web-layout>
<div class="container mt-5">
    <h2>
        Create new post
        <a href="{{url('post')}}" class="btn btn-danger float-end d-inline">Back</a>
    </h2>
</div>
<form action="{{route('post.store')}}" method="POST" class="container" enctype="multipart/form-data">
    @csrf
<div class="mb-3">
    <label>Post title</label>
    <input type="text" name="title" class="form-control"/>
    @error('name') 
                            <span class="text-danger">{{$message}}</span>
                            @enderror
</div>
<div class="mb-3">
    <label>Post text</label>
    <textarea name="body" rows="3" class="form-control"></textarea>
    @error('name') 
                            <span class="text-danger">{{$message}}</span>
                            @enderror
</div>
<div class="mb-3">
    <label>Author</label>
    <input type="text" name="author" readonly class="form-control" value="{{Auth::user()->name}}">
    @error('name') 
                            <span class="text-danger">{{$message}}</span>
                            @enderror
</div>
<div class="mb-3">
    <label>Language</label>
    <select name="language">
        <option value="en">English</option>
        <option value="lv">Latviešu</option>
        @error('name') 
                            <span class="text-danger">{{$message}}</span>
                            @enderror
    </select>
</div>
<div class="mb-3">
            <label for="category">Category:</label>
            <select id="category" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"> {{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') 
        <span class="text-danger">{{$message}}</span>
    @enderror
        </div>
<div class="mb-3">
    <label>Upload image</label>
    <input type="file" name="image" class="form-control" />
    @error('name') 
                            <span class="text-danger">{{$message}}</span>
                            @enderror
</div>
<div class="mb-3">
    <button type="submit" class="btn btn-primary">Publish</button>
</div>

</form>
</x-app-web-layout>