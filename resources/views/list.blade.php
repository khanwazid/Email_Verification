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
        
      .btn-edit {
            background-color: black; /* Set button background to black */
            border-color: black; /* Remove border color */
            color: white; /* Change text color to white */
        }
        .btn-edit:hover {
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
        <h1 class="mb-4">Addresses List</h1>

       <div class="d-flex justify-content-end mb-3">
    <a href="{{ url('/admin/dashboard') }}" class="btn btn-custom-blue">Back</a>
</div>
<div class="d-flex justify-content-end mb-3">
    <a href="{{ url('/add') }}" class="btn bg-success text-white">Add A New Address</a>
</div>
@if(session('delete'))
    <div class="alert alert-danger" id="delete-message">
        {{ session('delete') }}
    </div>
@endif

@if(session('update'))
    <div class="alert alert-success" id="update-message">
        {{ session('update') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger" id="error-message">
        {{ session('error') }}
    </div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Address_1</th>
            <th>Address_2</th>
            <th>CountryName</th> <!-- Updated header -->
            <th>StateName</th>   <!-- Updated header -->
            <th>CityName</th>    <!-- Updated header -->
            <th>Name</th>
            <th>Operation</th>
        </tr>
    </thead>
    
    <tbody>
        @foreach($addresses as $address)
            <tr>
                <td>{{ $address['id'] }}</td>
                <td>{{ $address['address_line_1'] }}</td>
                <td>{{ $address['address_line_2'] }}</td>
            {{--  <td>{{ $address->city->state->country->name ?? 'N/A' }}</td> <!-- Accessing country name -->
                <td>{{ $address->city->state->name ?? 'N/A' }}</td> <!-- Accessing state name -->
                <td>{{ $address->city->name }}</td> <!-- Accessing city name -->--}}
                <td>{{ $address->city && $address->city->state && $address->city->state->country ? $address->city->state->country->name : 'N/A' }}</td>
                <td>{{ $address->city && $address->city->state ? $address->city->state->name : 'N/A' }}</td>
                <td>{{ $address->city ? $address->city->name : 'N/A' }}</td>

                {{-- <td>{{ $address['user_id'] }}</td>--}}
              <td> <a href="#" class="user-link text-dark font-weight-normal"  data-toggle="modal" data-target="#userModal" data-user-name="{{ $address->user->name ?? 'N/A' }}" data-user-id="{{ $address->user->id ?? 'N/A' }}" data-user-email="{{ $address->user->email ?? 'N/A' }}">
                                 {{-- {{ $address->user->name ?? 'N/A' }} --}}

                                {{ $address->user ? $address->user->name : 'N/A' }}
                            </a>
                <td>
                    <div class="button-group">
                        <!-- Delete Form -->
                        <form action="{{ url('delete/'.$address['id']) }}" method="GET" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        <!-- Edit Link -->
                        <a href="{{ url('edit/'.$address['id']) }}" class="btn btn-edit btn-sm">Edit</a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-end">
    {{ $addresses->links() }} <!-- This generates pagination links -->
</div>
    </div>
  <!-- User Modal -->
  <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">User Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Name:</strong> <span id="modal-user-name"></span></p>
                    <p><strong>ID:</strong> <span id="modal-user-id"></span></p>
                    <p><strong>Email:</strong> <span id="modal-user-email"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

        
    </div>

   

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
   
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('#delete-message').fadeOut('slow');
            $('#update-message').fadeOut('slow');
            $('#error-message').fadeOut('slow');
        }, 3000); // Delay in milliseconds (3 seconds)
        $('.user-link').click(function() {
                $('#modal-user-name').text($(this).data('user-name'));
                $('#modal-user-id').text($(this).data('user-id'));
                $('#modal-user-email').text($(this).data('user-email'));
            }); });
</script>
</body>
</html>
