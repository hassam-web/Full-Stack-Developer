@extends('layout.app')
@section('content')
<div class="row">
<!-- Blog Entries Column -->
<div class="col-md-8 ">
   <form action="{{ route('register_post') }}" method="POST" role="form" enctype="multipart/form-data">
      @csrf
      <legend>User Registration</legend>
   
      <div class="form-group">
         <label for="">User Name</label>
         <input type="text" class="form-control" placeholder="User Name" name="username">
      </div>

      <div class="form-group">
         <label for="">First Name</label>
         <input type="text" class="form-control" placeholder="First Name" name="user_firstname">
      </div>

      <div class="form-group">
         <label for="">Last Name</label>
         <input type="text" class="form-control" placeholder="Last Name" name="user_lastname">
      </div>

      <div class="form-group">
         <label for="">User Email</label>
         <input type="email" class="form-control" placeholder="User Email" name="email">
      </div>

      <div class="form-group">
         <label for="">User Image</label>
         <input type="file" name="user_image" class="form-control">
      </div>

      <div class="form-group">
         <label for="">Password</label>
         <input type="password" class="form-control" name="password">
      </div>

      <div class="form-group">
         <label for="">Confirm Password</label>
         <input type="password" class="form-control" name="password_confirmation">
      </div>
   
      
   
      <button type="submit" class="btn btn-primary">Submit</button>
   </form>
</div>
@endsection