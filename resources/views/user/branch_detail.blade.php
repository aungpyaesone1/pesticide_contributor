@extends('nav')
@section('content')
  <!--Main Navigation-->
  <header>
    <!-- Intro settings -->
    <style>
      #intro {
        /* Margin to fix overlapping fixed navbar */
        margin-top: 58px;
      }

      @media (max-width: 991px) {
        #intro {
          /* Margin to fix overlapping fixed navbar */
          margin-top: 45px;
        }
      }

      .img-fluid{
        border-radius: 50px;
      }

       /*----  Main Style  ----*/
#cards_landscape_wrap-2{
  text-align: center;
  margin-top: -120px;
  
}
#cards_landscape_wrap-2 .container{
  padding-top: -30px; 
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
  padding: 20px 0px;
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main class="mt-4 mb-5">
    <div class="container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
      <!--Grid row-->
      <div class="row">
        <!--Grid column-->
        <div class="col-md-8 offset-md-2 mb-4">
          <!--Section: Post data-mdb-->
          <section class="border-bottom mb-4">
            <img src="{{$branch->image}}"
              class="img-fluid shadow-2-strong rounded mb-4" alt="" />

            <div class="row align-items-center mb-4">
              <div class="col-lg-6 text-center text-lg-start mb-3 m-lg-0">
                <img src="{{ asset('img/store.png') }}" class="rounded shadow-1-strong me-2"
                  height="35" alt="" loading="lazy" />
                <span style="font-size:22px;"><b>{{$branch->username}}</b></span>
                <h6>{{$branch->address}}</h6>
                <h6>{{$branch->phone}}</h6>
              </div>

              <div class="col-lg-6 text-center text-lg-end">
                <button type="button" class="btn btn-primary px-3 me-1" data-mdb-ripple-init
                  style="background-color: #3b5998;">
                  <i class="fab fa-facebook-f"></i>
                </button>
                <button type="button" class="btn btn-primary px-3 me-1" data-mdb-ripple-init>
                  <i class="fas fa-comments"></i>
                </button>
              </div>
            </div>
          </section>
        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->
    </div>
  </main>
  <!--Main layout-->
  <!-- Topic Cards -->
  
  <div id="cards_landscape_wrap-2">
        <div class="container">
            <div class="row">
            @foreach ($products as $cont)
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    
                        <div class="card-flyer">
                            <div class="text-box">
                            <a href="/product/{{$branch->id}}/{{$cont->id}}">
                                <div class="image-box">
                                    <img src="{{$cont->image}}" alt="" />
                                </div>
                            </a>
                                <div class="text-container">
                                  <div style="text-align:justify;">
                                  <div class="row">
                                    <div class="col-md-2"><img style="padding-left:20px;" class="icon" src="{{ asset('img/product.png') }}" alt="img"/></div>
                                    <div class="col-md-10"><h5>{{$cont->name}}</h5></div>
                                  </div>
                                  
                                    <hr>
                                    <div class="row">
                                    <div class="col-md-2"><img style="padding-left:20px;" class="icon" src="{{ asset('img/price-tag.png') }}" alt="img"/></div>
                                    <div class="col-md-10"><span>{{$cont->price}} Kyats</span></div>
                                  </div>
                                    
                                    <p style="text-align:justify;padding-left:20px;padding-right:20px;">&nbsp;&nbsp;&nbsp;{{$cont->short_description}}....</p>
                                  </div>
                                    <br/>
                                    
                                      
                                    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#addModal-{{ $cont->id }}">Add to card</button>
                                    
<div class="modal fade bd-example-modal-lg" id="addModal-{{ $cont->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input number of item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('add-to-card') }}" method="post">
                                      @csrf
                                      
      <div class="modal-body">
      <input type="hidden" name="product_id" value="{{$cont->id}}">
      <input type="hidden" name="branch_id" value="{{$branch->id}}">
      <div class="form-group">
        <label for="inputAddress" style="margin-left:-350px;">Number of item</label>
      　<input type="number" name="count" class="form-control">
      </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
      </div>
    </form>
    </div>
  </div>
</div>
                                </div>
                            </div>
                        </div>
                    
                </div>
            @endforeach
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