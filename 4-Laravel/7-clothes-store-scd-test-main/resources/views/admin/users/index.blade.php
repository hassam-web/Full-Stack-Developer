@extends('admin.layout.app')


@section('content')
<div id="page-wrapper">

    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session()->get('success') }}
        </div>
    @endif

 <div class="container-fluid">
            <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Users
            </h1>
        </div>
    </div>
    
<?php if ( count($users) > 0): ?>
    
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $key => $user): ?>
            <tr>
                <td>{{ $key + 1}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
            </tr>               
            <?php endforeach ?>
        </tbody>
    </table>
<?php else: ?>
    <h2>No records found!</h2>
<?php endif ?>
</div>
@endsection