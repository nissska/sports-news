<x-app-web-layout>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @session('status')
                <div class="alert alert-success mt-3">{{session('status')}}</div>
                @endsession
                <div class="card mt-5">
                    <div class="card-header">
                        <h4>List of categories
                            <a href="{{url('category/create')}}" class="btn btn-primary float-end">Add Category</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $categories as $category)

                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->description}}</td>
                                    <td>
                                        <a href="{{route('category.show', $category->id)}}" class="btn btn-primary float-end ms-3">Show</a>
                                        <a href="{{route('category.edit', $category->id)}}" class="btn btn-success float-end ms-3">Edit</a>
                                        <form action="{{route('category.destroy', $category->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger float-end">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-web-layout>