@extends('welcome')
@section('content')
<div class="container-fluid">
<h1 class="h3 mb-2 text-gray-800">Manage Stock</h1>



<br/>
<div class="container-fluid"> 
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Stock List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            
                                            <th>Category</th>
                                            <th>Product</th>
                                            <th>Stock Level</th>
                                            <th>Request Stock</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        
                                            <th>Category</th>
                                            <th>Product</th>
                                            <th>Stock Level</th>
                                            <th>Request Stock</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    @if (count($stocks) > 0)
                                        @foreach ($stocks as $cont)
                                        <tr data-toggle="modal" data-target="#requestModal-{{ $cont->id }}" style="color:{{ $cont->stock_level < 10 ? 'red' : 'green' }}">
                                        <th>{{$cont->category_name}}</th>
                                        <th>{{ $cont->product_name }}</th>
                                        <th>{{ $cont->stock_level }}</th>
                                        <th>
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                {{$cont->request_count}}
                                                </div>
                                                <div class="form-group col-md-3">
            
                                                </div>
                                            </div>
                                        </th>
                                        </tr>

                                        <!-- Modal -->
<div class="modal fade" id="requestModal-{{ $cont->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">You can request the stock when the stock level is under 10.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{ route('request-stock') }}" method="post">
        @csrf
        <div class="form-group">
        <label for="inputAddress">Product</label>
        <input type="text" class="form-control" id="inputAddress" value="{{$cont->product_name}}" disabled>
        <input type="hidden" name="id" value="{{$cont->id}}">
        </div>
        <div class="form-group">
        <label for="inputAddress">Stock Level</label>
        @if($cont->stock_level < 10)
        <h6>Your stock level is low, please request stock!!!</h6>
        @endif
        <input type="number" class="form-control" id="inputAddress" value="{{$cont->stock_level}}" disabled>
        </div>
        <div class="form-group">
        <label for="inputAddress">Request stock</label>
        <input type="number" class="form-control" id="inputAddress" name="requestStock" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" {{ $cont->stock_level < 10 ? '' : 'disabled' }}>Request</button>
      </div>
</form>
    </div>
  </div>
</div>
                    
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

@endsection
