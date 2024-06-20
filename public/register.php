<?php
include_once '../config/Database.php';
include_once '../classes/User.php';

$database = new Database();
$db = $database->connect();
$user = new User($db);
$error = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];

    if (!preg_match("/^[^@]+@dumelacorp\.com$/", $username)) {
        $error = "Username must be an email ending with @dumelacorp.com";
    }

    if (!isset($error) || $error == '') {
        $user->username = $_POST['username'];
        $user->password = $_POST['password'];

        if($user->register()) {
            echo 'User registered successfully!';
        } else {
            die("It got here!");
            echo 'User registration failed!';
        }
    } else {
        echo "<div class='alert alert-danger'>$error</div>";
    }
}
?>

<?php require('../templates/header.php'); ?>
<body>
<div class="container">
    <h2>Register</h2>
    <form method="post">

        <div class="form-group">
            <label>Email (Username)</label>
            <input type="email" id="username" class="form-control" name="username" placeholder="example@dumelacorp.com" required>
            <small id="emailHelp" class="form-text text-muted">Must end with @dumelacorp.com</small>
        </div>

        <div class="form-group">
            <label>Password</label>
            <div class="input-group">
                <input type="password" id="password" class="form-control" name="password" required>
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                        <i class="fas fa-eye" id="togglePasswordIcon"></i>
                    </button>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
<script src="../assets/js/script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
