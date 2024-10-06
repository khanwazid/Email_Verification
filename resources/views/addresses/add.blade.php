<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Address</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Form and container styling */
        .container {
            max-width: 600px;
            margin-top: 50px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #e0e0e0;
        }

        /* Form header styling */
        .form-header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 10px 10px 0 0;
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* General input and dropdown styling */
        .form-control,
        .form-select {
            font-size: 0.8rem; /* Slightly smaller font for compact look */
            padding: 0.4rem; /* Reduce padding for compact inputs */
            border-radius: 5px;
            border: 1px solid #ced4da;
        }

        /* Compact dropdowns */
        .form-select-sm {
            font-size: 0.7rem;
            padding: 0.3rem;
            border-radius: 5px;
        }

        /* Label Styling */
        .form-label {
            font-size: 0.85rem;
            color: #333;
            font-weight: bold;
        }

        /* Custom styling for submit button */
        .btn {
            padding: 0.5rem;
            font-size: 0.85rem;
            border-radius: 5px;
            width: 100%;
            color: white;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        /* Adding subtle spacing */
        .mb-3 {
            margin-bottom: 1rem;
        }

        /* Styling for success alert */
        .alert {
            font-size: 0.85rem;
        }

        /* Flexbox for buttons */
        .btn-group {
            display: flex;
            justify-content: space-between;
        }

        .btn-group .btn {
            width: 48%;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="form-header">
            Add New Address
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('addresses.store') }}" method="POST">
                @csrf
                <!-- Country Dropdown -->
                <div class="mb-3">
                    <label for="country_id" class="form-label">Country</label>
                    <select name="country_id" id="country_id" class="form-select form-select-sm">
                        <option value="">Select Country</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- State Dropdown -->
                <div class="mb-3">
                    <label for="state_id" class="form-label">State</label>
                    <select name="state_id" id="state_id" class="form-select form-select-sm">
                        <option value="">Select State</option>
                    </select>
                </div>

                <!-- City Dropdown -->
                <div class="mb-3">
                    <label for="city_id" class="form-label">City</label>
                    <select name="city_id" id="city_id" class="form-select form-select-sm">
                        <option value="">Select City</option>
                    </select>
                </div>

                <!-- Address Line 1 -->
                <div class="mb-3">
                    <label for="address_line_1" class="form-label">Address Line 1</label>
                    <input type="text" name="address_line_1" id="address_line_1" class="form-control form-control-sm" required>
                </div>

                <!-- Address Line 2 -->
                <div class="mb-3">
                    <label for="address_line_2" class="form-label">Address Line 2</label>
                    <input type="text" name="address_line_2" id="address_line_2" class="form-control form-control-sm">
                </div>

                <!-- User ID -->
                <div class="mb-3">
                    <label for="user_id" class="form-label">User ID</label>
                    <input type="text" name="user_id" id="user_id" class="form-control form-control-sm">
                </div>
                
                <!-- Buttons -->
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="list" class="btn btn-secondary">Cancel</a> <!-- Modify href to point to the desired page -->
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Handle country change
        $('#country_id').on('change', function() {
            var countryId = $(this).val();
            if (countryId) {
                $.ajax({
                    url: '{{ route("get.states") }}',
                    type: 'GET',
                    data: { country_id: countryId },
                    success: function(data) {
                        $('#state_id').empty().append('<option value="">Select State</option>');
                        $.each(data, function(key, value) {
                            $('#state_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                        $('#city_id').empty().append('<option value="">Select City</option>');
                    }
                });
            } else {
                $('#state_id').empty().append('<option value="">Select State</option>');
                $('#city_id').empty().append('<option value="">Select City</option>');
            }
        });

        // Handle state change
        $('#state_id').on('change', function() {
            var stateId = $(this).val();
            if (stateId) {
                $.ajax({
                    url: '{{ route("get.cities") }}',
                    type: 'GET',
                    data: { state_id: stateId },
                    success: function(data) {
                        $('#city_id').empty().append('<option value="">Select City</option>');
                        $.each(data, function(key, value) {
                            $('#city_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#city_id').empty().append('<option value="">Select City</option>');
            }
        });
    });
</script>

</body>
</html>
