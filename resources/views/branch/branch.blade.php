@extends('welcome')
@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Manage Branch</h1>
                    <p class="mb-4"></p>
                    <button class="btn btn-primary pull-right" onclick="window.location='/admin/create-branch'">Create</button>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Branch List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th>Picture</th>
                                            <th>Username</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>Township</th>
                                            <th>Start Date</th>
                                            <th>Action</th>
                                    
        
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    
                                        <tr>
                                        <th>Picture</th>
                                            <th>Username</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>Township</th>
                                            <th>Start Date</th>
                                            <th>Action</th>
                                        </tr>
                                    
                                    </tfoot>
                                    <tbody>
                                        @if (count($branchs) > 0)
                                        @foreach ($branchs as $cont)
                                        
                                        <tr>
                                        <th><img src="{{$cont->image}}" style="width:100px;height:100px;border:1px solid gray;border-radius:5px;"></th>
                    <th><a href="/admin/branch/{{ $cont->id }}">{{ $cont->username }}</a></th>
                    <th>{{ $cont->phone }}</th>
                    <th>{{ $cont->address }}</th>
                    <th>{{$cont->cityName}}</th>
                    <th>{{$cont->townshipName}}</th>
                    <th>{{$cont->created_at}}</th>
                    <th><button class="btn btn-sm btn-danger">Delete</button></th>
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