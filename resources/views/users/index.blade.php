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
        .btn-custom-blue {
    background-color: #0066cc;
    color: white;
    transition: all 0.3s ease;
}

.btn-custom-blue:hover {
    background-color: #0052a3;
    color: white;
    transform: translateY(-1px);
}
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Users</h1>
        @if(session('error'))
    <div id="error-message" class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
        <form action="search" method="get" class="search-form">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search with name" name="search" 
                value="{{ $search ?? '' }}" />
                
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </form>
        <div class="d-flex justify-content-end mb-3">
    <a href="{{ url('/admin/dashboard') }}" class="btn btn-custom-blue">Back</a>
</div>

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
                               {{-- <img src="{{ asset('storage/default.png') }}" alt="Default Image" style="width: 50px; height: 50px;">--}}
                              {{-- <div style="display: flex; align-items: center;">
    <img src="{{ asset('storage/default.png') }}" alt="Default Image" style="width: 50px; height: 50px; border-radius: 0;">
    <span style="margin-left: 10px; font-size: 0.8rem; color: #888;">No profile picture uploaded.</span>
</div>--}}

                               <div style="display: flex; align-items: center;">
    <img src="{{ asset('storage/default.png') }}" alt="Default Image" style="width: 50px; height: 50px;">
    <span style="margin-left: 10px; font-size: 0.8rem; color: #888;">No profile picture uploaded.</span>
</div>
                            @endif
                        </td>
                      {{--  <td>{{ ucfirst($user->gender) }}</td>--}}
                        <td>{{ $user->gender == 0 ? 'Male' : 'Female' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
       
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    $(document).ready(function() {
        // Check if the error message exists
        if ($('#error-message').length) {
            // Set a timeout to fade out the message after 3 seconds
            setTimeout(function() {
                $('#error-message').fadeOut('slow');
            }, 3000); // 3000 milliseconds = 3 seconds
        }
    });
</script>
</body>
</html>
