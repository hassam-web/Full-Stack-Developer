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

    
    @if(count($orders) > 0)

    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>User Name</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $key => $single_order)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $single_order->username }}</td>
                <td>{{ $single_order->name }}</td>
                <td>{{ $single_order->price }}</td>
                <td>{{ $single_order->description }}</td>
                <td>
                    @if($single_order->image)
                    <img src="{{ asset($single_order->image) }}" alt="" width="150">
                    @else
                    <h5>No Image Found</h5>
                    @endif
                </td>
                <td>
                    <a href="" class="btn btn-success">Place Order</a>
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