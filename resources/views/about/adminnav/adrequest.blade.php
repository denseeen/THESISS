<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Request</title>
        
        <!-- Stylesheets -->
        <link href="{!! url('css/admin/adminrequest.css') !!}" rel="stylesheet">
        <link href="{{ url('css/admin/topnav_sidenav.css') }}" rel="stylesheet">
    
        
        <!-- Font Awesome for icons (sideNav-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        
    </head>

    <body>
        <!-- !-- Top Navbar -->
        <nav class="top_navbar">
            <a href="{{ route('addashboard.show') }}">
                <img src="/image/logoBillnWow3.png" class="TopNav-BillnWoWlogo" alt="BillnWoWLogo" style="margin-top:-1.3%">
            </a>

            <div class="icons">
                <!-- Dark Mode -->
                <div class="icon sun-icon" onclick="toggleDarkModeDashboard()">
                    <img src="/image/7721593.png" alt="Sun Icon">
                </div>
                <div class="icon profile-icon img" onclick="toggleDropdown()">   
                    <img src="/image/4174470.png" alt="Profile Icon">
                    <!-- <span class="profile-text">Account Profile</span> -->
                    <!-- Dropdown -->
                    <div class="dropdown-menu" id="dropdownMenu">
                        <a href="{{ route('adprofile.show') }}">Profile</a>
                        <a href="#">Change Password</a>
                        <a href="{{ route('about.layout') }}">Logout</a> 
                    </div>
                </div>
            </div>
        </nav>

        <!-- Sidebar -->
        <div class="wrapper hover_collapse">
            <div class="sidebar">
                <div class="sidebar_inner">
                    <ul>
                        <li><a href="{{ route('addashboard.show') }}"><span class="icon"><i class="fa fa-qrcode"></i></span><span class="text">Dashboard</span></a></li>
                        <li><a href="{{ route('adrequest.show') }}"><span class="icon"><i class="fa fa-link"></i></span><span class="text">Application</span></a></li>
                        <li><a href="{{ route('adinstallment.show') }}"><span class="icon"><i class="fa fa-eye"></i></span><span class="text">Installment</span></a></li>
                        <li><a href="{{ route('adfullypaid.show') }}"><span class="icon"><i class="fa fa-book"></i></span><span class="text">Fully Paid</span></a></li>
                        <li><a href="{{ route('adarchived.show') }}"><span class="icon"><i class="fa fa-question-circle"></i></span><span class="text">Archived</span></a></li>                
                    </ul>
                </div>
            </div>
        </div>

        <!-- content -->
        <form action="{{ route('form.submit') }}" method="POST" class="application-form">
            @csrf

            <!-- Display Validation Errors -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Display Success Message -->
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

            <h2>Information</h2>
                        
            <div class="form-row">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="name" id="name" name="name">
                </div>

                <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="emailad" id="email" name="email">
                </div>
            </div>    
            
            <div class="form-row">
                <div class="form-group">
                    <label for="streetaddress">Address</label>
                    <input type="text" id="streetaddress" name="streetaddress">
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
                        <label for="date_of_birth">Date of Birth</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" class="short-input">
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
                        <label for="phone_number">Mobile Number</label>
                        <input type="text" id="phone_number" name="phone_number">
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
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password">
                    </div>
                </div>
            </div>   
      
            <h2>Orders</h2>
        
            <div class="form-row">
                    <div class="form-group">
                        <label for="orderNumber">Order Number</label>
                        <input type="text" id="orderNumber" name="orderNumber">
                    </div>

                    <div class="form-group">
                        <label for="unitName">Unit Name</label>
                        <input type="text" id="unitName" name="unitName">
                    </div>
                    
                    <div class="form-group">
                        <label for="dateOrder">Date of Order</label>
                        <input type="date" id="dateOrder" name="dateOrder" class="short-dateOrder">
                    </div>

                    <div class="form-group">
                        <label for="unitprice">Unit Price</label>
                        <input type="text" id="unitprice" name="unitprice">
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <label for="unitDescription">Unit Description</label>
                        <input type="text" id="unitDescription" name="unitDescription" style="width: 50%;">
                    </div>
                </div>

                <h2>Payment Service</h2>
                <div class="checkbox-group">
                    <label>Fully Paid</label>
                        <input type="checkbox" id="fullypaid" name="fullypaid" value="1">

                    <label>Installment</label>
                        <input type="checkbox" id="installment" name="installment" value="1"><br>
                </div>

                <div id="installmentOptions" class="installment-options">
                    <div class="checkbox-group">
                        <label>6 Months</label>
                        <input type="checkbox" name="sixmonths" value="1">

                        <label>12 Months</label>
                        <input type="checkbox" name="twelvemonths" value="1">

                        <label>18 Months</label>
                        <input type="checkbox" name="eighteenmonths" value="1">
                    </div>
                </div>
                <input type="submit" value="Submit">
             
                <!-- Account Creation -->
            <!-- <div class="account_creation">
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

                     UserRoles 
                    <div class="mb-3 col-md-1">
                        <select name="user_roles" class="form-control" id="user_roles">
                            <option value="0" disabled>Select User Role</option>
                            <option value="1" @if (old('user_roles') == "1") {{ 'selected' }} @endif>admin</option>
                            <option value="2" @if (old('user_roles') == "2") {{ 'selected' }} @endif>Customer</option>
                        </select>
                    </div>
                    <button type="submit" class="cancelbtn">Submit</button>
                </form>    
            </div> -->
        </form>             
        <script src="{{ asset('js/admin/adrequest.js') }}"></script>  
    </body>
</html>