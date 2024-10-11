@extends('nav')
@section('content')
<div style="padding-bottom:225px;border:0px solid red;">
<div class="container">
@if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
  <table id="cart" class="table table-hover table-condensed">
    <thead>
      <tr>
        <th>Order ID</th>
        <th>Date</th>
        <th>Total Item</th>
        <th>Total Price</th>
        <th>Status</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    @if (count($orders) > 0)
      @foreach ($orders as $cont)
      <tr>
        <td data-th="Product">
          <div class="row">
          <a href="order-detail/{{ $cont->id }}">
            {{$cont->id}}
          </a>
          </div>
        </td>
        <td data-th="Price">{{$cont->created_at}}</td>
        <td data-th="Quantity">
          {{$cont->itemCount}}
        </td>
        <td data-th="Subtotal">{{$cont->total_price}}</td>
        <td data-th="Subtotal">
          
          @if($cont->status == 1)
          Not Confirmed
          @elseif($cont->status == 2)
          Confirmed
          @elseif($cont->status == 3)
          Delivered
          @else
          Paid
          @endif

        </td>
        <td class="actions" data-th="">
          <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
          
        </td>
      </tr>
      @endforeach
    @endif
      
    </tbody>
  </table>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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