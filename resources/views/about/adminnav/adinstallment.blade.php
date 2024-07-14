
<!DOCTYPE html>
<html lang="en">
<head>
    
    <link href="{!! url('css/common.css') !!}" rel="stylesheet">
    <link href="{!! url('css/admin/admininstallment.css') !!}" rel="stylesheet">
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
        <h3 style="padding: 1%;text-align: center;color: aliceblue; ">ADMIN INSTALLMENT </h3>
    </div> 
      
    
    <div class="installment-container">
        <h2>INSTALLMENT PROCESS</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Unit</th>
                    <th>Installment Plan</th>
                    <th>Payment Method</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Violation</th>
                    <th>Comment</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href="#">Marian Naparan</a></td>
                    <td>ERV3</td>
                    <td>6 MONTHS</td>
                    <td>OTC</td>
                    <td>10,000</td>
                    <td>MARCH 30 2021</td>
                    <td>Paid</td>
                    <td>-</td>
                    <td>-</td>
                    <td><a href="#" class="update-button">UPDATE</a></td>
                </tr>
                <tr>
                    <td><a href="#">Marian Naparan</a></td>
                    <td>ERV3</td>
                    <td>6 MONTHS</td>
                    <td>ONLINE</td>
                    <td>9,650</td>
                    <td>MARCH 30 2021</td>
                    <td>Paid</td>
                    <td>-</td>
                    <td>-</td>
                    <td><a href="#" class="update-button">UPDATE</a></td>
                </tr>
                <tr>
                    <td><a href="#">Marian Naparan</a></td>
                    <td>ERV3</td>
                    <td>6 MONTHS</td>
                    <td>ONLINE</td>
                    <td>9,650</td>
                    <td>MARCH 30 2021</td>
                    <td>Paid</td>
                    <td>-</td>
                    <td>-</td>
                    <td><a href="#" class="archive-button">ARCHIVED</a></td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="container">
        <div class="customer-info">
            <h2>Customer Name:</h2>
            <p><strong>Marian Naparan</strong></p>
            <p>Email: marian_naparan@gmail.com</p>
            <p>Phone Number: 0956946355</p>
            <p>Address: Quezon City Cubao</p>
            <a href="#" class="edit-button">Edit</a>
        </div>
        <div class="transaction-records">
            <h2>Transaction Records</h2>
            <p>Unit Price: ERVS3 59,800</p>
            <p>Balance: 30,500</p>
            <table>
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                </tr>
                <tr>
                    <td>March 30 2021</td>
                    <td>10,000</td>
                </tr>
                <tr>
                    <td>April 15 2021</td>
                    <td>9,650</td>
                </tr>
                <tr>
                    <td>May 15 2021</td>
                    <td>9,650</td>
                </tr>
            </table>
        </div>
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