@extends('welcome')
@section('content')
<div class = "container">
  <h3>Update Branch</h3>
<form action="{{ route('updatebranch') }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="form-row">
<div class="form-group col-md-4">
<label for="inputEmail4">File</label>
<input type="file" name="image" id="inputEmail4">
<input type="hidden" name="id" value="{{$branch->id}}">
</div>
</div>
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail4">Username</label>
<input type="text" class="form-control" id="inputEmail4" name="username" placeholder="Username" value="{{$branch->username}}">
</div>
<div class="form-group col-md-6">
<label for="inputPassword4">Password</label>
<input type="password" class="form-control" name="password" id="inputPassword4" placeholder="*****">
</div>
</div>
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail4">Phone</label>
<input type="text" class="form-control" id="inputEmail4" name="phone" placeholder="Phone" value="{{$branch->phone}}">
</div>
<div class="form-group col-md-6">
<label for="inputPassword4">Address</label>
<input type="text" class="form-control" id="inputPassword4" name="address" placeholder="Address" value="{{$branch->address}}">
</div>
</div>
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail4">Latitude</label>
<input type="text" class="form-control" id="inputEmail4" name="latitude" placeholder="Latitude" value="{{$branch->latitude}}">
</div>
<div class="form-group col-md-6">
<label for="inputPassword4">Longitude</label>
<input type="text" class="form-control" id="inputPassword4" name="longitude" placeholder="Longitude" value="{{$branch->longitude}}">
</div>
</div>

<div class="form-row">
<div class="form-group col-md-6">
<label for="inputCity">City</label>
<select id="inputState" name="cityId" class="form-control">
<option selected>Choose...</option>
@foreach($citys as $item)
    <option value="{{$item->id}}" {{ $item->id == $branch->city_id ? 'selected' : '' }}>{{$item->name}}</option>
@endforeach
</select>
</div>
<div class="form-group col-md-6">
<label for="inputState">Township</label>
<select id="inputState" name="townshipId" class="form-control">
<option selected>Choose...</option>
@foreach($townships as $item)
    <option value="{{$item->id}}" {{ $item->id == $branch->township_id ? 'selected' : '' }}>{{$item->name}}</option>
@endforeach
</select>
</div>
</div>


<a href="/admin/branch" class="btn btn-secondary">Cancel</a>
<button type="submit" class="btn btn-primary">Update</button>
</form>
    </div>
@endsection