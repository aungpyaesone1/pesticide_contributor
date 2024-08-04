@extends('welcome')
@section('content')
<div class = "container">
  <h3>Update Post</h3>
  <form action="{{ route('updatepost') }}" method="post" enctype="multipart/form-data">
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
<input type="text" name="title" class="form-control" id="inputEmail4" placeholder="Title" value="{{$post->title}}">
</div>
</div>

<div class="form-group">
<label for="inputAddress">Description</label>
<textarea type="text" name="description" class="form-control" id="inputAddress">{{$post->description}}</textarea>
</div>
<div class="form-group">
<div class="form-check">
<input class="form-check-input" type="checkbox" id="gridCheck">
<label class="form-check-label" for="gridCheck">
Check me out
</label>
</div>
</div>
<button type="submit" class="btn btn-primary">Create</button>
<a href="/admin/post" class="btn btn-secondary">Cancel</a>
</form>
    </div>
@endsection