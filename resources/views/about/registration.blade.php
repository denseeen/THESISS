
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registration</title>
  <link href="{!! url('css/registration.css') !!}" rel="stylesheet">
  <link href="{!! url('css/common.css') !!}" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('about.layout') }}">Home</a></li>
                <li><a href="#branches">Branches</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact Us</a></li>
            </ul>
        </nav>
    </header>  

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
                <button type="submit">Submit</button>
            </div>
        </div>
    </form>



</body>

</html>
