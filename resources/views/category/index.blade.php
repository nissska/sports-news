<x-app-web-layout>

<div class="container">
    <div class="row">
        <div class="col-md-12">
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
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $categories as $category)
                            
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->description}}</td>
                                <td>{{$category->status == 1 ? 'Visible' : 'Hidden'}}</td>
                                <td>
                                    <a href="{{route('category.show', $category->id)}}" class="btn btn-primary">Show</a>
                                    <a href="{{route('category.edit', $category->id)}}" class="btn btn-success">Edit</a>
                                    <a href="{{route('category.destroy', $category->id)}}" class="btn btn-danger">Delete</a>
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