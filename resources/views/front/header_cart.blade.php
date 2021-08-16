       <div class="col-lg-12 col-sm-12 col-12 main-section">
           <div class="dropdown float-none">
               <button type="button" class="btn" data-toggle="dropdown">
                   <i class="fa fa-shopping-cart fa-flip-horizontal fa-lg" aria-hidden="true">
                   </i><span class="badge badge-pill badge-success">{{ count((array) session('cart')) }}</span>
               </button>
               <div class="dropdown-menu right">
                   <div class="row total-header-section">

                       <?php $total = 0; ?>
                       @foreach ((array) session('cart') as $id => $details)
                           <?php $total += $details['quantity'] * $details['discount']; ?>
                       @endforeach

                       <div class="col-lg-12 col-sm-12 col-12 total-section text-right">
                           <p>مبلغ قابل پرداخت: <span class="text-info">{{ $total }}</span></p>
                       </div>
                   </div>

                   @if (session('cart'))
                       @foreach (session('cart') as $id => $details)
                           <div class="row cart-detail">
                               <div class="col-lg-6 col-sm-6 col-6 cart-detail-img">
                                   <img src="/storage/uploads/products/images/{{ $details['image'] }}">
                               </div>
                               <div class="col-lg-6 col-sm-6 col-6 cart-detail-product text-right">
                                   <p>{{ $details['title'] }}</p>
                                   <span class="discount text-info"> {{ $details['discount'] }}</span>
                               </div>
                           </div>
                       @endforeach
                   @endif


                   <div class="row">
                       <div class="col-12 col-lg-12 col-sm-12 text-center checkout">
                           <a href="{{ url('cart') }}" class="btn btn-success btn-block">تسویه و پرداخت </a>
                       </div>
                   </div>
               </div>
           </div>
       </div>
