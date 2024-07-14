
<!DOCTYPE html>
<html lang="en">
<head>
    
    <link href="{!! url('css/common.css') !!}" rel="stylesheet">
    <link href="{!! url('css/admin/adminrequest.css') !!}" rel="stylesheet">
    <link href="{!! url('assets/bootstrap/js/jquery.backstretch.js') !!}" rel="stylesheet">
    <link href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
 <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/bootstrap/css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/bootstrap/css/style.css">
    <link rel="stylesheet" href="assets/bootstrap/css/media-queries.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/path/to/jquery.mCustomScrollbar.concat.min.js"></script>


    <title>Admin</title>
</head>
    <body class= "customerUi" style="text-align: center  ml-1">

<!-- Wrapper -->
<div class="wrapper">
 
    <!-- Sidebar -->
    <nav class="sidebar">
 
        <!-- close sidebar menu -->
        <div class="dismiss">
            <i class="fas fa-arrow-left"></i>
        </div>
 
        <div class="logo">
            <h3><a href="index.html">Bootstrap 4 Template with Sidebar Menu</a></h3>
        </div>
 
        <ul class="list-unstyled menu-elements">
            <li class="active">
                <a class=" " href="{{ route('adprofile.show') }}"><i class="fas fa-home"></i> Profile</a>
            </li>
            <li>
                <a class=" " href="{{ route('addashboard.show') }}"><i class="fas fa-cog"></i> Dashboard</a>
            </li>
            <li>
                <a class=" " href="{{ route('adrequest.show') }}"><i class="fas fa-user"></i> Application Request</a>
            </li>
            <li>
                <a class=" " href="{{ route('adinstallment.show') }}"><i class="fas fa-pencil-alt"></i> Installment</a>
            </li>
              <li>
                <a class=" " href="{{ route('adfullypaid.show') }}"><i class="fas fa-envelope"></i> Fully Paid</a>
             </li>

             <li>
                 <a class=" " href="{{ route('adarchived.show') }}">
                    <i class="fas fa-sync"></i>archived
                 </a>
                
             </li>

            <li>
                <a class=" " href="{{ route('about.layout') }}"> 
                   <i class="fas fa-sync"></i>Log Out
               </a>
              
           </li> 
        </ul>
 
        
 
    </nav>
    <!-- End sidebar -->
 
    <!-- Dark overlay -->
    <div class="overlay"></div>
 
    <!-- Content -->
    <div class="content">
 
        <!-- open sidebar menu -->
        <a class="btn btn-primary btn-customized open-menu" href="#" role="button">
            <i class="fas fa-align-left"></i> <span>Menu</span>
        </a>
 
        <!-- ... -->
 
        <!-- here is the page's content (not shown here) -->
 
        <!-- ... -->
 
    </div>
    <!-- End content -->
 
</div>
<!-- End wrapper -->

    
     <div class="topnav">
        <h3 style="padding: 1%;text-align: center;color: aliceblue; ">ADMIN APPLICATION REQUEST </h3>
    </div> 
      
    
    <div class="application-list">
        <h2>Customer Application Form</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Unit</th>
                    <th>Contact</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Marian Naparan</td>
                    <td>MARCH 30 2021</td>
                    <td>ERV3</td>
                    <td>0946556464</td>
                    <td><button>View</button></td>
                </tr>
                <tr>
                    <td>Marian Naparan</td>
                    <td>MARCH 30 2021</td>
                    <td>ERV3</td>
                    <td>0946556464</td>
                    <td><button>View</button></td>
                </tr>
                <tr>
                    <td>Marian Naparan</td>
                    <td>MARCH 30 2021</td>
                    <td>ERV3</td>
                    <td>0946556464</td>
                    <td><button>View</button></td>
                </tr>
            </tbody>
        </table>
    </div>


    <!-- This is to view online application form -->
    <form class="application-form">
        <h1>Online Application</h1>
                     
        <div class="form-row">
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name">
            </div>
            
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name">
            </div>
            
            <div class="form-group">
                <label for="middle_name">Middle Name</label>
                <input type="text" id="middle_name" name="middle_name">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address">
            </div>
                   
        <div class="form-row">
            <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="others">Others</option>
                </select>
            </div>
         
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" class="short-input">
            </div>
            </div>
	
        <div class="form-row">
            <div class="form-group">
                <label for="age">Age</label>
                <input type="text" id="age" name="age" style="width: 50px;">
            </div>
        </div>
                
        <div class="form-row">
            <div class="form-group">
                <label for="mobile_number">Mobile Number</label>
                <input type="text" id="mobile_number" name="mobile_number">
            </div>
            
            <div class="form-group">
                <label for="telephone_number">Telephone Number</label>
                <input type="text" id="telephone_number" name="telephone_number">
            </div>
            
            <div class="form-group">
                <label for="fb_account">FB Account</label>
                <input type="text" id="fb_account" name="fb_account">
            </div>
            
            <div class="form-group">
                <label for="email_address">Email Address</label>
                <input type="email" id="email_address" name="email_address">
            </div>
        </div>

        <div class="form-row">
        <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <button type="create" style="margin-top: 50%;">Create</button>
            </div>
        </div>
    </form>



        <!-- Javascript -->
        {{-- <script src="assets/js/jquery-3.3.1.min.js"></script>
        <script src="assets/js/jquery-migrate-3.0.0.min.js"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.waypoints.min.js"></script>
        <script src="assets/bootstrap/js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="assets/bootstrap/js/scripts.js"></script>


        {{-- <div class="account_creation">
            <form action="{{ route('about.save') }}" method="POST" enctype="multipart/form-data"  >
            @csrf
            <div class="mb-3 col-md-1">
                <label class="form-label">FullName</label>
                <input type="text" class="form-control" name="name">
                @if($errors->has('name'))
            <div class="error">{{ $errors->first('name') }}</div>
          @endif
            </div>
          
            <div class="mb-3 col-md-1">
            <label class="form-label">Email address</label>
            <input type="email" class="form-control" name="email">
            @if($errors->has('email'))
            <div class="error">{{ $errors->first('email') }}</div>
          @endif
          </div>
          
          <div class="mr-1 mb-3 col-md-1">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password">
            @if($errors->has('password'))
            <div class="error">{{ $errors->first('password') }}</div>
          @endif
          </div>
        
        
          <div class="mb-3 col-md-1">
          <select name="user_roles" class="form-control" id="user_roles">
                                        <option value="0" disabled>Select User Role</option>
                                        <option value="1" @if (old('user_roles') == "1") {{ 'selected' }} @endif>admin</option>
                                        <option value="2" @if (old('user_roles') == "2") {{ 'selected' }} @endif>Customer</option>
                                    </select>
          </div>
          <button type="submit" class="cancelbtn">Submit</button> --}}
        
        
          <link href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
          <link href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
        
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>