<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
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
            background-image: url('/images/background.jpg'); /* Ensure this path is correct */
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
            width: 250px;
            padding: 15px;
            background: linear-gradient(135deg, #d4a373, #d4ac73); /* Gradient background */
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow for depth */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn:hover {
            transform: scale(1.05); /* Slight scaling on hover */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3); /* Stronger shadow on hover */
        }
    </style>
</head>
<body>


    <!-- Left Side - Welcome Image -->
    <div class="left-side"></div>

    <!-- Right Side - Login/Register -->
    <div class="right-side">
        <h1>Welcome</h1>
        <p>To Our Website</p> <!-- Paragraph directly below the heading -->

        <!-- Button Container -->
        <div class="btn-container">
            <a href="{{ route('login') }}" class="btn">Login</a>
            <a href="{{ route('register') }}" class="btn">Register</a>
        </div>
    </div>
</body>
</html>
