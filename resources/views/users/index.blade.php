<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 20px;
            max-width: 800px;
        }
        .table {
            border-radius: 8px;
            overflow: hidden;
            
        }
        th, td {
            text-align: left;
            padding: 12px;
        }
        th {
            background-color: #343a40;
            color: white;
        }
        td img {
            border-radius: 50%;
            border: 2px solid #343a40;
        }
        .search-form {
            margin-bottom: 20px;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .btn-primary {
            background-color: black; /* Set button background to black */
            border-color: black; /* Remove border color */
            color: white; /* Change text color to white */
        }
        .btn-primary:hover {
            background-color: #333; /* Darker shade on hover */
            border-color: #333; /* Darker border on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Users</h1>
        <form action="search" method="get" class="search-form">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search with name" name="search" 
                value="{{ $search ?? '' }}" />
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </form>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Gender</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->image)
                                <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Image" style="width: 50px; height: 50px;">
                            @else
                                <img src="{{ asset('storage/default.png') }}" alt="Default Image" style="width: 50px; height: 50px;">
                            @endif
                        </td>
                        <td>{{ ucfirst($user->gender) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
       
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
