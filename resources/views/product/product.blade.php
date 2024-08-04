@extends('welcome')
@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Product</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p>
                            <button class="btn btn-primary pull-right" onclick="window.location='/admin/create-product'">Create</button>

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
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Category</th> 
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Category</th> 
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    @if (count($products) > 0)
                                        @foreach ($products as $cont)
                                        <tr>
                                        <th>{{$cont->id}}</th>
                                        <th><a href="/admin/product/{{ $cont->id }}">{{ $cont->name }}</a></th>
                    <th>{{ $cont->price }}</th>
                    <th>{{$cont->categoryName}}</th>
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