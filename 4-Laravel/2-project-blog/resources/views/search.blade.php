@extends('layout.app')
@section('content')
<div class="row">
<!-- Blog Entries Column -->
<div class="col-md-8">
   <h1 class="page-header">
      All Posts
   </h1>
   <!-- First Blog Post -->
   @if (count($posts) > 0)
   @foreach ($posts as $key => $single_post)
   <h2>
      <a href="{{ route('post_detail',['post_id' => $single_post->post_id]) }}">{{  $single_post->post_title }}</a>
   </h2>
   <p class="lead">
      by <a href="index.php">{{  $single_post->post_author }}</a>
      <br>
      <small>Category</small> {{ $single_post->category->cat_title }}
   </p>
   <p><span class="glyphicon glyphicon-time"></span> Posted on 
      {{ date("M d, Y h:i A",strtotime($single_post->post_date)) }}
   </p>
   <hr>
   @if ($single_post->post_image)
   <a href="{{ route('post_detail',['post_id' => $single_post->post_id]) }}"><img src="{{ asset($single_post->post_image) }}" alt="" class="img-responsive img-thumbnail"></a>
   @else
   {{-- <img class="img-responsive" src="http://placehold.it/900x300" alt=""> --}}
   <p>no image found</p>
   @endif
   <hr>
   <p>{{ $single_post->post_content }}</p>
   <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
   <hr>
   @endforeach
   @else
   <h2>No Post Found</h2>
   @endif
   <!-- Pager -->
   {{-- 
   <ul class="pager">
      <li class="previous">
         <a href="#">&larr; Older</a>
      </li>
      <li class="next">
         <a href="#">Newer &rarr;</a>
      </li>
   </ul>
   --}}
</div>
@endsection