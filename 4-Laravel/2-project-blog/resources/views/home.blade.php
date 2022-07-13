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
         by <a href="index.php">{{ $single_post->post_author }}</a>
         <small>Category</small>  {{ $single_post->category->cat_title }}
      </p>
      <p><span class="glyphicon glyphicon-time"></span> Posted on 
         {{ date("M d, Y h:i A",strtotime($single_post->post_date)) }}
      <hr>
      @if ($single_post->post_image)
      <a href="{{ route('post_detail',['post_id' => $single_post->post_id]) }}"><img src="{{ asset($single_post->post_image) }}" alt="" class="img-responsive img-thumbnail">
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
      <h2>Not Post Found</h2>
      @endif
      <!-- Pager -->
      <!-- <ul class="pager">
         <li class="previous">
             <a href="#">&larr; Older</a>
         </li>
         <li class="next">
             <a href="#">Newer &rarr;</a>
         </li>
         </ul> -->
   </div>
            <!-- Blog Sidebar Widgets Column -->
        {{--  <div class="col-md-4">
            <!-- Blog Search Well -->
            <div class="well">
               <h4>Blog Search</h4>
               <div class="input-group">
                  <input type="text" class="form-control">
                  <span class="input-group-btn">
                  <button class="btn btn-default" type="button">
                  <span class="glyphicon glyphicon-search"></span>
                  </button>
                  </span>
               </div>
               <!-- /.input-group -->
            </div>
            <!-- Blog Categories Well -->
            <div class="well">
               <h4>Blog Categories</h4>
               <div class="row">
                  <div class="col-lg-12">
                     <ul class="list-unstyled">
                        @if ($categories)
                        @foreach ($categories as $single_cat)
                        <li><a href="#">{{ $single_cat->cat_title }}</a></li>
                        @endforeach
                        @endif
                     </ul>
                  </div>
               </div>
               <!-- /.row -->
            </div>
            Side Widget Well --
           
            <div class="well">
               <h4>Side Widget Well</h4>
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
            </div>
            
         </div> --}}
      <!-- /.row
@endsection