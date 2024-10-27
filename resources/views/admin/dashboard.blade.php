<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
       
        
        
        /* Header styles */
        .header {
            position: absolute; /* Position the header absolutely */
            top: 20px; /* Adjust the top position */
            right: 20px; /* Adjust the right position */
            z-index: 1000; /* Ensure it is above other content */
            background-color: white; /* Optional: adds background */
            padding: 10px 20px; /* Padding around header */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Shadow for header */
            border-radius: 5px; /* Rounded corners for header */
        }
        
       

       
       

        /* Logout button styles */
        .logout-btn {
            background-color: #ff4c4c; /* Red background */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: #e63939; /* Darker red on hover */
        }

        @media (max-width: 768px) {
            .left-side {
                width: 100%;
                height: auto;
                min-height: 50vh;
            }
        }



        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Left side - Image */
        .left-side {
            width: 80%;
            height: 100vh;
            background-image: url('/images/admin.jpg'); /* Ensure this path is correct */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        /* Right side - Login/Register */
        .right-side {
            width: 20%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
          
            padding: 40px;
        }

        h1 {
            font-size: 3rem;
            color: #333;
            margin-bottom: 0px; /* Adjust margin to bring paragraph closer */
        }

        p {
            font-size: 1.2rem;
            color: #d4a373;
            margin-top: 0;
            margin-bottom: 30px; /* Adjusted spacing */
        }

        .btn-container {
            display: flex;
            flex-direction: column; /* Stack buttons vertically */
            align-items: center; /* Center the buttons */
            gap: 15px; /* Spacing between buttons */
        }

        .btn {
            width: 250px; /* Full width button */
           /*max-width: 150px; /* Restrict button width */
            padding: 10px 25px;
            background-color: #d4a373;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1.2rem;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
        }

        .btn:hover {
            background-color: #bf8e5b;
        }
    </style>
</head>
<body>
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Header with Admin Dashboard and Logout -->
    <div class="header">
        
        <a href="{{ route('logout') }}" class="logout-btn" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <!-- Left Side - Welcome Image -->
    <div class="left-side"></div>

    <!-- Right Side Content -->
    <div class="right-side">
        <h1>Welcome</h1>
        <p>To Our Website</p>

        <!-- Button Container -->
        <div class="btn-container">
            <a href="{{ route('users.index') }}" class="btn">User</a>
            <a href="{{ route('addresses.list') }}" class="btn">Address</a>
            <a href="{{ route('admin.details') }}" class="btn">View Admin Details</a>
        </div>
    </div>
</body>
</html>
