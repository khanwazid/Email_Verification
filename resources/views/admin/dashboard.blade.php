<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        /* Header styles */
        .header {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 1000;
            background-color: white;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
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
            color: #000000;
            margin-bottom: 0;
        }

        p {
            font-size: 1.2rem;
            color: 	#0000ff;
            margin-top: 0;
            margin-bottom: 30px;
        }

        .btn-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        /* Updated button style to match the design */
        .btn {
            width: 250px;
            padding: 15px;
            background: linear-gradient(135deg, #007bff, #0056b3); /* Gradient background */
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
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Left Side - Welcome Image -->
    <div class="left-side"></div>

    <!-- Right Side Content -->
    <div class="right-side">
        <h1>Welcome</h1>
        <p>To Our Website</p>

        <!-- Button Container -->
        <div class="btn-container">
            <a href="{{ route('users.search') }}" class="btn">Users List</a>
            <a href="{{ route('addresses.list') }}" class="btn">Addresses List</a>
            <a href="{{ route('profile.show') }}" class="btn">View Admin Profile</a>
        </div>
        @if (!auth()->user()->isAdmin())
        <div class="addresses-section">
            <h2>Edit or Remove Addresses</h2>
            <!-- Your edit/remove addresses code -->
        </div>

        <div class="addresses-list">
            <h2>Addresses</h2>
            <!-- Your addresses listing code -->
        </div>
    @endif
</div>
    </div>
</body>
</html>
