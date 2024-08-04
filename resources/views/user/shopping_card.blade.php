@extends('nav')
@section('content')
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
<form action="{{ route('checkout') }}" method="post" enctype="multipart/form-data">
                @csrf
    <div class="divTable div-hover">
        
            <div class="rowTable bg-primary text-white pb-2" style="border-radius:10px;">
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
                        <div class="media-body">
                            <h4 class="media-heading"><a href="#">{{$cont->name}}</a></h4>
                            <h5 class="media-heading">via {{$cont->branchName}}</h5>
                            <span>Status: </span><span class="text-warning"><strong>Pending request</strong></span>
                        </div>
                    </div>
                </div>
                <div class="divTableCol"><strong class="label label-warning">Pending</strong></div>
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
                <div class="divTableCol"><h5>Subtotal</h5></div>
                <div class="divTableCol">
                    <h5><strong>€570.00</strong></h5>
                </div>
            </div>
            <div class="rowTable">
                <div class="divTableCol"></div>
                <div class="divTableCol"></div>
                <div class="divTableCol"></div>
                <div class="divTableCol"><h5>Prezzo totale</h5></div>
                <div class="divTableCol">
                    <h5><strong>€570.00</strong></h5>
                </div>
            </div>
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
                    <button class="btn btn-primary" type="submit">Checkout</button>
                </div>
            </div> 
            
        </form>
    </div>
</div>
@endsection