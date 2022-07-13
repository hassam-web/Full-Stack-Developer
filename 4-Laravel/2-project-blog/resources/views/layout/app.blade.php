<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Blog Home - Start Bootstrap Template</title>
      <!-- Bootstrap Core CSS -->
      <link href="{{ asset('template/css/bootstrap.min.css') }}" rel="stylesheet">
      <!-- Custom CSS -->
      <link href="{{ asset('template/css/blog-home.css') }}" rel="stylesheet">
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      

      <!-- jQuery -->
      <script src="{{ asset('template/js/jquery.js') }}"></script>

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   </head>
   <body>
      <!-- Navigation -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
         <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="/">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <ul class="nav navbar-nav">
                  @if ($categories)
                     @foreach ($categories as $single_cat)
                        <li><a href="{{ route('category_detail',['cat_id' => $single_cat->cat_id ]) }}">{{ $single_cat->cat_title }}</a></li>
                     @endforeach
                  @endif

                  <li><a href="{{ route('register') }}">Register</a></li>
                  @if (Auth::check())
                     <li>
                     <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" style="background: transparent;color: #9d9d9d;border: none;outline: none;padding-top: 15px;">Logout</button>
                     </form>
                     </li>
                  @else
                     <li><a href="{{ route('login') }}">Login</a></li>
                  @endif


                   @if (Auth::check())
                     <li><a href="{{ route('dashboard') }}">Admin</a></li>
                   @endif
               </ul>
            </div>
            <!-- /.navbar-collapse -->
         </div>
         <!-- /.container -->
      </nav>
      <!-- Page Content -->
      <div class="container">
         @yield('content')

          <!-- Blog Sidebar Widgets Column -->
   <div class="col-md-4">
      <!-- Blog Search Well -->
      <div class="well">
         <h4>Blog Search</h4>
         <form action="{{ route('search') }}" method="POST">
            @csrf
            <div class="input-group">
               <input type="text" class="form-control" name="query_custom">
               <span class="input-group-btn">
               <button class="btn btn-default" type="submit">
               <span class="glyphicon glyphicon-search"></span>
               </button>
               </span>
            </div>
         </form>
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
                        <li><a href="{{ route('category_detail',['cat_id' => $single_cat->cat_id ]) }}">{{ $single_cat->cat_title }}</a></li>
                     @endforeach
                  @endif
               </ul>
            </div>
            <!-- /.col-lg-6 -->
         </div>
         <!-- /.row -->
      </div>
      <!-- Side Widget Well -->
      {{-- <div class="well">
         <h4>Side Widget Well</h4>
         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
      </div> --}}
   </div>
</div>
<!-- /.row -->
<hr>
         <!-- Footer -->
         <footer>
            <div class="row">
               <div class="col-lg-12">
                  <p>Copyright &copy; Your Website 2014</p>
               </div>
               <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
         </footer>
      </div>
      <!-- /.container -->
      <!-- Bootstrap Core JavaScript -->
      <script src="{{ asset('template/js/bootstrap.min.js') }}"></script>
      <script>
         @if ($errors->any())
            @foreach ($errors->all() as $key => $singleError)
               toastr.error("{{ $singleError }}")
            @endforeach
         @endif
         @if (session('success'))
            toastr.success("{{ session('success') }}")
         @endif
         @if (session('error'))
            toastr.error("{{ session('error') }}")
         @endif
       </script>

   </body>
</html>