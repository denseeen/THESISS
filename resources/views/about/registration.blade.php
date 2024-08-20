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
                    <a href="{{ route('about.layout') }}">
                        <img src="/image/billnwow-logo.png" class="billnwow-logo" alt="NWOW Philippines Storefront" style="margin-top:-1.3%">
                    </a>
                </ul>
            </nav>
        </header>  

        <!-- The form begins here -->
        <form action="{{ route('form.submit') }}" method="POST">
            @csrf <!-- Include this directive to generate the CSRF token -->

            <div class="headerr">
                <h1>Online Application</h1>
            </div>

            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" id="lastName" name="lastName" required>
            </div>

            <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" id="firstName" name="firstName" required>
            </div>

            <div class="form-group">
                <label for="middleName">Middle Name</label>
                <input type="text" id="middleName" name="middleName">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required>
            </div>

            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" required>
            </div>
            
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" id="age" name="age" required>
            </div>

            <div class="form-group">
                <label for="mobileNumber">Mobile Number</label>
                <input type="number" id="mobileNumber" name="mobileNumber" required>
            </div>

            <div class="form-group">
                <label for="facebookAccount">Facebook Account</label>
                <input type="text" id="facebookAccount" name="facebookAccount">
            </div>

            <div class="form-group">
                <label for="emailAddress">Email Address</label>
                <input type="email" id="emailAddress" name="emailAddress" required>
            </div>

            <div class="form-group">
                <label>Gender</label>
                <div class="gender-group">
                    <input type="radio" id="male" name="gender" value="male" required>
                    <label for="male">Male</label>

                    <input type="radio" id="female" name="gender" value="female">
                    <label for="female">Female</label>

                    <input type="radio" id="other" name="gender" value="other">
                    <label for="other">Other</label>
                </div>
            </div>
            
            <input type="submit" value="Submit">    
        </form>
        <!-- The form ends here -->
    </body>
</html>
