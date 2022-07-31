@extends('layout.app')
@section('content')


  <!-- Product grid -->
  <?php if (count($products) > 0): ?>
<div class="w3-container w3-text-grey" id="jeans">
    <p>items</p>
  </div>
  <div class="w3-row w3-grayscale">
    @foreach ($products as $single_product)
        
    <div class="w3-col l3 s6">
      <div class="w3-container">
        <div class="w3-display-container">
        @if ($single_product->image)
        <a href=""><img src="{{ asset($single_product->image) }}" alt="" class="img-responsive img-thumbnail" style="width:100%"></a>
        @else
        <img class="img-responsive" src="http://placehold.it/900x300" alt="" style="width:100%">
        <p>no image found</p>
        @endif

          <div class="w3-display-middle w3-display-hover">
            <form action="{{ route('addtocart') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="hidden" value="{{ $single_product->id }}" id="id" name="id">
              <input type="hidden" value="{{ $single_product->product_category_id }}" id="id" name="product_category_id">
              <input type="hidden" value="{{ $single_product->name }}" id="name" name="name">
              <input type="hidden" value="{{ $single_product->description }}" id="name" name="description">
              <input type="hidden" value="{{ $single_product->price }}" id="price" name="price">
              <input type="hidden" value="{{ $single_product->image }}" id="img" name="image">
            <button class="w3-button w3-black">Buy now <i class="fa fa-shopping-cart"></i></button>
          </form>
          </div>
        </div>
        <p>{{ $single_product->name }}<br><b>${{ $single_product->price }}</b></p>
      </div>
    </div>
    @endforeach

  </div>
  <?php else: ?>
    <h2>No records found!</h2>
  <?php endif ?>


  
  <!-- Footer -->

    
@endsection