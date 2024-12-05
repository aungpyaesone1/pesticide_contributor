@extends('nav')
@section('content')
<style>
    h1, h2, h3, h4, h5, h6 {
    color: #2c3145;
}
a, a:hover, a:focus, a:active {
    text-decoration: none;
    outline: none;
}
ul {
    margin: 0;
    padding: 0;
    list-style: none;
}

.section_all {
    position: relative;
    padding-top: 80px;
    padding-bottom: 80px;
    min-height: 100vh;
}
.section-title {
    font-weight: 700;
    text-transform: capitalize;
    letter-spacing: 1px;
}

.section-subtitle {
    letter-spacing: 0.4px;
    line-height: 28px;
    max-width: 550px;
}

.section-title-border {
    background-color: #000;
    height: 1 3px;
    width: 44px;
}

.section-title-border-white {
    background-color: #fff;
    height: 2px;
    width: 100px;
}
.text_custom {
    color: #00bd2a;
}

.about_icon i {
    font-size: 22px;
    height: 65px;
    width: 65px;
    line-height: 65px;
    display: inline-block;
    background: #fff;
    border-radius: 35px;
    color: #00bd2a;
    box-shadow: 0 8px 20px -2px rgba(158, 152, 153, 0.5);
}

.about_header_main .about_heading {
    max-width: 450px;
    font-size: 24px;
}

.about_icon span {
    position: relative;
    top: -10px;
}

.about_content_box_all {
    padding: 28px;
}

.contact-sec {
  align-item: center;
  display: flex;
  background-color: white;
}

.contact-sec .contact-ul li,
.contact-ul b {
  font-size: 14px;
  margin: 10px 0;
  font-family: Cambria, Cochin, Georgia, Times, "Times New Roman", serif;
  word-wrap: break-word;
}

.contact-sec .contact-ul i {
  font-size: 12px;
  padding: 10px;
  margin-right: 10px;
  border-radius: 50%;
}
.contact-detail a {
  color: #000;
  text-decoration: none;
}

.contact-sec .contact-ul li b:hover {
  color: #f93;
}

.contact-sec .contact-ul li .fa-location-dot {
  color: #f44337;
  border: 2px solid #f4433790;
}

.contact-sec .contact-ul li .fa-phone {
  color: #00b055;
  border: 2px solid #00b05590;
}

.contact-sec .contact-ul li .fa-envelope {
  color: #ff6347;
  border: 2px solid #ff634790;
}

.contact-detail span {
  width: 400px;
  display: flex;
  justify-content: center;
}
.contact-detail span a {
  font-size: 14px;
  padding: 6px 12px;
  color: #000;
  border-radius: 50%;
  margin: 0px 5px;
}
.contact-detail span .fb {
  color: #3b5998;
  border: 3px solid #3b5998;
}
.contact-detail span .fb:hover {
  color: #fff;
  background-color: #3b5998;
}

.contact-detail span .insta {
  color: #833ab4;
  border: 3px solid #833ab4;
}
.contact-detail span .insta:hover {
  color: #fff;
  background-color: #833ab4;
}

.contact-detail span .twitter {
  color: #00acee;
  border: 3px solid #00acee;
}
.contact-detail span .twitter:hover {
  color: #fff;
  background-color: #00acee;
}
</style>
<section class="section_all bg-light" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section_title_all text-center">
                            <h3 class="font-weight-bold">Welcome To <span class="text-custom">FarmCare</span></h3>
                            <p class="section_subtitle mx-auto text-muted">Your trusted partner in providing high-quality pesticide products across the country.</p>
                            <div class="">
                                <i class=""></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row vertical_content_manage mt-5">
                    <div class="col-lg-6">
                        <div class="about_header_main mt-3">
                            <div class="about_icon_box">
                                <p class="text_custom font-weight-bold">Who We Are</p>
                            </div>
                            <h4 class="about_heading text-capitalize font-weight-bold mt-4">Customer Satisfaction: Our Priority</h4>
                            <p class="text-muted mt-3">Welcome to FarmCare, your trusted partner in providing high-quality pesticide products across the country.</p>

                            <p class="text-muted mt-3"> With a commitment to excellence and a deep understanding of agricultural needs, we have grown into one of the leading online platforms for pesticide distribution, offering a wide range of products to ensure the best protection for your crops.</p>
                        </div>
                        <section class="contact-sec sec-pad">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="contact-detail">

          <ul class="contact-ul">
            <li><i class="fa fa-location-dot"></i> 8 Mile, Mayangone Township, Yangon, Myanmar</li>

            <li>
              <i class="fa fa-phone"></i>
              <a href="tel:08510004495"><b>+959449569651</b></a>,
              <a href="tel:08510005495"><b>0251600345666</b></a>
            </li>

            <li>
              <i class="fa-solid fa-envelope"></i>
              <a href="mailto:pardeepkumar4bjp@gmail.com"><b> framsafe@gmail.com</b></a>
            </li>
          </ul>

          
        </div>
      </div>
    </div>
</section>
                    </div>
                    <div class="col-lg-6">
                        <div class="img_about mt-3">
                            <img src="{{ asset('img/undraw_Add_to_cart_re_wrdo.png') }}" style="height:320px;border-radius:20px;border:0px solid blue;" alt="" class="img-fluid mx-auto d-block">
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-lg-4">
                        <div class="about_content_box_all mt-3">
                            <div class="about_detail text-center">
                                <div class="about_icon">
                                    <i class="fas fa-pencil-alt"></i>
                                </div>
                                <h5 class="text-dark text-capitalize mt-3 font-weight-bold">Easy Online</h5>
                                <p class="edu_desc mt-3 mb-0 text-muted"></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="about_content_box_all mt-3">
                            <div class="about_detail text-center">
                                <div class="about_icon">
                                    <i class="fab fa-angellist"></i>
                                </div>
                                <h5 class="text-dark text-capitalize mt-3 font-weight-bold">We make Best Result</h5>
                                <p class="edu_desc mb-0 mt-3 text-muted"> </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="about_content_box_all mt-3">
                            <div class="about_detail text-center">
                                <div class="about_icon">
                                    <i class="fas fa-paper-plane"></i>
                                </div>
                                <h5 class="text-dark text-capitalize mt-3 font-weight-bold">best platform </h5>
                                <p class="edu_desc mb-0 mt-3 text-muted"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endsection