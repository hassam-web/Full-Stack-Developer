<!DOCTYPE html>
<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Shopping Cart </title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>

<body>

    <div class="container">


        <div class="container page">
         
            <table id="cart" class="table table-hover table-condensed">
                <thead>

                    <tr>
                        <td>Image</td>
                        <td>Name</td>
                        <td>Description</td>
                        <td>Price</td>
                        <td>Delete</td>
                    </tr>
                </thead>
                <tbody>
                    @if(count($carts) > 0)
                        @foreach ($carts as $item)
                        <tr>
                            <td><img src="{{ $item->image }}" alt="" width="100"></td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->price }}</td>
                            <td><a href="{{ route('deletecartitem', $item->id) }}" class="btn btn-danger"
                                    onclick="return confirm('Are you Sure!')";><i class="fa fa-trash"></i></a></td>
                        </tr>
                    @endforeach
                   
                </tbody>
<tfoot>
    <tr>
        <td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i>
                Continue Shopping</a></td>
                
        <td colspan="2" class="hidden-xs"></td>
        <td class="hidden-xs text-center"><strong>Total:${{ $total }}</strong></td>
        <form action="{{ route('check_out') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{ $item->id }}" name="id">
            {{-- <input type="hidden" value="{{ $user->username }}" name="id"> --}}
            <input type="hidden" value="{{ $item->product_category_id }}" name="product_category_id">
            <input type="hidden" value="{{ $item->name }}" name="name">
            <input type="hidden" value="{{ $item->description }}" name="description">
            <input type="hidden" value="{{ $item->price }}" name="price">
            <input type="hidden" value="{{ $item->image }}" name="image">
            <td><button class="btn btn-warning"><i class="fa fa-angle-left"></i> Checkt Out</button></td>
        </form>
        
    </tr>
    
</tfoot>

            </table>
            @else
            <h3><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i>
                Continue Shopping</a></h3>
            @endif
          
        </div>


</body>

</html>