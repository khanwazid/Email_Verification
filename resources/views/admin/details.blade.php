<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Details</title>
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
        tr:hover {
            background-color: #f1f1f1;
        }
        .btn-primary {
            background-color: black;
            border-color: black;
            color: white;
        }
        .btn-primary:hover {
            background-color: #333;
            border-color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Admin Details</h1>

        <!-- Admin Details Table -->
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Field</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Name</td>
                    <td>{{ $admin->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $admin->email }}</td>
                </tr>
                
                <tr>
                    <td>Role</td>
                    <td>{{ $admin->role }}</td>
                </tr>
            </tbody>
        </table>

      {{--  <!-- Conditional Display for Admin Role -->
        @if($admin->role === 'admin')
            <p class="alert alert-success mt-3">This user is an Admin.</p>
        @endif--}}
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
