@extends('welcome')
@section('content')
<div class="container-fluid">
@if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Manage Post</h1>
                    <p class="mb-4"></p>
                            <button class="btn btn-primary pull-right" onclick="window.location='/admin/create-post'">Create</button>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Post List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Picture</th>
                                            <th>Id</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>Picture</th>
                                            <th>Id</th>
                                            <th>Title</th>
                                            <th>description</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    @if (count($posts) > 0)
                                        @foreach ($posts as $cont)
                                        <tr>
                                        <th><img src="{{$cont->image}}" style="width:100px;height:100px;border:1px solid gray;border-radius:5px;"></th>
                                        <th>{{$cont->id}}</th>
                                        <th><a href="/admin/post/{{ $cont->id }}">{{ $cont->title }}</a></th>
                                        <th>{{ $cont->description }}</th>
                                        <th><button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#acceptModal-{{ $cont->id }}">Delete</button></th>
                                        </tr>
                                        <div class="modal fade" id="acceptModal-{{$cont->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
      <form action="{{ route('deletepost') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$cont->id}}">
        Are you sure to delete the post?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Ok</button>
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
