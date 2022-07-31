@extends('admin.layout.app')

@section('content')

<div id="page-wrapper">
    
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session()->get('success') }}
        </div>
    @endif

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
            {{-- CATEGORY UPDATE --}}
            @if ($category_row)
                <a href="{{ route('categories') }}" class="btn btn-primary">Back To Insert</a>
                <form action="{{ route('categories_update', ['category' => $category_row->cat_id]) }}" method="POST"
                    role="form">
                    @csrf
                    @method('PUT')
                    <h3>Update Category</h3>
                    <div class="form-group">
                        <label for="">Category Title</label>
                        <input type="text" class="form-control" id="" placeholder="Category Name"
                            name="cat_title" value="{{ $category_row->cat_title }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            @else
                {{-- CATEGORY CREATE --}}
                <form action="{{ route('categories_store') }}" method="POST" role="form">
                    @csrf
                    <h3>Insert Category</h3>
                    <div class="form-group">
                        <label for="">Category Title</label>
                        <input type="text" class="form-control" id="" placeholder="Category Name"
                            name="cat_title">
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
                            <th>Id</th>
                            <th>Title</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $single_category)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $single_category->cat_title }}</td>
                                <td>
                                    <a href="{{ route('categories', ['cat_id' => $single_category->cat_id]) }}"
                                        class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                    <a href="{{ route('deletecategory', $single_category->cat_id ) }}" class="btn btn-danger" onclick="return confirm('Are You Sure')";>Delete</a>
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
</div>
@endsection
