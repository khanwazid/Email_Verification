<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<!-- Display Success Messages -->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Address List -->
<h3>Addresses</h3>
<form action="/address/{{ $address->id }}" method="POST">
<ul>
    @foreach(Auth::profile()->addresses as $address)
        <li>
            {{ $address->street }}, {{ $address->city }}, {{ $address->state }}, {{ $address->zip }}
            <button data-id="{{ $address->id }}" data-address="{{ json_encode($address) }}" class="edit-btn">Edit</button>
            <form action="{{ route('address.destroy', $address) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
    @endforeach
</ul>

<!-- Add Address Form -->
<h3>Add Address</h3>
<form action="{{ route('address.store') }}" method="POST">
    @csrf
    <input type="text" name="address_1" placeholder="address_1" value="{{ old('address_1') }}" required>
    <input type="text" name="address_2" placeholder="address_2" value="{{ old('address_2') }}" required>
    
    <button type="submit">Add Address</button>
</form>

<!-- Edit Address Form (Hidden by default) -->
<div id="edit-form" style="display:none;">
    <h3>Edit Address</h3>
    <form id="update-address-form" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="address_1" id="edit-address_1" required>
        <input type="text" name="address_2" id="edit-address_2" required>
     
        <input type="hidden" name="address_id" id="edit-address-id">
        <button type="submit">Update Address</button>
    </form>
</div>

<script>
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', (e) => {
            const address = e.target.dataset.address;
            const addressObj = JSON.parse(address);
            document.getElementById('edit-address_1').value = addressObj.address_1;
            document.getElementById('edit-address_2').value = addressObj.address_2;
           
            document.getElementById('edit-address-id').value = addressObj.id;
            document.getElementById('edit-form').style.display = 'block';
            document.getElementById('update-address-form').action = `/address/${addressObj.id}`;
        });
    });
</script>
, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>