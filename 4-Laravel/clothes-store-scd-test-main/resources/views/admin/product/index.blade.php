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
                Products
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <a href="{{ route('createproductpage') }}" class="btn btn-primary" style="margin-left: 17px;margin-bottom: 20px;" href="">Create Product</a>
        </div>
    </div>
    
    @if(count($products) > 0)

    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Image</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $single_product)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $single_product->name }}</td>
                <td>{{ $single_product->price }}</td>
                <td>{{ $single_product->description }}</td>
                <td>
                    @if($single_product->image)
                    <img src="{{ asset($single_product->image) }}" alt="" width="150">
                    @else
                    <h5>No Image Found</h5>
                    @endif
                </td>
                <td>
                    <a href="{{ route('producteditpage', $single_product->id) }}" class="btn btn-primary">Edit</a>
                </td>
                <td>
                    <form action="{{ route('deleteproduct', $single_product->id) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button class="btn btn-danger" onclick="return confirm('re Your Sure')";>Delete</button>
                    </form>
                    <td></td>
                </td>
            </tr>               
            @endforeach
        </tbody>
    </table>

    @else
    <h3>No Record Found!</h3>
    @endif
</div>
@endsection