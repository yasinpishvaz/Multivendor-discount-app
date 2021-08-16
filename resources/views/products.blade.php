@extends('layout')

@section('title', 'Products')

@section('content')

    <div class="container products">
        <span id="status"></span>
        <div class="row">
            @foreach ($product_items as $product)   
            <div class="col-xs-18 col-sm-6 col-md-3">
                <div class="thumbnail">
                    @if($product->ProductMetas[0]->key === 'img') 
                    <?php $imageaddress = URL::asset($product->ProductMetas[0]->value); ?>
                    <img src="{{$imageaddress}}" alt="">
                    @else 
                    <img src="http://placehold.it/500x300" alt="">
                    @endif
                    <div class="caption">
                        <h4>{{$product->name}}</h4>
                        <p>{{$product->description}}</p>
                        <p><strong>Price: </strong> {{$product->price}}$</p>
                        <p class="btn-holder"><a href="{{url('add-to-cart/'.$product->id)}}" class="btn btn-warning btn-block text-center add-to-cart" data-id="{{$product->id}}" role="button">Add to cart</a> </p>
                    </div>
                </div>
            </div>
            @endforeach

        </div><!-- End row -->
    </div>

@endsection

@section('scripts')

     <script type="text/javascript">
         $('.add-to-cart').click(function (e) {
             e.preventDefault();
             var ele = $(this);

             $.ajax({
                 url: '{{ url('add-to-cart') }}' + '/' + ele.attr('data-id'),
                 method: 'get',
                 data: {_token: '{{ csrf_token() }}'},
                 dataType: 'json',
                 success: function (response) {
                    $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');
                    $("#header-bar").html(response.data);
                 }
             });
         });



     </script>
@stop