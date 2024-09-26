<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Address</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        button:hover {
            background-color: #218838;
        }
        .alert {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 4px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container mt-5">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form   action="{{ url('add') }}" method="POST">
                @csrf
              
                <input 
                    type="text" 
                    name="address_1" 
                    placeholder="Enter Address_1" 
                    value="{{ old('address_1') }}" 
                    class="@error('address_1') is-invalid @enderror"
                >
                @error('address_1')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror

                <input 
                    type="text" 
                    name="address_2" 
                    placeholder="Enter Address_2" 
                    value="{{ old('address_2') }}" 
                    class="@error('address_2') is-invalid @enderror"
                >
                @error('address_2')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror

                <input 
                    type="text" 
                    name="user_id" 
                    placeholder="Enter User_id" 
                    value="{{ old('user_id') }}" 
                    class="@error('user_id') is-invalid @enderror"
                >
                @error('profile_id')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror

                <button type="submit" class="btn btn-lg btn-primary">Submit</button>
            
            </form>
        </div>
    </div>
    
   
    
</body>

</html>
