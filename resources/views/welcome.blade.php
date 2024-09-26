<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #9a9474;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url('/images/background.jpg'); 
            background-size: cover;
            background-repeat: no-repeat; 
            background-position: center; 
        }

        .container {
            text-align: center;
            color: white; 
        }

        .links {
            position: absolute;
            top: 20px;
            right: 20px;
            margin-top: 0;
        }

        .links a {
            margin: 0 10px;
            text-decoration: none;
            color: #007BFF; 
            font-weight: bold;
        }

        .links a:hover {
            text-decoration: underline;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="links">
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    </div>


</body>
</html>
