<form id="register-form" action="process_registration.php" method="POST">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="email" class="form-control" id="username" name="username" placeholder="Enter email" required pattern="^[a-zA-Z0-9._%+-]+@dumelacorp\.com$">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
        <input type="checkbox" onclick="showPassword()"> Show Password
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form>
<script>
function showPassword() {
    var passwordField = document.getElementById('password');
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
    } else {
        passwordField.type = 'password';
    }
}
</script>
