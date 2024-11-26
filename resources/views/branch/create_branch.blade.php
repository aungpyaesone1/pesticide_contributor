@extends('welcome')
@section('content')
<div class = "container">
  <h3>Create Branch</h3>
<form action="{{ route('branch') }}" method="post" enctype="multipart/form-data">
@csrf
<div class="form-row">
<div class="form-group col-md-4">
<label for="inputEmail4">File</label>
<input type="file" name="image" id="inputEmail4" required>
</div>
</div>
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail4">Username</label>
<input type="text" name="username" class="form-control" id="inputEmail4" placeholder="Username" required>
</div>
<div class="form-group col-md-6">
<label for="inputPassword4">Password</label>
<input type="password" name="password" class="form-control" id="inputPassword4" placeholder="Password" required>
</div>
</div>
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail4">Phone</label>
<input type="text" name="phone" class="form-control" id="inputEmail4" placeholder="Phone" required>
</div>
<div class="form-group col-md-6">
<label for="inputPassword4">Address</label>
<input type="text" name="address" class="form-control" id="inputPassword4" placeholder="Address" required>
</div>
</div>
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputPassword4">Email</label>
<input type="text" name="email" class="form-control" id="inputPassword4" placeholder="Email" required>
</div>
</div>
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail4">Latitude</label>
<input type="text" name="latitude" class="form-control" id="inputEmail4" placeholder="Latitude">
</div>
<div class="form-group col-md-6">
<label for="inputPassword4">Longitude</label>
<input type="text" name="longitude" class="form-control" id="inputPassword4" placeholder="Longitude">
</div>
</div>

<div class="form-row">
<div class="form-group col-md-6">
<label for="inputState">Township</label>
<select id="inputState" name="townshipId" class="form-control" required>
<option selected>Choose...</option>
@foreach($townships as $item)
    <option value="{{$item->id}}">{{$item->name}}</option>
@endforeach
</select>
</div>
<div class="form-group col-md-6">
<label for="inputCity">City</label>
<select id="inputState" name="cityId" class="form-control" required>
<option selected>Choose...</option>
@foreach($citys as $item)
    <option value="{{$item->id}}">{{$item->name}}</option>
@endforeach
</select>
</div>

</div>



<a href="/admin/branch" class="btn btn-secondary">Cancel</a>
<button type="submit" class="btn btn-primary">Create</button>
</form>
    </div>
@endsection