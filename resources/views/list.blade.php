<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Addresses List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 20px;
            max-width: 1000px;
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
        
        .btn-primary, .btn-edit {
            background-color: black; /* Set button background to black */
            border-color: black; /* Remove border color */
            color: white; /* Change text color to white */
        }
        .btn-primary:hover, .btn-edit:hover {
            background-color: #333; /* Darker shade on hover */
            border-color: #333; /* Darker border on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Addresses List</h1>

        <!-- Add Address Button on the right -->
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ url('add') }}" class="btn btn-primary">Add New Address</a>
        </div>

        <!-- Addresses Table -->
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Address 1</th>
                    <th>Address 2</th>
                    <th>Country ID</th>
                    <th>State ID</th>
                    <th>City ID</th>
                    <th>User ID</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
                @foreach($addresses as $address)
                    <tr>
                        <td>{{ $address['id'] }}</td>
                        <td>{{ $address['address_line_1'] }}</td>
                        <td>{{ $address['address_line_2'] }}</td>
                        <td>{{ $address['country_id'] }}</td>
                        <td>{{ $address['state_id'] }}</td>
                        <td>{{ $address['city_id'] }}</td>
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
                                <a href="{{ url('edit/'.$address['id']) }}" class="btn btn-edit btn-sm">Edit</a> <!-- Added btn-edit class -->
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
