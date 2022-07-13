@extends('layout.app')
@section('content')
<div class="row">
<!-- Blog Entries Column -->
<div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{ $post_row->post_title }}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">{{ $post_row->post_author }}</a> <br>

                    <small>Category</small> {{ $post_row->category->cat_title }}
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on {{ date("M d, Y h:i A",strtotime($post_row->post_date)) }}</p>

                <hr>

                <!-- Preview Image -->
                @if ($post_row->post_image)
                <img class="img-responsive" src="{{ asset($post_row->post_image) }}" alt="{{ $post_row->post_title }}">
                @else
                <h2>No Image Found</h2>
                @endif

                <hr>

                <!-- Post Content -->
                <p class="lead">{{ $post_row->post_content }}</p>

                <hr>

                @if(Auth::check())
                    @if(Auth::user()->isUserLikeThisPost($post_row->post_id))
                        <div class="row">
                            <p class="pull-right">
                                <a
                                class="unlike"
                                href="{{ route('post_unlike',['post' => $post_row->post_id]) }}"><span class="glyphicon glyphicon-thumbs-down"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Want to like it?"
                                ></span>
                                    Unlike
                                </a>
                            </p>
                        </div>
                    @else
                        <div class="row append-like-btn">
                            <p class="pull-right">
                                <a
                                class="like"
                                href="{{ route('post_like',['post' => $post_row->post_id]) }}">
                                <span class="glyphicon glyphicon-thumbs-up"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="I liked this before"
                                >
                                </span>
                                    Like
                                </a>
                            </p>
                        </div>
                    @endif
                @endif

                <!-- Blog Comments -->

                <!-- Comments Form -->

                @if (Auth::check())
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form method="POST" action="{{ route('store_comment',['post' => $post_row->post_id]) }}">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <hr>
                @endif


                <!-- Posted Comments -->

                <!-- Comment -->

                @if($post_row->comments)
                    @if(count($post_row->comments) > 0)
                        @foreach ($post_row->comments as $single_comment)
                            @if ($single_comment->comment_status == 'approved')
                            <div class="media" style="margin-bottom:20px;">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"> {{ $single_comment->user->user_firstname }} {{ $single_comment->user->user_lastname }}
                                        <small>{{ date("M d, Y h:i A",strtotime($single_comment->created_at)) }}</small>
                                    
                                    </h4>
                                   {{ $single_comment->comment_content }}
                                </div>
                            </div>
                            @endif
                        @endforeach

                    @endif
                @endif


            </div>
@endsection