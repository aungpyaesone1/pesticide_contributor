@extends('nav')
@section('content')
<style>
    .track-line {
height: 2px !important;
background-color: #488978;
opacity: 1;
}

.dot {
height: 7px;
width: 7px;
margin-left: 3px;
margin-right: 3px;
margin-top: 0px;
background-color: #488978;
border-radius: 50%;
display: inline-block
}

.big-dot {
height: 20px;
width: 20px;
margin-left: 0px;
margin-right: 0px;
margin-top: 0px;
background-color: #488978;
border-radius: 50%;
display: inline-block;
}

.big-dot i {
font-size: 8px;
}

.card-stepper {
z-index: 0
}
.fw-normal {
    font-size:14px;
}
.text-muted {
    font-size:12px;
}
.track-text {
    font-size: 12px;
}

@media (min-width: 1025px) {
.h-custom {
height: 100vh !important;
}
}

.card-registration .select-input.form-control[readonly]:not([disabled]) {
font-size: 1rem;
line-height: 2.15;
padding-left: .75em;
padding-right: .75em;
}

.card-registration .select-arrow {
top: 13px;
}
</style>
<section class="" style="background-color: #eee;">
  <div class="container py-5 h-10">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card card-stepper" style="border-radius: 10px;">
          <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex flex-column">
                <span class="lead fw-normal">Your order has been
                    @if($order->orderStatus == 1)
                     not confirmed
                    @elseif($order->orderStatus == 2)
                     confirmed
                    @elseif($order->orderStatus == 3)
                     delivered
                    @else
                     paid
                    @endif
                </span>
                <span class="text-muted small">on {{$order->updated_at}}</span>
              </div>
              @if($order->orderStatus == 1)
              <div>
                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary" type="button">Cancel</button>
              </div>
              @endif
              
            </div>
            <hr class="my-3">

            <div class="d-flex flex-row justify-content-between align-items-center align-content-center">
              
              @if($order->orderStatus == 1)
              <span
                class="d-flex justify-content-center align-items-center big-dot dot">
                <i class="fa fa-check text-white"></i></span>
              @else
              <span class="dot"></span>
              @endif 
              @if($order->orderStatus == 2)
              <span
                class="d-flex justify-content-center align-items-center big-dot dot">
                <i class="fa fa-check text-white"></i></span>
              @else
              <hr class="flex-fill track-line"><span class="dot"></span>
              @endif
              @if($order->orderStatus == 3)
              <hr class="flex-fill track-line"><span
                class="d-flex justify-content-center align-items-center big-dot dot">
                <i class="fa fa-check text-white"></i></span>
              @else
              <hr class="flex-fill track-line"><span class="dot"></span>
              @endif
              @if($order->orderStatus == 4)
              <hr class="flex-fill track-line"><span
                class="d-flex justify-content-center align-items-center big-dot dot">
                <i class="fa fa-check text-white"></i></span>
              @else
              <hr class="flex-fill track-line"><span class="dot"></span>
              @endif
              
            </div>

            <div class="d-flex flex-row justify-content-between align-items-center track-text">
              <div class="d-flex flex-column align-items-start"><span>{{$order->created_at}}</span><span>Order placed</span>
              </div>
              <div class="d-flex flex-column justify-content-center">
              @if($order->orderStatus == 2)
              <span>{{$order->updated_at}}</span>
              @endif
              <span>Order confirmed</span></div>
              <div class="d-flex flex-column justify-content-center align-items-center">
              @if($order->orderStatus == 3)
              <span>{{$order->updated_at}}</span>
              @endif
                <span>Order delivered</span>
              </div>
              <div class="d-flex flex-column align-items-end">
              @if($order->orderStatus == 4)
              <span>{{$order->updated_at}}</span>
              @endif
                <span>Order Paid</span></div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container py-0 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="fw-bold mb-0">Shopping Cart</h1>
                    <h6 class="mb-0 text-muted">3 items</h6>
                  </div>
                  <hr class="my-4">
                  @foreach($order_items as $cont)
                  <div class="row mb-4 d-flex justify-content-between align-items-center">
                    <div class="col-md-2 col-lg-2 col-xl-2">
                      <img
                        src="{{$cont->image}}"
                        class="img-fluid rounded-3" alt="Cotton T-shirt">
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3">
                      <h6 class="text-muted">{{$cont->category}}</h6>
                      <h6 class="mb-0">{{$cont->name}}</h6>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                      <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                        <i class="fas fa-minus"></i>
                      </button>

                      <input id="form1" min="0" name="quantity" value="{{$cont->count}}" type="number"
                        class="form-control form-control-sm" />

                      <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                        <i class="fas fa-plus"></i>
                      </button>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                      <h6 class="mb-0">{{$cont->price}} Kyats</h6>
                    </div>
                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                      <a href="#!" class="text-muted"><i class="fas fa-times"></i></a>
                    </div>
                  </div>
                  
                  <hr class="my-4">
                  @endforeach
                


                  <div class="pt-5">
                    <h6 class="mb-0"><a href="/orders" class="text-body"><i
                          class="fas fa-long-arrow-alt-left me-2"></i>Back to order</a></h6>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 bg-body-tertiary">
                <div class="p-5">
                  <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                  <hr class="my-4">

                  <div class="d-flex justify-content-between mb-4">
                    <h5 class="text-uppercase">items {{$item_count->item_count}}</h5>
                    <h5>{{$order->total_price}} Kyats</h5>
                  </div>

                  <h5 class="text-uppercase mb-3">Shipping</h5>

                  <div class="mb-4 pb-2">
                    <select data-mdb-select-init>
                      <option value="1">Standard-Delivery</option>
                    </select>
                  </div>
                  <hr class="my-4">

                  <div class="d-flex justify-content-between mb-5">
                    <h5 class="text-uppercase">Total price</h5>
                    <h5>{{$order->total_price}} Kyats</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection