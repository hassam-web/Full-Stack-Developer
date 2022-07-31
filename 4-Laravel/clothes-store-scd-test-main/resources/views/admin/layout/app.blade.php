<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Admin Panel | Clothes Store</title>
<link rel="icon" type="text/css" href="{{ asset('icon.png') }}">

<!-- Bootstrap Core CSS -->
    
<link href="{{ asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">

<!-- Custom CSS -->
<link href="{{ asset('admin/css/sb-admin.css')}}" rel="stylesheet">

<!-- Custom Fonts -->
<link href="{{ asset('admin/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

</head>

<body>

<div id="wrapper">

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{route('home')}}">Home</a>
    </div>
    <!-- Top Menu Items -->
<ul class="nav navbar-right top-nav">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user()->name }}<b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li>
                <a href="{{ route('profile.show') }}"><i class="fa fa-fw fa-user"></i> Profile</a>
            </li>
            <li class="divider"></li>
            <li>
                @if (Route::has('login'))
                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
          <button type="submit" class="btn btn-info btn-sm" style="margin-left: 18px"><i class="fa fa-fw fa-power-off"></i>{{ __('Log Out') }}</a></button>
                </form>
                @endif
                @endauth
                </li>
            </ul>
        </li>
    </ul>
<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
<ul class="nav navbar-nav side-nav">
    <li>
        <a href="{{ route('dashboard') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
    </li>
    <li>
        <a href="{{ route('categories') }}"><i class="fa fa-fw fa-gear"></i> Categories</a>
    </li>
    <li>
        <a href="{{ route('adminproducts') }}"><i class="fa fa-fw fa-gear"></i> Products</a>
    </li>

    <li>
        <a href="{{ route('user') }}"><i class="fa fa-fw fa-user"></i> Users</a>
    </li>
    <li>
        <a href="{{ route('order') }}"><i class="fa fa-fw fa-gear"></i> Orders</a>
    </li>

</ul>
</div>
<!-- /.navbar-collapse -->
</nav>

@yield('content')


<script src="admin/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="admin/js/bootstrap.min.js"></script>

</body>

</html>