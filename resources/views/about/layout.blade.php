<!DOCTYPE html>
<html lang="en">
  <head>
      <link href="{!! url('css/common.css') !!}" rel="stylesheet">
      <link href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
      <title>BillnWow</title>
  </head>

  <body>
    <!-- NAVIGATION -->
    <header>
      <nav>
          <ul>
            <img src="/image/billnwow-logo.png" class="billnwow-logo" alt="NWOW Philippines Storefront">
            <!-- <li><a href="{{ route('about.registration') }}">Online Application</a></li> -->
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact Us</a></li>
            <li class="nav-btn">
              <a class="btn" data-toggle="modal" data-target="#LoginModal">Login</a>
            </li>
        </ul>
      </nav>
    </header> 
  
    <!-- CONTENT -->
    <main>
      <section class="hero">
              <img src="/image/picture1.png" alt="NWOW Philippines Storefront">
        <div class="hero-text">
              <h1>Welcome to NWOW Philippines – Worldwide Popular Electric Vehicles Brand</h1>
              <p>NWOW International is a company specializes in manufacturing electric bicycle with high-quality parts for continuous innovation and development operation of state of the art electric bicycle distributors.</p>
            <ul>
              <p><i class="fas fa-check"></i> Affordable Electric Vehicle</p>
              <p><i class="fas fa-check"></i> Authorized Dealer Nationwide</p>
              <p><i class="fas fa-check"></i> Quality Lifetime Service</p>
              <p><i class="fas fa-check"></i> Up to Date Units</p>
            </ul>
        </div>
      </section>

      <section class="webdescript" id="about">  
        <img src="/image/billnwow-logo.png" alt="NWOW Philippines Storefront" width="15%">
        <p>The website provide customer a platform where they can see their bill remotely from anywhere and anytime.a web-based platform for administration to manage customer.</p>

        <div class="platform-description">
          <div class="feature">
            <i class="fas fa-dollar-sign"></i>
            <span>Payment Status</span>
          </div>

          <div class="feature">
              <i class="fas fa-file-alt"></i>
              <span>Transaction Details</span>
          </div>

          <div class="feature">
              <i class="fas fa-bell"></i>
              <span>Notifications</span>
          </div>
        </div>
      </section>
          
      <section class="new-arrival">
        <h2>New Arrival</h2>

        <div class="products">
          <div class="product">
            <img src="/image/WSPWHT.jpg" alt="NWOW WSP">
            <p>NWOW WSP</p>
          </div>

          <div class="product">
            <img src="/image/EMCMOONSILVER.jpg" alt="NWOW EMC-GOLF">
            <p>NWOW EMC-GOLF</p>
          </div>

          <div class="product">
            <img src="/image/ERV2WHT.jpg" alt="NWOW ERV2">
              <p>NWOW ERV2</p>
          </div>
        </div>
      </section>

      <section class="hot-selling">
        <h2>Hot Selling</h2>

        <div class="products">
          <div class="product">
            <img src="/image/ERVS2GREY2_i6ou.jpg" alt="Product 1">
            <p>Product 1</p>
          </div>

          <div class="product">
            <img src="/image/GB2_pxmu.jpg" alt="Product 2">
            <p>Product 2</p>
          </div>

          <div class="product">
            <img src="/image/UNITSWEBSITESIZETEMPLATE.jpg" alt="Product 3">
            <p>Product 3</p>
          </div>
        </div>
      </section>
    </main>

    <!-- FOOTER -->
    <footer>
      <div class="footer-icons">
        <div class="icon">
          <img src="/image/ORIGNAL.png" alt="Original">
          <p>Original<br>Official Product<br>Good Quality Good Price</p>
        </div>

        <div class="icon">
          <img src="/image/3Years.png" alt="Warranty">
          <p>Long Warranty<br>Good Quality Good Price</p>
        </div>

        <div class="icon">
          <img src="/image/Team.png" alt="Professional Team">
          <p>Professional Team<br>Good Quality Good Price</p>
        </div>

        <div class="icon">
          <img src="/image/Delivery.png" alt="World Chain">
          <p>World Chain<br>Good Quality Good Price</p>
        </div>
      </div>

      <div class="contact">
              <p id="contact">(02)-8255-2700<br>0969-580-8089<br>0969-580-8090</p>
        <div class="social-icons">
                  <a href="#"><img src="/image/1FB.png" alt="Facebook"></a>
                  <a href="#"><img src="/image/1Youtube.png" alt="YouTube"></a>
                  <a href="#"><img src="/image/1Email.png" alt="Email"></a>
        </div>
      </div>
    </footer>
  
    <!-- MODAL -->
    <div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="LoginModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class= "d-flex" style="padding: 12px; justify-content: space-between">
            <img src="/image/billnwow-logo.png" alt="NWOW Philippines Storefront" width="60%" style="margin-left: 20%">
            <div>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
          </div>

          <form action="{{ route('about.entry') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-comtrol" placeholder="Enter Username" name="email" required>
                @if($errors->has('email'))
                <div class="error">{{ $errors->first('email') }}</div>
                  @endif
                </div>

                <div class="mb-3" style="margin-top: 5px" >
                  <label class="form-label">Password</label>
                  <input type="password" class="form-comtrol" placeholder="Enter Password" name="password" required>
                  @if($errors->has('password'))
                  <div class="error">{{ $errors->first('password') }}</div>
                    @endif
                  </div>

                  {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                  <button type="submit" class="btn btn-primary">Login</button>

                  <div class="modal-footer">
                    <div class="remember-me" style="margin-right: 42%">
                      <label><input type="checkbox" checked="checked" name="remember"> Remember me</label>
                   </div>

                  <div class="forgot-password" style="margin-top: 5px">
                    {{-- <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button> --}}
                    <span class="password" style="margin-top: 5px" > <a href="{{ route('forgotpassword.show') }}">forgot password?</a></span>
                  </div>
              </div>
            <div>  
          </form>
        </div>    
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</html>