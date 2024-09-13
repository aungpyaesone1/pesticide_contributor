@extends('welcome')
@section('content')
<div class="container-fluid">
@if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif
<h1 class="h3 mb-2 text-gray-800">Manage Order</h1>



<br/>
<div class="container-fluid"> 
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Order List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer</th>
                                            <th>Date</th>
                                            <th>Total Price</th>
                                            <th>Status</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer</th>
                                            <th>Date</th>
                                            <th>Total Price</th>
                                            <th>Status</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    @if (count($orders) > 0)
                                        @foreach ($orders as $cont)
                                        
                                        <tr data-toggle="modal" style="color:{{ $cont->status == 4 ? 'green' : '' }}">
                                        <th><a href="/branch-user/order-detail/{{ $cont->id }}">{{$cont->id}}</a></th>
                                        <th>{{$cont->username}}</th>
                                        <th>{{ $cont->created_at }}</th>
                                        <th>{{$cont->total_price}}</th>
                                        <th>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                @if($cont->status == 1)
                                                    Not Confirmed
                                                @elseif($cont->status == 2)
                                                    Confirmed
                                                @elseif($cont->status == 3)
                                                    Delivered
                                                @else($cont->status == 4)
                                                    Paid
                                                @endif
                                                </div>
                                
                                            </div>
                                        </th>
                                        </tr>
                                        
                                        @endforeach
                                    
                                    @else
                                        <tr>
                                            <th>No Data</th>
                                        </tr>
                                    @endif
                                
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

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
