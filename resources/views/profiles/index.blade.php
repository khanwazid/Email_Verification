<!DOCTYPE html>
<html>
<head>
    <title>Profile List</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            function fetchProfiles(page = 1, searchParams = {}) {
                $.ajax({
                    url: '{{ route('profiles.search') }}',
                    data: { ...searchParams, page: page },
                    success: function(response) {
                        $('#user-list').html('');
                        response.users.forEach(function(profile) {
                            $('#user-list').append('<p>' + profile.name + ' - ' + profile.email + ' - ' + profile.phone + '</p>');
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
                fetchProfiles(1, searchParams);
            });

            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                fetchProfiles(page, {
                    name: $('#search-name').val(),
                    email: $('#search-email').val(),
                    phone: $('#search-phone').val()
                });
            });
            
            // Initial fetch
            fetchProfiles();
        });
    </script>
</body>
</html>
