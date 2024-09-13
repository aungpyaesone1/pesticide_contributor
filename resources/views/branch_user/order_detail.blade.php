@extends('welcome')
@section('content')
<div class = "container">
@if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
  <h3>Order Detail</h3>
<form action="{{ route('update-order') }}" method="post">
@csrf
<input type="hidden" value="{{$order->order_id}}" name="orderId">
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail4">Customer Name</label>
<input type="text" name="username" class="form-control form-custom" id="inputEmail4" value="{{$order->username}}">
</div>
<div class="form-group col-md-6">
<label for="inputPassword4">Address</label>
<input type="text" name="password" class="form-control form-custom" id="inputPassword4" value="{{$order->address}}">
</div>
</div>
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail4">Phone</label>
<input type="text" name="phone" class="form-control form-custom" id="inputEmail4" value="{{$order->phone}}">
</div>
<div class="form-group col-md-6">
<label for="inputPassword4">Order Date</label>
<input type="text" name="address" class="form-control form-custom" id="inputPassword4" value="{{$order->created_at}}">
</div>
</div>
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail4">Total Price</label>
<input type="text" name="phone" class="form-control form-custom" id="inputEmail4" value="{{$order->total_price}}">
</div>
<div class="form-group col-md-6">
<label for="inputPassword4">Status</label>
<select id="inputState" name="status" class="form-control">
<option selected>Choose...</option>
    <option value="1" {{ $order->orderStatus == 1 ? 'selected' : '' }}>Not Confirmed</option>
    <option value="2" {{ $order->orderStatus == 2 ? 'selected' : '' }}>Confirmed</option>
    <option value="3" {{ $order->orderStatus == 3 ? 'selected' : '' }}>Delivered</option>
    <option value="4" {{ $order->orderStatus == 4 ? 'selected' : '' }}>Paid</option>

</select>
</div>
</div>
<button type="submit" class="btn btn-primary">Update</button>
</form>
<section class="h-100 h-custom" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card">
          <div class="card-body p-4">

            <div class="row">

              <div class="col-lg-12">

                <div class="d-flex justify-content-between align-items-center mb-4">
                  <div>
                    <p class="mb-1">Order Items</p>
                    <p class="mb-0">Order has {{ $item_count->item_count }} items.</p>
                  </div>
                  <div>
                    <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!"
                        class="text-body">price <i class="fas fa-angle-down mt-1"></i></a></p>
                  </div>
                </div>
                @foreach ($order_items as $index => $cont)
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div class="d-flex flex-row align-items-center">
                        <div>
                          <img
                            src="{{$cont->image}}"
                            class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                        </div>
                        <div class="ms-3">
                          <h5>{{$cont->name}}</h5>
                          <p class="small mb-0">{{$cont->category}}</p>
                        </div>
                      </div>
                      <div class="d-flex flex-row align-items-center">
                        <div style="width: 50px;">
                          <h5 class="fw-normal mb-0">{{$cont->count}}</h5>
                        </div>
                        <div style="width: 80px;">
                          <h5 class="mb-0">{{$cont->price}} Kyats</h5>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach

              </div>
              

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
<script>
    // This script will automatically close the alert after 5 seconds
    setTimeout(function() {
        let alert = document.querySelector('.alert');
        if (alert) {
            let bootstrapAlert = new bootstrap.Alert(alert);
            bootstrapAlert.close();
        }
    }, 5000); // 5000 milliseconds = 5 seconds
</script>
@endsection