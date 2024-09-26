<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Addresses List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f8f9fa;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }
        .table th {
            background-color: #343a40;
            color: white;
        }
        .button-group {
            display: flex;
            align-items: center;
        }
        tbody tr:hover {
            background-color: #e9ecef; 
        }
    </style>
</head>
<body>
    <h1>Addresses List</h1>
    <div class="container">
        <!-- Add Address Button on the right -->
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ url('add') }}" class="btn btn-primary">Add New Address</a>
        </div>

        <!-- Addresses Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Address 1</th>
                    <th>Address 2</th>
                    <th>User ID</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
                @foreach($addresses as $address)
                    <tr>
                        <td>{{ $address['id'] }}</td>
                        <td>{{ $address['address_1'] }}</td>
                        <td>{{ $address['address_2'] }}</td>
                        <td>{{ $address['user_id'] }}</td>
                        <td>
                            <div class="button-group">
                                <!-- Delete Form -->
                                <form action="{{ url('delete/'.$address['id']) }}" method="GET" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                <!-- Edit Link -->
                                <a href="{{ url('edit/'.$address['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                            </div>
                        </td>
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
