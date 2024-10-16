@extends('welcome')
@section('content')
<style>
    .activity-item {
  overflow: visible;
  position: relative;
  margin: 15px 0;
  border-top: 1px dashed #ccc;
  padding-top: 15px;
}
.activity-item .avatar {
  -moz-border-radius: 2px;
  -webkit-border-radius: 2px;
  border-radius: 2px;
  width: 32px;
}
.activity-item > i {
  font-size: 18px;
  line-height: 1;
}
.activity-item .media-body {
  position: relative;
}
.activity-item .activity-title {
  margin-bottom: 0;
  line-height: 1.3;
}
.activity-item .activity-attachment {
  padding-top: 20px;
}
.activity-item .well {
  -moz-border-radius: 0;
  -webkit-border-radius: 0;
  border-radius: 0;
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  box-shadow: none;
  border: none;
  border-left: 2px solid #cfcfcf;
  background: #fff;
  margin-left: 20px;
  font-size: 0.85em;
}
.activity-item .thumbnail {
  display: inline;
  border: none;
  padding: 0;
}
.activity-item .thumbnail img {
  -moz-border-radius: 2px;
  -webkit-border-radius: 2px;
  border-radius: 2px;
  width: auto;
  margin: 0;
}
.activity-item .activity-actions {
  position: absolute;
  top: 15px;
  right: 0;
}
</style>
<div class="container">
    <h3>Activity Log</h3>
<div class="" id="activities">
@foreach ($activity as $cont)
<div class="media activity-item">

                                <a href="#" class="pull-left">
                                    <img src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="Avatar" class="media-object avatar">
                                </a>
                                <div class="media-body">
                                    <p class="activity-title"><a href="#">{{$cont->username}}</a> logged in at <a href="#"></a> <small class="text-muted"></small></p>
                                    <small class="text-muted">{{$cont->created_at}}</small>
                                </div>
                                
</div>
@endforeach
</div>
</div>
@endsection