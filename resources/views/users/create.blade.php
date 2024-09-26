<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  
    <style>
        .form-container { max-width: 600px; margin: 0 auto; }
    </style></head>
  <body>

    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Profile</h3>
    </div>
    
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
        <h1>Create Profile</h1>
                    <form enctype="multipart/form-data" action="{{ route('profiles.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label h5">Name</label>
                                <input value="{{ old('name') }}" type="text" class="@error('name') is-invalid @enderror form-control-lg form-control" placeholder="Name" name="name">
                                @error('name')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Username</label>
                                <input value="{{ old('username') }}" type="text" class="@error('username') is-invalid @enderror form-control form-control-lg" placeholder="Username" name="username">
                                @error('username')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Email</label>
                                <input value="{{ old('email') }}" type="text" class="@error('email') is-invalid @enderror form-control form-control-lg" placeholder="Email" name="email">
                                @error('email')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Phone</label>
                                <input value="{{ old('phone') }}" type="text" class="@error('phone') is-invalid @enderror form-control form-control-lg" placeholder="Phone" name="phone">
                                @error('phone')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Password</label>
                                <input value="{{ old('password') }}" type="text" class="@error('password') is-invalid @enderror form-control form-control-lg" placeholder="Password" name="password">
                                @error('password')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
</div>
<div class="mb-3">
                                <label for="" class="form-label h5">Image</label>
                                <input value="{{ old('image') }}" type="file" class="@error('image') is-invalid @enderror form-control form-control-lg" placeholder="Image" name="image">
                                @error('image')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
</div>
                          

                            <div class="d-grid">
                                <button class="btn btn-lg btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
  </body>
</html>