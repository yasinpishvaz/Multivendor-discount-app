@extends('layouts.app')

@section('title')  کارت @endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <strong>{{ $errors->first() }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif



    <div class="row">
        <div class="container-fluid page text-center col-md-7 px-5">
            <table id="cart" class="table table-hover table-condensed">
                <tbody>
                    <?php $total = 0; ?>

                    @if (session('cart'))
                        @foreach (session('cart') as $id => $details)
                            <?php $total += $details['discount'] * $details['quantity']; ?>

                            <tr>
                                <td data-th="محصول">
                                    <div class="row">
                                        <div class="d-none d-sm-block col-sm-6  cart-detail-img"><img
                                                src="/storage/uploads/products/images/{{ $details['image'] }}" alt=""
                                                class="img-responsive" /></div>
                                        <div class="col-sm-3 my-auto">
                                            <h6 class="nomargin">{{ $details['title'] }} </h6>
                                        </div>
                                    </div>
                                </td>
                                <td data-th="تعداد">
                                    <input type="number" class="form-control text-center quantity"
                                        value="{{ $details['quantity'] }}">
                                </td>

                                <td data-th=" قیمت ">{{ $details['discount'] }}</td>
                                <td class="actions" data-th="">
                                    <button class="btn btn-info btn-sm update-cart-item" data-id="{{ $id }}"><i
                                            class="fa fa-refresh"></i></button>
                                    <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i
                                            class="fa fa-trash-o"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>

                <tfoot>
                    <tr>
                        <td class="text-left"><a href="{{ url('/') }}" class="btn btn-warning"> ادامه
                                خرید <i class="fa fa-angle-left"></i></a></td>
                        <td colspan="2" class="hidden-xs"></td>

                    </tr>
                </tfoot>
            </table>

        </div>



        <div class="container-fluid page text-center col-md-3">

            @if (session()->has('cart'))
                <div class="purchase-box">
                    <div class="card align-middle">

                        <div class="product-bottom-box">
                            <div class="product-right-box ml-4 py-5">
                                مبلغ قابل پرداخت
                            </div>

                            <div class="product-left-box">
                                <div class="price">
                                    {{ $total }} تومان
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <p class="btn-holder"><a href="{{ url('/bill/pay_test') }}"
                        onclick="event.preventDefault();document.getElementById('pay_test').submit();"
                        class="btn btn-success btn-block text-center add-to-cart" role="button"> تایید و پرداخت </a> </p>
            @else
                <div class="purchase-box">
                    <div class="card align-middle">
                        <div class="product-bottom-box">
                            <div class="product-right-box ml-4 py-2">
                                سبد خرید شما خالی است
                            </div>
                        </div>
                    </div>
                </div>

                <p class="btn-holder"><a href="{{ url('/') }}"
                        class="btn btn-success btn-block text-center add-to-cart" role="button">بازگشت به صفحه اصلی سایت
                    </a>
                </p>
            @endif


            <form id="pay_test" action="{{ route('pay_test') }}" method="POST" class="d-none">
                @csrf
            </form>

        </div>

    </div>
@endsection



@push('scripts')
    <script type="text/javascript">
        $('.update-cart-item').click(function(e) {
            e.preventDefault();
            var ele = $(this);
            $.ajax({
                url: '{{ url('cart/update-cart-item') }}',
                method: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.attr('data-id'),
                    quantity: ele.parents('tr').find('.quantity').val()
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });


        $('.remove-from-cart').click(function(e) {
            e.preventDefault();
            var ele = $(this);
            if (confirm('are you sure??')) {
                $.ajax({
                    url: '{{ url('cart/remove-from-cart') }}',
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.attr('data-id')
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }
        });

    </script>
@endpush
