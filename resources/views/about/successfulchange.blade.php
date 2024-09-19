<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }
        
        button {
            padding: 10px;
            width: 10%;
            cursor: pointer;
        }

        .headerrr{
         padding: 2%;
        }

        .headerr {
            background-color: #34a853;
            color: white;
            padding: 20px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }
        
    </style>
</head>
<header class="headerrr">
            <nav>
                <ul>
                    <a href="{{ route('about.layout') }}">
                        <img src="/image/billnwow-logo.png" class="billnwow-logo" alt="NWOW Philippines Storefront" style="margin-top:-1.3%">
                    </a>
                </ul>
            </nav>
        </header>  
<body>
    <div class="container">
        <h2>Successfully change</h2>
        <div class="divider"></div>
        <button onclick="redirectToRoute()">Back</button>

    <script>
       function redirectToRoute() {
            window.location.href = "{{ route('about.layout') }}";
        }
    </script>
</body>
</html>
