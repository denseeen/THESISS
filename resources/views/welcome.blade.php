<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website Title</title>
    <link href="{{ asset('/css/common.css') }}" rel="stylesheet"> </head>
<body>  
    
     
      </div>
        <nav>
            <ul>
                <li><button onclick="document.getElementById('id01').style.display='block'" >Login</button>
                
                </li>
                <li><a href="#">Home</a></li>
                <li><a href="#">Contract</a></li>
                <li><a href="#">Branches</a></li>
                <li><a href="#">About</a></li>                 
            </ul>          
        </nav>
      
        <div id="id01"  class="modal">
            <form class="modal-content animate" action="/action_page.php" method="post">
              <h1>BillnWow</h1>
           
              <div class="container">
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uname" required>
           
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>
                 
                <button type="submit">Login</button>
                <label>
                  <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
              </div>
           
              <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                <span class="psw"> <a href="#">forgot password?</a></span>
              </div>

             
</body>
</html>