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
            <img src="{{$product->image}}"
              class="img-fluid shadow-2-strong rounded mb-4" alt="" style="height:500px;width:500px;"/>

            <div class="row align-items-center mb-4">
              <div class="col-lg-6 text-center text-lg-start mb-3 m-lg-0">
              <h4>{{$product->name}}</h4>
                <img src="{{asset('img/chemical (1).png')}}" class="rounded shadow-1-strong me-2"
                  height="35" alt="" loading="lazy" />
                <span> Posted on <u>1{{$product->created_at}}</u> by</span>
                <a href="" class="text-dark">FarmSafe</a>
                <br>
              </div>
             

              <div class="col-lg-6 text-center text-lg-end">
              <form action="{{ route('add-to-card') }}" method="post">
                                      @csrf
                                      <input type="hidden" name="product_id" value="{{$product->id}}">
                                      <input type="hidden" name="branch_id" value="{{$branchId}}">
                                    <button type="submit" class="btn btn-primary">Add to card</button>
                                    </form>
              </div>
            </div>
          </section>
          <!--Section: Post data-mdb-->

          <!--Section: Text-->
          <section>
            <p>
              {{$product->description}}
            </p>

          </section>
          <!--Section: Text-->

          <!--Section: Share buttons-->
          <section class="text-center border-top border-bottom py-4 mb-4">
            <p><strong>Share with your friends:</strong></p>
            <a href="#" data-toggle="modal" data-target="#commentsModal">View comments ({{$comment->comment_count}})</a><br>
            <button data-toggle="modal" data-target="#commentModal" type="button" class="btn btn-primary me-1" data-mdb-ripple-init>
              <i class="fas fa-comments me-2"></i>Add comment
            </button>
          </section>
          <!--Section: Share buttons-->
<div class="modal fade bd-example-modal-lg" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Please make your comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('comment') }}">
      @csrf
      <div class="modal-body">
        <div class="form-group">
        <label for="inputAddress">Username</label>
        <input type="text" class="form-control" id="inputAddress" value="{{auth()->user()->username}}" disabled>
        <input type="hidden" name="product_id" value="{{$product->id}}">
        </div>
        <div class="form-group">
        <label for="inputAddress">Comment</label>
        
        <textarea style="height:300px;" type="text" name="comment" class="form-control" id="inputAddress"></textarea>
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Comment</button>
      </div>
      </div>
    </form>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="commentsModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Comments</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      @foreach ($comments as $index => $cont)
      <div class="container">	
	<div class="card">
	    <div class="card-body">
	        <div class="row">
        	    <div class="col-md-1">
        	        <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid" style="height:40px;width:40px;"/>
        	    </div>
        	    <div class="col-md-10">
        	        <p>
        	            <a class="float-left" href="https://maniruzzaman-akash.blogspot.com/p/contact.html"><strong>{{$cont->username}}</strong></a> &nbsp&nbsp {{$cont->created_at}}
                        <p class="text-secondary text-center"></p>

        	       </p>
        	       <div class="clearfix"></div>
        	        <p>{{$cont->comment}}</p>
        	        
        	    </div>
	        </div>
	        	
            	    </div>
	            </div>
</div>

      @endforeach
        <div class="modal-footer">
        
      </div>
      </div>
    </form>
    </div>
  </div>
</div>
        </div>
        <!--Grid column-->

        
      </div>
      <!--Grid row-->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </main>
  <!--Main layout-->
@endsection