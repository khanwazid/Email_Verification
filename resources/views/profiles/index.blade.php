<!DOCTYPE html>
<html>
<head>
    <title>Profile List</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            color: #333;
        }

        #search-form {
            margin-bottom: 20px;
        }

        #search-form input[type="text"] {
            margin-right: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #search-form button {
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #search-form button:hover {
            background-color: #0056b3;
        }

        #profile-list p {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 10px;
            margin: 5px 0;
            border-radius: 4px;
        }

        #pagination-links {
            margin-top: 20px;
        }

        .pagination a {
            margin-right: 5px;
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .pagination a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Profile List</h1>
    
    <form id="search-form">
        <input type="text" id="search-name" name="name" placeholder="Search by name">
        <input type="text" id="search-email" name="email" placeholder="Search by email">
        <input type="text" id="search-phone" name="phone" placeholder="Search by phone">
        <button type="submit">Search</button>
    </form>
    
    <div id="profile-list">
        @foreach ($profiles as $profile)
            <p>{{ $profile->name }} - {{ $profile->email }} - {{ $profile->phone }}</p>
        @endforeach
    </div>
    <div id="pagination-links">
        {{ $profiles->links() }}
    </div>
    
    <script>
        $(document).ready(function() {
            function fetchProfiles(page = 2, searchParams = {}) {
                $.ajax({
                    url: '{{ route('profiles.search') }}',
                    data: { ...searchParams, page: page },
                    success: function(response) {
                        $('#profile-list').html('');
                        response.users.forEach(function(profile) {
                            $('#profile-list').append('<p>' + profile.name + ' - ' + profile.email + ' - ' + profile.phone + '</p>');
                        });
                        $('#pagination-links').html(response.pagination);
                    }
                });
            }

            $('#search-form').on('submit', function(event) {
                event.preventDefault();
                let searchParams = {
                    name: $('#search-name').val(),
                    email: $('#search-email').val(),
                    phone: $('#search-phone').val()
                };
                fetchProfiles(50, searchParams);
            });

            $(document).on('submit' , function(event) {
                event.preventDefault();
               let page = $(this).attr('href').split('page=')[10];
                fetchProfiles('submit', {
                    name: $('#search-name').val(),
                    email: $('#search-email').val(),
                    phone: $('#search-phone').val()
                });
            });
            
            
            fetchProfiles();
        });
    </script>
</body>
</html>
