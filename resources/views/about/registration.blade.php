
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Registration</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{!! url('css/registration.css') !!}" rel="stylesheet">
        <link href="{!! url('css/common.css') !!}" rel="stylesheet">
    </head>
    
    <body>
        <header class="headerrr">
            <nav>
                <ul>
                    <a href="{{route('about.layout') }}">
                        <img src="/image/billnwow-logo.png" class="billnwow-logo" alt="NWOW Philippines Storefront" style="margin-top:-1.3%">
                    </a>
                </ul>
            </nav>
        </header>  

        <form>
            <div class="headerr">
                <h1>Online Application</h1>
            </div>

            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" id="lastName" name="lastName">
            </div>

            <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" id="firstName" name="firstName">
            </div>

            <div class="form-group">
                <label for="middleName">Middle Name</label>
                <input type="text" id="middleName" name="middleName">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address">
            </div>

            <div class="form-group">
                <label>Date of Birth</label>
                <input type="date" id="dob" name="dob">
            </div>
            
            <div class="form-group">
                <label for="age">Age</label>
                <input type="numberr" id="age" name="age">
            </div>

            <div class="form-group">
                <label for="mobileNumber">Mobile Number</label>
                <input type="number" id="mobileNumber" name="mobileNumber">
            </div>

            <div class="form-group">
                <label for="facebookAccount">Facebook Account</label>
                <input type="text" id="facebookAccount" name="facebookAccount">
            </div>

            <div class="form-group">
                <label for="emailAddress">Email Address</label>
                <input type="email" id="emailAddress" name="emailAddress">
            </div>

            <div class="form-group">
                    <label>Gender</label>
                <div class="gender-group">
                    <input type="radio" id="male" name="gender" value="male">
                    <label for="male">Male</label>

                    <input type="radio" id="female" name="gender" value="female">
                    <label for="female">Female</label>

		            <input type="radio" id="other" name="gender" value="other">
                    <label for="other">Other</label>
                </div>
            </div>
                <input type="submit" value="Submit">    
        </form>
    </body>
</html>
