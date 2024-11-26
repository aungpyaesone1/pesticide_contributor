@extends('welcome')
@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    
</div>
@php
    $defaultStartDate = request('start_date') ? request('start_date') : \Carbon\Carbon::now()->startOfMonth()->toDateString();
    $defaultEndDate = request('end_date') ? request('end_date') : \Carbon\Carbon::now()->endOfMonth()->toDateString();
@endphp
<form action="{{ route('admindashboard') }}" method="GET">
    <div class="row">
        <div class="col-md-3">
        <select id="inputState" name="branch_id" class="form-control">
<option selected value="all">All</option>
@foreach($branchs as $item)
    <option value="{{$item->id}}" {{ $item->id == request('branch_id') ? 'selected' : '' }}>{{$item->username}}</option>
@endforeach
</select>
        </div>
        <div class="col-md-6">
        <label for="start_date">Start Date:</label>
    <input type="date" name="start_date" id="start_date" value="{{ $defaultStartDate }}">

    <label for="end_date">End Date:</label>
    <input type="date" name="end_date" id="end_date" value="{{ $defaultEndDate }}">

    <button class="btn btn-primary btn-sm" type="submit">Filter</button>
        </div>
    </div>
</form>
<br><br>
<!-- Content Row -->
<div class="row">

@foreach ($saleReport as $cont)
<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            {{$cont->name}}</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$cont->total_sales}} Kyats</div>
                    </div>
                    <div class="col-auto">
                        <span>{{$cont->total_quantity}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endforeach
@foreach ($productNotOrder as $cont)
<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            {{$cont->name}}</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">0 Kyats</div>
                    </div>
                    <div class="col-auto">
                        <span>0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endforeach
</div>

<!-- Content Row -->



</div>
@endsection