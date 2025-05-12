<form action="{{ route('profile.update', $profile->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" value="{{ old('fullname', $profile->fullname) }}" required>
    </div>

    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email', $profile->email) }}" required>
    </div>

    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <small>Leave blank if you don't want to change the password</small>
    </div>

    <div>
        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="active" {{ $profile->status == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ $profile->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>

    <button type="submit">Update Profile</button>
</form>