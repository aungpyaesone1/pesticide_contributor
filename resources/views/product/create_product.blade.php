@extends('welcome')
@section('content')
<div class = "container">
  <h3>Create Product</h3>
  <form action="{{ route('product') }}" method="post" enctype="multipart/form-data">
@csrf
<div class="form-row">
<div class="form-group col-md-4">
<label for="inputEmail4">File</label>
<input type="file" name="image" id="inputEmail4">
</div>
</div>
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail4">Name</label>
<input type="text" name="name" class="form-control" id="inputEmail4" placeholder="Product name">
</div>
<div class="form-group col-md-6">
<label for="inputPassword4">Price</label>
<input type="text" name="price" class="form-control" id="inputPassword4" placeholder="Price">
</div>
</div>

<div class="form-row">
<div class="form-group col-md-6">
<label for="inputState">Category</label>
<select id="inputState" name="categoryId" class="form-control">
<option selected>Choose...</option>
@foreach($categories as $item)
    <option value="{{$item->id}}">{{$item->name}}</option>
@endforeach
</select>
</div>
</div>

<div class="form-group">
<label for="inputAddress">Description</label>
<textarea type="text" name="description" class="form-control" id="inputAddress"></textarea>
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
<a href="/admin/product" class="btn btn-secondary">Cancel</a>
</form>
    </div>
@endsection