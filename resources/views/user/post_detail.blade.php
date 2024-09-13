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
  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main class="mt-4 mb-5">
    <div class="container">
      <!--Grid row-->
      <div class="row">
        <!--Grid column-->
        <div class="col-md-8 offset-md-2 mb-4">
          <!--Section: Post data-mdb-->
          <section class="border-bottom mb-4">
            <img src="{{$post->image}}"
              class="img-fluid shadow-2-strong rounded mb-4" alt=""/>

            <div class="row align-items-center mb-4">
              <div class="col-lg-6 text-center text-lg-start mb-3 m-lg-0">
              <h4>{{$post->title}}</h4>
                <img src="https://mdbootstrap.com/img/Photos/Avatars/img (23).jpg" class="rounded shadow-1-strong me-2"
                  height="35" alt="" loading="lazy" />
                <span> Posted on <u>1{{$post->created_at}}</u> by</span>
                <a href="" class="text-dark">Agri</a>
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
          <!--Section: Post data-mdb-->

          <!--Section: Text-->
          <section>
            <p>
              {{$post->description}}
            </p>

            <p class="note note-light">
              <strong>Note:</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              Optio odit consequatur porro sequi ab distinctio modi. Rerum cum dolores sint,
              adipisci ad veritatis laborum eaque illum saepe mollitia ut voluptatum.
            </p>

          </section>
          <!--Section: Text-->

          <!--Section: Share buttons-->
          <section class="text-center border-top border-bottom py-4 mb-4">
            <p><strong>Share with your friends:</strong></p>

            <button type="button" class="btn btn-primary me-1" data-mdb-ripple-init style="background-color: #3b5998;">
              <i class="fab fa-facebook-f"></i>
            </button>
            <button type="button" class="btn btn-primary me-1" data-mdb-ripple-init style="background-color: #55acee;">
              <i class="fab fa-twitter"></i>
            </button>
            <button type="button" class="btn btn-primary me-1" data-mdb-ripple-init style="background-color: #0082ca;">
              <i class="fab fa-linkedin"></i>
            </button>
            <button type="button" class="btn btn-primary me-1" data-mdb-ripple-init>
              <i class="fas fa-comments me-2"></i>Add comment
            </button>
          </section>
          <!--Section: Share buttons-->
        </div>
        <!--Grid column-->

        
      </div>
      <!--Grid row-->
    </div>
  </main>
  <!--Main layout-->
@endsection