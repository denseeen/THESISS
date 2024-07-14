
<!DOCTYPE html>
<html lang="en">
<head>
    
    <link href="{!! url('css/common.css') !!}" rel="stylesheet">
    <link href="{!! url('css/admin/adminarchived.css') !!}" rel="stylesheet">
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
        <h3 style="padding: 1%;text-align: center;color: aliceblue; ">ADMIN ARCHIVED </h3>
    </div> 
      
    
    <div class="container">
        <h2>Archived</h2>
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
                    <td><button class="view-button">View</button></td>
                </tr>
                <tr>
                    <td>Marian Naparan</td>
                    <td>MARCH 30 2021</td>
                    <td>ERV3</td>
                    <td>0946556464</td>
                    <td><button class="view-button">View</button></td>
                </tr>
                <tr>
                    <td>Marian Naparan</td>
                    <td>MARCH 30 2021</td>
                    <td>ERV3</td>
                    <td>0946556464</td>
                    <td><button class="view-button">View</button></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="form-container">
        <form>
            <div class="form-group">
                <div>
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date">
                </div>
                <div>
                    <label for="sales-representative">Sales Representative:</label>
                    <input type="text" id="sales-representative" name="sales-representative">
                </div>
                <div>
                    <label for="application-no">Application No:</label>
                    <input type="text" id="application-no" name="application-no">
                </div>
                <div class="checkbox-group">
                    <label for="new"><input type="checkbox" id="new" name="new"> New</label>
                    <label for="used"><input type="checkbox" id="used" name="used"> Used</label>
                </div>
                <div>
                    <label for="model-color">Model & Color:</label>
                    <input type="text" id="model-color" name="model-color">
                </div>
                <div>
                    <label for="down-payment">Down Payment:</label>
                    <input type="text" id="down-payment" name="down-payment">
                </div>
                <div>
                    <label for="purpose">Purpose:</label><br>
                    <label for="business"><input type="checkbox" id="business" name="purpose" value="business"> Business</label>
                    <label for="personal"><input type="checkbox" id="personal" name="purpose" value="personal"> Personal</label>
                </div>
                <div>
                    <label for="last-name">Last Name:</label>
                    <input type="text" id="last-name" name="last-name">
                </div>
                <div>
                    <label for="first-name">First Name:</label>
                    <input type="text" id="first-name" name="first-name">
                </div>
                <div>
                    <label for="middle-name">Middle Name:</label>
                    <input type="text" id="middle-name" name="middle-name">
                </div>
                <div>
                    <label for="age">Age:</label>
                    <input type="text" id="age" name="age">
                </div>
                <div>
                    <label for="religion">Religion:</label>
                    <input type="text" id="religion" name="religion">
                </div>
                <div>
                    <label for="citizenship">Citizenship:</label>
                    <input type="text" id="citizenship" name="citizenship">
                </div>
                <div>
                    <label for="gender">Gender:</label>
                    <input type="text" id="gender" name="gender">
                </div>
                <div>
                    <label for="dob">Date Of Birth:</label>
                    <input type="date" id="dob" name="dob">
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email">
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password">
                </div>
            </div>
            <button type="submit" class="delete-button">Delete</button>
        </form>
    </div>



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
</body>
</html>