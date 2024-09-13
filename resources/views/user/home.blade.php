@extends('nav')
@section('content')
<style>
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
  text-align:justify;
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
</style>

       <!-- Topic Cards -->
       <div id="cards_landscape_wrap-2">
        <div class="container">
            <div class="row">
            @foreach ($posts as $cont)
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <a href="/post-detail/{{$cont->id}}">
                        <div class="card-flyer">
                            <div class="text-box">
                                <div class="image-box">
                                    <img src="{{$cont->image}}" alt="" />
                                </div>
                                <div class="text-container">
                                <div class="row">
                                    <div class="col-md-1"><img class="icon" src="{{ asset('img/create.png') }}" alt="img"/></div>
                                    <div class="col-md-11"><span>{{$cont->title}}</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1"><img class="icon" style="width:20px;" src="{{ asset('img/clock.png') }}" alt="img"/></div>
                                    <div class="col-md-11"><h6><span style="font-size:12px;"> Posted on <u>1{{$cont->created_at}}</u></span></h6></div>
                                </div>
                                    <p style="text-align:justify">&nbsp;&nbsp;&nbsp;{{$cont->short_description}}....<span style="color:blue;">read more</span></p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            </div>
        </div>
       </div>
@endsection