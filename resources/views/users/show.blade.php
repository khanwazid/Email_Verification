<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users and Their Addresses</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 20px;
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .card-header {
            background-color: #f7f7f7;
            border-bottom: 1px solid #ddd;
        }
        .img-fluid {
            max-height: 150px;
            object-fit: cover;
        }
        .list-group-item {
            border: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Users and Their Addresses</h1>
        <div class="row">
            @foreach($users as $user)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">{{ $user->name }}</h5>
                        </div>
                        <div class="card-body">
                            <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}" class="img-fluid mb-3" />
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <p><strong>Username:</strong> {{ $user->username }}</p>
                            <p><strong>Phone:</strong> {{ $user->phone_number }}</p>
                            <p><strong>Gender:</strong> {{ ucfirst($user->gender) }}</p>

                            <h6>Addresses:</h6>
                            @if($user->address->isEmpty())
                                <p>No address available.</p>
                            @else
                                <ul class="list-group">
                                    @foreach($user->addresses as $address)
                                        <li class="list-group-item">
                                            {{ $address->address_1 }} @if($address->address_2), {{ $address->address_2 }} @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
