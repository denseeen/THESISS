<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archived</title>
    
    <!-- Stylesheets -->
    <link href="{!! url('css/admin/adminarchived.css') !!}" rel="stylesheet">
    <link href="{{ url('css/admin/topnav_sidenav.css') }}" rel="stylesheet">
 
    
    <!-- Font Awesome for icons (sideNav-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
</head>
<body>

    <!-- TopNav -->
    
    <div class="wrapper hover_collapse">
    <!-- Top Navbar -->
    <nav class="top_navbar">

    <a href="{{ route('cusdasboard.show') }}" class="TopNav-BillnWoWlogo">
    
            <img src="/image/logoBillnWow3.png" alt="BillnWoWLogo">
       
    </a>
    <!-- <h3 class="navbar-text">Anonas</h3> -->
<div class="icons">
    
</ul>
    <!-- Dark Mode -->
    <div class="icon sun-icon" onclick="toggleDarkModeDashboard()">
        <img src="/image/7721593.png" alt="Sun Icon">
    </div>
    <div class="icon profile-icon img" onclick="toggleDropdown()">   
        <img src="/image/4174470.png" alt="Profile Icon">
        <!-- <span class="profile-text">Account Profile</span> -->
        <!-- Dropdown -->
        <div class="dropdown-menu" id="dropdownMenu">
            <a href="{{ route('cusprofile.show') }}">Profile</a>
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

// Dark Mode
function toggleDarkModeDashboard() {
    document.body.classList.toggle('dark-mode');
    document.querySelectorAll('').forEach(item => {
        item.classList.toggle('dark-mode');
    });
}
    // Dropdown
    
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

</body>
</html>