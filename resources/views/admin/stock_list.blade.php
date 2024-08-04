@extends('welcome')
@section('content')
<div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Manage Stock</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p>

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
                                            
                                            <th>Branch Name</th>
                                            <th>Product Count</th>
                                            <th>Request Count</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    
                                        <tr>
                                        <th>Branch Name</th>
                                            <th>Product Count</th>
                                            <th>Request Count</th>
                                            
                                        </tr>
                                    
                                    </tfoot>
                                    <tbody>
                                        @if (count($stocks) > 0)
                                        @foreach ($stocks as $cont)
                                        
                                        <tr>
                    
                    <th><a href="/admin/manage-stock/{{ $cont->id }}">{{ $cont->username }}</a></th>
                    <th>{{ $cont->productCount }}</th>
                    <th>{{ $cont->requestCount }}</th>
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