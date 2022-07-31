@extends('admin.layout.app')
@section('content')

<div id="page-wrapper">

  

    <div class="container-fluid">
               <!-- Page Heading -->
               <div class="row">
                   <div class="col-lg-12">
                       <h1 class="page-header">
                          Update user
                       </h1>
                   </div>
               </div>
   
               <div class="row">
                   <div class="col">
                       <a class="btn btn-primary" style="margin-left: 17px;margin-bottom: 20px;" href="{{ route('user') }}">Back To users</a>
                   </div>
               </div>
   
   <form action="{{ route('user_update_post',['id' => $user->id]) }}" method="POST" role="form" enctype="multipart/form-data">
       @csrf
       @method("PUT")
        <div class="row">
          <div class="col-lg-12"></div>
              <div class="form-group">
                 <label for="">Name</label>
                 <input type="text" class="form-control" name="name" value="{{ $user->name }}">
              </div>
              <div class="form-group">
                 <label for="">Email</label>
                 <input type="email" class="form-control" name="email" value="{{ $user->email }}">
              </div>
              <div class="form-group">
                 <label for="">Password</label>
                 <input type="password" class="form-control" name="password" placeholder="Password">
              </div>
            </div>

           
   
           
       <button type="submit" class="btn btn-primary">Submit</button>
   </form>
    </div>
    </div>
@endsection