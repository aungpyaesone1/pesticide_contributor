@extends('nav')
@section('content')
<div class="container">
@if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
<div class="row flex-lg-nowrap">
  <div class="col">
    <div class="row">
      <div class="col mb-3">
        <div class="card">
          <div class="card-body">
            <div class="e-profile">
              <div class="row">
                <div class="col-12 col-sm-auto mb-3">
                  <div class="mx-auto" style="width: 140px;">
                    <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                    <img class="img-profile rounded-circle"
                    src="{{ asset('img/undraw_profile.svg') }}">
                    </div>
                  </div>
                </div>
                <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                  <div class="text-center text-sm-left mb-2 mb-sm-0">
                    <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{auth()->user()->username}}</h4>
                    <p class="mb-0">{{auth()->user()->phone}}</p>
                    <div class="text-muted"><small>Last seen 2 hours ago</small></div>
                    <div class="mt-2">
                      <button class="btn btn-primary" type="button">
                        <i class="fa fa-fw fa-camera"></i>
                        <span>Change Photo</span>
                      </button>
                    </div>
                  </div>
                  <div class="text-center text-sm-right">
                  @if(auth()->user()->role_id == 1)
                    <span class="badge badge-secondary">Administrator</span>
                  @endif
                  @if(auth()->user()->role_id == 2)
                    <span class="badge badge-secondary">Branch</span>
                  @endif
                  @if(auth()->user()->role_id == 3)
                    <span class="badge badge-secondary">User</span>
                  @endif
                

                    <div class="text-muted"><small>Joined {{auth()->user()->created_at}}</small></div>
                  </div>
                </div>
              </div>
              <ul class="nav nav-tabs">
                <li class="nav-item"><a href="" class="active nav-link">Profile Details</a></li>
              </ul>
              <div class="tab-content pt-3">
                <div class="tab-pane active">
                  <form class="form" method="post" action="{{ route('update-profile') }}">
                    @csrf
                    <div class="row">
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Username</label>
                              <input class="form-control" type="text" name="username" placeholder="" value="{{auth()->user()->username}}">
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Phone</label>
                              <input class="form-control" type="text" name="phone" placeholder="" value="{{auth()->user()->phone}}">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>City</label>
                              <select class="form-control" type="text" name="cityId" placeholder="">
                                <option>Pwintbyu</option>
                              </select>
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Township</label>
                              <select class="form-control" type="text" name="townshipId" placeholder="">
                                <option>Magway</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Address</label>
                              <textarea class="form-control" type="text" name="address" placeholder="">{{auth()->user()->address}}</textarea>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col mb-3">
                            <div class="form-group">
                              <label>About</label>
                              <textarea class="form-control" rows="5" placeholder="My Bio"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                      </div>
                    <!--<div class="row">
                      <div class="col-12 col-sm-6 mb-3">
                        <div class="mb-2"><b>Change Password</b></div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Current Password</label>
                              <input class="form-control" type="password" placeholder="••••••">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>New Password</label>
                              <input class="form-control" type="password" placeholder="••••••">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Confirm <span class="d-none d-xl-inline">Password</span></label>
                              <input class="form-control" type="password" placeholder="••••••"></div>
                          </div>
                        </div>
                      </div>
                      
                    </div>
                    <div class="row">
                      <div class="col d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                      </div>
                    </div>-->
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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