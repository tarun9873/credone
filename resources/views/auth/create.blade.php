<h2>Create User</h2>

<form method="POST" action="/users/store">
@csrf

<input type="text" name="name" placeholder="Name"><br><br>
<input type="email" name="email" placeholder="Email"><br><br>
<input type="password" name="password" placeholder="Password"><br><br>

<select name="role">
    @if(auth()->user()->role == 'super_admin')
        <option value="admin">Admin</option>
    @endif
    <option value="employee">Employee</option>
</select>

<br><br>
<button type="submit">Create</button>

</form>
