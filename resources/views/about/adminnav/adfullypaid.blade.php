<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Fully Paid</title>
    
    <!-- Stylesheets -->
    <link href="{!! url('css/admin/adminfullypaid.css') !!}" rel="stylesheet">
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{!! url('css/common.css') !!}" rel="stylesheet">
 
 
    
    <!-- Font Awesome for icons (sideNav-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
</head>
<body>

<div class="wrapper hover_collapse">
    <!-- Top Navbar -->
    <nav class="top_navbar">
        
    <a href="{{ route('addashboard.show') }}" class="TopNav-BillnWoWlogo">
            <img src="/image/logoBillnWow3.png" alt="BillnWoWLogo">
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

<!-- Javascript -->
<script>

    // DarkMode
function toggleDarkModeFullyPaid() {
    document.body.classList.toggle('dark-mode');
    document.querySelectorAll('.top_navbar, .sidebar').forEach(item => {
        item.classList.toggle('dark-mode');
    });
}

    // DropDown
function toggleDropdown() {
    document.getElementById('dropdownMenu').classList.toggle('show');
}

window.onclick = function(event) {
    if (!event.target.closest('.profile-icon')) {
        var dropdowns = document.getElementsByClassName('dropdown-menu');
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

// SideNav
document.addEventListener("DOMContentLoaded", function() {
  var li_items = document.querySelectorAll(".sidebar ul li");
  var hamburger = document.querySelector(".hamburger");

  li_items.forEach((li_item) => {
    li_item.addEventListener("mouseenter", () => {
      li_item.closest(".wrapper").classList.remove("hover_collapse");
    });
  });

  li_items.forEach((li_item) => {
    li_item.addEventListener("mouseleave", () => {
      li_item.closest(".wrapper").classList.add("hover_collapse");
    });
  });

  hamburger.addEventListener("click", () => {
    hamburger.closest(".wrapper").classList.toggle("hover_collapse");
  });
});

</script>

<!-- content -->
 
     <div class="topnav">
        <h3 style="padding: 1%;text-align: center;color: aliceblue; ">ADMIN FULLY PAID </h3>
    </div> 
      
    
    <div class="container">
        <h2>FULLY PAID PROCESS</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Unit</th>
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
                    <td>Marian Naparan</td>
                    <td>ERV3</td>
                    <td>OTC</td>
                    <td>59,650</td>
                    <td>MARCH 30 2021</td>
                    <td>Paid</td>
                    <td></td>
                    <td></td>
                    <td class="update-button">UPDATE</td>
                </tr>
                <tr>
                    <td>Marian Naparan</td>
                    <td>ERV3</td>
                    <td>ONLINE</td>
                    <td>59,650</td>
                    <td>MARCH 30 2021</td>
                    <td>Paid</td>
                    <td></td>
                    <td></td>
                    <td class="update-button">UPDATE</td>
                </tr>
                <tr>
                    <td>Marian Naparan</td>
                    <td>ERV3</td>
                    <td>ONLINE</td>
                    <td>59,650</td>
                    <td>MARCH 30 2021</td>
                    <td>Paid</td>
                    <td></td>
                    <td></td>
                    <td class="update-button">UPDATE</td>
                </tr>
            </tbody>
        </table>
    </div>


       
</body>
</html>