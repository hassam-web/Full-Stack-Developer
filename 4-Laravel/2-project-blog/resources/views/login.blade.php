@extends('layout.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default" style="width: 60%;margin: 0 auto;">
            <div class="panel-body">
                <div class="text-center">
                    <h3><i class="fa fa-user fa-4x"></i></h3>
                    <h2 class="text-center">Login</h2>
                    <div class="panel-body">
                        <form id="login-form" role="form" autocomplete="off" class="form" method="POST" action="{{ route('login_post') }}">
                            @csrf
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>
                                    <input name="email" type="text" class="form-control" placeholder="Enter Username">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                    <input name="password" type="password" class="form-control" placeholder="Enter Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <!-- <input name="login" class="btn btn-lg btn-primary btn-block" value="Login" type="submit"> -->
                                <button type="submit" class="btn btn-lg btn-primary btn-block">Login</button>
                            </div>
                        </form>
                    </div><!-- Body-->
                </div>
            </div>
        </div>
    </div>
@endsection