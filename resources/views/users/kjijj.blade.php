


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
 <style>
    /* public/css/styles.css */

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    background-image: url('/images/background.jpg'); /* adjust the path to your image file */
  background-size: cover; /* optional */
  background-repeat: no-repeat; /* optional */
  background-position: center; /* optional */
}

.container {
    display: flex;
    justify-content: right;
    align-items: right;
    width: 100%;
}

.form-container {
    background: #fff;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
}

h2 {
    margin-bottom: 1.5rem;
    text-align: center;
}

.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
}

.form-group input {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.form-group button {
    width: 100%;
    padding: 0.75rem;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.form-group button:hover {
    background-color: #0056b3;
}

.form-footer {
    margin-top: 1rem;
    text-align: center;
}

.form-footer p {
    margin: 0;
}

.form-footer a {
    color: #007bff;
    text-decoration: none;
}

.form-footer a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
<div class="mt-4">
        @guest
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
        @endguest
    </div>

    <div class="container">
        <div class="form-container">
            <h2>Login</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input id="email" type="email" name="email" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input id="password" type="password" name="password" required>
                </div>
                <div class="form-group">
                    <button type="submit">Login</button>
                </div>
                <div class="form-footer">
                    <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>




<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
</head>
<body>
    <h1>Update Address</h1>
    <form action="/edit" method="POST">
        @csrf




        <input type="hidden" name="id" value="{{$data['id']}}">
        <input type="text" name="address_1" value="{{$data['address_1']}}" > <br> <br>
        <input type="text" name="address_2" value="{{$data['address_2']}}"> <br> <br>
        <input type="text" name="profile_id" value="{{$data['profile_id']}}" > <br> <br>
        <button type="submit">Update Address</button>
</form>
    
    
    
</body>
</html>












<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <form action="add" method="POST">
        @csrf
        
                              
                                <input value="{{ old('address_1') }}" type="text" class="@error('address_1') is-invalid @enderror form-control form-control-lg" placeholder=" Enter Address_1" name="address_1">
                                @error('address_1')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror

                                <input value="{{ old('address_2') }}" type="text" class="@error('address_1') is-invalid @enderror form-control form-control-lg" placeholder=" Enter Address_2" name="address_2">
                                @error('address_2')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror

                                <input value="{{ old('profile_id') }}" type="text" class="@error('profile_id') is-invalid @enderror form-control form-control-lg" placeholder=" Enter Profile_id" name="profile_id">
                                @error('profile_id')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
     
                                <button class="btn btn-lg btn-primary">Submit</button>
        
</form>
    
    
    
</body>
</html>




<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('migrations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('migrations');
    }
};
