@extends('admin.layout.app')

@section('content')
 <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Categories
                    </h1>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    {{-- CATEGORY UPDATE  --}}
                    @if($category_row)
                    <a href="{{ route('categories') }}" class="btn btn-primary">Back To Insert</a>
                    <form action="{{ route('categories_update' , ['category' => $category_row->cat_id ]) }}" method="POST" role="form">
                        @csrf
                        @method("PUT")
                        <h3>Update Category</h3>
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" id="" placeholder="Category Name" name="category_name" value="{{ $category_row->cat_title }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    @else
                    {{-- CATEGORY CREATE  --}}
                    <form action="{{ route('categories_store') }}" method="POST" role="form">
                        @csrf
                        <h3>Insert Category</h3>
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" id="" placeholder="Category Name" name="category_name">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    @endif
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    @if (count($categories) > 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Sno</th>
                                <th>Category Id</th>
                                <th>Category Name</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key =>  $single_category)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $single_category->cat_id }}</td>
                                <td>{{ $single_category->cat_title }}</td>
                                <td>
                                    <a href="{{ route('categories',['cat_id' => $single_category->cat_id]) }}" class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                    <form action="{{ route('categories_delete',['category' => $single_category->cat_id ]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are You Sure ?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <h2>No Record Found!</h2>
                    @endif
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
@endsection