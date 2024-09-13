@extends('nav')
@section('content')
<head>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<style>
    .container {
        padding: 50px;
    }
    .mr-2{
  margin-right: 20px;
}

.divTable{
	display: table;
	width: 100%;
}
.rowTable {
	display: table-row;
}
.divTableHeading {
	display: table-header-group;
}
.divTableCol, .divTableHead {
	border-bottom: 1px solid #eee;
	display: table-cell;
	padding: 3px 10px;
}
.divTableHeading {
	background-color: #EEE;
	display: table-header-group;
	font-weight: bold;
}
.divTableFoot {
	background-color: #EEE;
	display: table-footer-group;
	font-weight: bold;
}
.divTableBody {
	display: table-row-group;
}

</style>

<div class="container">
@if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
<form action="{{ route('checkout') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal fade bd-example-modal-lg" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure to checkout?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
        <label for="inputAddress">Username</label>
        <input type="text" class="form-control" id="inputAddress" value="{{auth()->user()->username}}" disabled>
        
        </div>
        <div class="form-group">
        <label for="inputAddress">Phone</label>
        
        <input type="number" class="form-control" id="inputAddress" value="{{auth()->user()->phone}}" disabled>
        </div>
        <div class="form-group">
        <label for="inputAddress">Address</label>
        <input type="text" class="form-control" id="inputAddress" value="{{auth()->user()->address}}" disabled>
        </div>
        <div class="modal-footer">
        <a href="/user-profile" type="button" class="btn btn-secondary">Go profile</a>
        <button type="submit" class="btn btn-primary">Checkout</button>
      </div>
      </div>
      
    </div>
  </div>
</div>
    <div class="divTable div-hover">
        
            <div class="rowTable bg-primary text-white pb-5 custom">
                <div class="divTableCol">Product</div>
                <div class="divTableCol">Authorized</div>
                <div class="divTableCol">Quantity</div>
                <div class="divTableCol">Price</div>
                <div class="divTableCol">Total</div>
                <div class="divTableCol">Actions</div>
            </div>
            @foreach ($cards as $index => $cont)
            <div class="rowTable">
                
                <div class="divTableCol">
                    <div class="media">
                        <a class=" pull-left mr-2 ml-0" href="#"> <img class="img-fluid" src="{{$cont->image}}" style="width: 92px; height: 72px; margin-left: 0" /></a>
                        <div class="media-body">
                        <h5 class="media-heading"><a href="#">{{$cont->name}}</a></h5>
                        <h6 class="media-heading">via {{$cont->branchName}}</h6>
                            
                        </div>
                    </div>
                </div>
                <div class="divTableCol"><strong class="label label-warning"></strong></div>
                <div class="divTableCol">
                    <input type="hidden" name="products[{{$index}}][id]" value="{{$cont->id}}"> 
                    <input type="text" class="form-control" name="products[{{$index}}][quantity]" id="exampleInputEmail1" value="{{$cont->count}}" />
                </div>
                <div class="divTableCol"><strong>{{$cont->price}} Kyats</strong></div>
                <input type="hidden" name="products[{{$index}}][price]" value="{{$cont->price}}"> 
                <div class="divTableCol"><strong>{{$cont->total_price}}</strong></div>
                <div class="divTableCol">
                    <button type="button" class="btn btn-danger"><span class="fa fa-remove"></span><a href="/remove-item/{{$cont->id}}">Remove</a></button>
                </div>
            </div>
            @endforeach
            
            <div class="rowTable">
                <div class="divTableCol"></div>
                <div class="divTableCol"></div>
                <div class="divTableCol"></div>
                <div class="divTableCol"><h3>Total</h3></div>
                <div class="divTableCol">
                    <input type="hidden" value="{{$total}}" name="total_price">
                    <input type="hidden" value="{{$branch_id}}" name="branch_id">
                    <h3><strong>{{$total}}</strong></h3>
                </div>
                <div class="divTableCol">
                    <a class="btn btn-primary" data-toggle="modal" data-target="#confirmModal">Checkout</a>
                </div>
            </div> 
            
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