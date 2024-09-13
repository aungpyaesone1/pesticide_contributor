@extends('welcome')
@section('content')
<div class="container-fluid">
<h1 class="h3 mb-2 text-gray-800">Manage Stock</h1>
    <div class="container-fluid">
    
<form action="{{ route('add-stock') }}" method="post" enctype="multipart/form-data">
@csrf
</div>
<div class="form-group col-md-6">
<label for="inputPassword4">Branch Name</label>
<input type="hidden" name="branchId" value="{{$branch->id}}">
<input type="text" name="branchId" class="form-control" id="inputPassword4" value="{{$branch->username}}" disabled>
</div>
<div class="form-group col-md-6">
<label for="multi-select">Select Products</label>
        <select id="multi-select" name="productIds[]" multiple="multiple" style="width: 100%;" class="form-control">
            @foreach($options as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
</div>
<a href="/admin/stock" class="btn btn-secondary">Cancel</a>
<button type="submit" class="btn btn-primary">Add</button>
<form>
</div>
<br/>
<div class="container-fluid"> 
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
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
                                        <tr>
                                        <th>{{$cont->category_name}}</th>
                                        <th>{{ $cont->product_name }}</th>
                                        <th>{{ $cont->stock_level }}</th>
                                        <th>
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                {{$cont->request_count}}
                                                </div>
                                                <div class="form-group col-md-3">
                                            @if($cont->request_count != 0) 
                                                <button type="button" data-toggle="modal" data-target="#acceptModal-{{ $cont->id }}" class="btn btn-primary btn-sm" >Accept</button>
                                                <!-- Modal -->
<div class="modal fade" id="acceptModal-{{$cont->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Stock Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
      <form action="{{ route('accept-request') }}" method="post" id="#{{$cont->id}}">
        @csrf
        <input type="hidden" name="stockId" value="{{$cont->id}}">
        Are you sure to approve the request?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Ok</button>
      </div>
      </form>
    </div>
  </div>
</div>

                                            
                                            @endif
                                            </form>
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

@endsection
