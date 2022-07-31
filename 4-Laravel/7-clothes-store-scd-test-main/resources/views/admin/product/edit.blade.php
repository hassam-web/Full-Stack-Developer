@extends('admin.layout.app')
@section('content')

<div id="page-wrapper">

  

    <div class="container-fluid">
               <!-- Page Heading -->
               <div class="row">
                   <div class="col-lg-12">
                       <h1 class="page-header">
                          Update Product
                       </h1>
                   </div>
               </div>
   
               <div class="row">
                   <div class="col">
                       <a class="btn btn-primary" style="margin-left: 17px;margin-bottom: 20px;" href="{{ route("adminproducts") }}">Back To products</a>
                   </div>
               </div>
   
   <form action="{{ route('product_update',['product' => $product->id]) }}" method="POST" role="form" enctype="multipart/form-data">
       @csrf
       @method("PUT")
       <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label >Product Category</label>
                <select name="product_category_id" id="" class="form-control">
                    <option value="">Select Category</option>
                    @if ($categories)
                        @foreach ($categories as  $single_category)
                            <option value="{{ $single_category->cat_id }}" 
                                @if ($product->product_category_id == $single_category->cat_id)
                                    selected 
                                @endif
                                >{{ $single_category->cat_title }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
   
   
               <div class="form-group">
                   <label for="">Product Name</label>
                   <input type="text" class="form-control" name="name" placeholder="Product Title" value="{{ $product->name }}">
               </div>
   
               <div class="form-group">
                   <label for="">Product Price</label>
                   <input type="number" class="form-control" name="price" placeholder="Product Price" value="{{ $product->price }}">
               </div>
   
           </div>

           <div class="form-group">
            <label for="">Product Image</label>
            <input type="file" class="form-control" name="image" placeholder="Product Image">'
            @if($product->image)
            <img src="{{ asset($product->image) }}" alt="" width="150" style="margin-top: 20px;">
            @endif
        </div>
               
               <div class="form-group">
                <label for="">Product Description</label>
                <textarea name="description" id="" cols="30" rows="0" class="form-control">{{ $product->description }}</textarea>
            </div>

   
           </div>
       </div>
       <button type="submit" class="btn btn-primary">Submit</button>
   </form>
    </div>
    
@endsection