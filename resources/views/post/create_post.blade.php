@extends('welcome')
@section('content')
<div class = "container">
  <h3>Create Post</h3>
  <form action="{{ route('post') }}" method="post" enctype="multipart/form-data">
@csrf
<div class="form-row">
<div class="form-group col-md-4">
<label for="inputEmail4">File</label>
<input type="file" name="image" id="inputEmail4">
</div>
</div>
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail4">Title</label>
<input type="text" name="title" class="form-control" id="inputEmail4" placeholder="Title">
</div>
</div>

<div class="form-group">
<label for="inputAddress">Description</label>
<textarea style="height:300px;" type="text" name="description" class="form-control" id="inputAddress"></textarea>
</div>

<a href="/admin/post" class="btn btn-secondary">Cancel</a>
<button type="submit" class="btn btn-primary">Create</button>
</form>
    </div>
@endsection