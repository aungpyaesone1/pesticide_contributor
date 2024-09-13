@extends('nav')
@section('content')
<style>
    .col-md-6{
        border:0px solid red;
        height:50px;
    }
    .filter {
        padding: 30px;
    }
     /*----  Main Style  ----*/
#cards_landscape_wrap-2{
  text-align: center;
  
}
#cards_landscape_wrap-2 .container{
  padding-top: 0px; 
  padding-bottom: 0px;
}
#cards_landscape_wrap-2 a{
  text-decoration: none;
  outline: none;
}
#cards_landscape_wrap-2 .card-flyer {
  border-radius: 5px;
}
#cards_landscape_wrap-2 .card-flyer .image-box{
  background: #ffffff;
  overflow: hidden;
  box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.50);
  border-radius: 5px;
}
#cards_landscape_wrap-2 .card-flyer .image-box img{
  -webkit-transition:all .9s ease; 
  -moz-transition:all .9s ease; 
  -o-transition:all .9s ease;
  -ms-transition:all .9s ease; 
  width: 100%;
  height: 200px;
}
#cards_landscape_wrap-2 .card-flyer:hover .image-box img{
  opacity: 0.7;
  -webkit-transform:scale(1.15);
  -moz-transform:scale(1.15);
  -ms-transform:scale(1.15);
  -o-transform:scale(1.15);
  transform:scale(1.15);
}
#cards_landscape_wrap-2 .card-flyer .text-box{
  text-align: center;
}
#cards_landscape_wrap-2 .card-flyer .text-box .text-container{
  padding: 30px 18px;
  text-align: justify;
}
#cards_landscape_wrap-2 .card-flyer{
  background: #FFFFFF;
  margin-top: 50px;
  -webkit-transition: all 0.2s ease-in;
  -moz-transition: all 0.2s ease-in;
  -ms-transition: all 0.2s ease-in;
  -o-transition: all 0.2s ease-in;
  transition: all 0.2s ease-in;
  box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.40);
}
#cards_landscape_wrap-2 .card-flyer:hover{
  background: #fff;
  box-shadow: 0px 15px 26px rgba(0, 0, 0, 0.50);
  -webkit-transition: all 0.2s ease-in;
  -moz-transition: all 0.2s ease-in;
  -ms-transition: all 0.2s ease-in;
  -o-transition: all 0.2s ease-in;
  transition: all 0.2s ease-in;
  margin-top: 50px;
}
#cards_landscape_wrap-2 .card-flyer .text-box p{
  margin-top: 10px;
  margin-bottom: 0px;
  padding-bottom: 0px; 
  font-size: 14px;
  letter-spacing: 1px;
  color: #000000;
}
#cards_landscape_wrap-2 .card-flyer .text-box h6{
  margin-top: 0px;
  margin-bottom: 4px; 
  font-size: 18px;
  font-weight: bold;
  text-transform: uppercase;
  font-family: 'Roboto Black', sans-serif;
  letter-spacing: 1px;
  color: #00acc1;
}
.icon {
    height: 25px;
    width: 20px;
}
.col-md-3{
    border:0px solid red;
    padding:3px;
}
.col-md-9{
    border:0px solid red;
    text-align: left;
}
</style>
<div class="row">
    <div class="filter col-md-8 offset-md-2" >
        <!-- Jumbotron -->
    <div id="intro" class="p-3 text-center bg-light">
    <form action="{{ route('branch') }}" method="get">
    @csrf
    <div class="row">
        <div class="col-md-6">
<select id="inputState" name="township" class="form-control">
<option selected value="all">All</option>
@foreach($townships as $item)
    <option value="{{$item->id}}" {{ $item->id == request('township') ? 'selected' : '' }}>{{$item->name}}</option>
@endforeach
</select>
        </div>
        <div class="col-md-6">
        <div class="input-group">
  <div class="form-outline" data-mdb-input-init>
    <input type="search" id="keyword" name="keyword" value="{{ request('keyword') }}" class="form-control" />
    <label class="form-label" for="form1">Search by shop name</label>
  </div>
  <button type="submit" class="btn btn-primary" data-mdb-ripple-init>
    <i class="fas fa-search"></i>
  </button>
</div>
</form>
        </div>
        </div>
    </div>
    <!-- Jumbotron -->
        
    </div>
</div>
<div class="row">
<div id="cards_landscape_wrap-2">
<h2>Branch List</h2>
        <div class="container">
            <div class="row">
            @foreach ($branchs as $cont)
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <a href="/branch-detail/{{ $cont->id }}">
                        <div class="card-flyer">
                            <div class="text-box">
                                <div class="image-box">
                                    <img src="{{ $cont->image }}" alt="" />
                                </div>
                                <div class="text-container">
                                    <h6>{{$cont->username}}</h6>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-1">
                                        <img class="icon" src="{{ asset('img/phone-call (3).png') }}" alt="img"/>
                                        </div>
                                        <div class="col-md-11">
                                        <p style="padding-bottom:5px;margin-top:3px;">{{$cont->phone}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1">
                                        <img class="icon" src="{{ asset('img/gps (1).png') }}" alt="img"/>
                                        </div>
                                        <div class="col-md-11">
                                        <p style="padding-bottom:5px;margin-top:3px;">{{$cont->address}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            </div>
        </div>
       </div>
</div>

@endsection