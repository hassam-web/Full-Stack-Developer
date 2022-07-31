@extends('admin.layout.app')

@section('content')
<div id="page-wrapper">

  

 <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                       Create Product
                    </h1>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <a class="btn btn-primary" style="margin-left: 17px;margin-bottom: 20px;" href="{{ route("adminproducts") }}">Back To products</a>
                </div>
            </div>

<form action="{{ route('createproduct') }}" method="POST" role="form" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
                <label >Product Category</label>
                <select name="product_category_id" id="" class="form-control" style="height: 34px">
                    <option value="">Select Category</option>
                    @if ($categories)
                        @foreach ($categories as  $single_category)
                            <option value="{{ $single_category->cat_id }}">{{ $single_category->cat_title }}</option>
                        @endforeach
                    @endif
                </select>
            </div>


            <div class="form-group">
                <label for="">Product Name</label>
                <input type="text" class="form-control" name="name" placeholder="Product Title">
            </div>

            <div class="form-group">
                <label for="">Product Price</label>
                <input type="number" class="form-control" name="price" placeholder="Product Price">
            </div>

        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="form-group">
                <label for="">Product Image</label>
                <input type="file" class="form-control" name="image" placeholder="Product Image">                
            </div>


            <div class="form-group">
                <label for="">Product Description</label>
                <textarea name="description" id="" cols="30" rows="6" class="form-control"></textarea>
            </div>

        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
 </div>

@endsection