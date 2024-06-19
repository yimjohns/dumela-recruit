<?php
session_start();
include_once '../config/Database.php';
include_once '../classes/User.php';

$database = new Database();
$db = $database->connect();
$user = new User($db);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user->username = $_POST['username'];
    $user->password = $_POST['password'];

    if($user->login()) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->username;
        $_SESSION['page'] = 'candidates/register.php';
        header('Location: dashboard/index.php');
    } else {
        echo 'Login failed!';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- <div class="form-group">
    <label>Password</label>
    <div class="input-group">
        <input type="password" id="password" class="form-control" name="password" required>
        <div class="input-group-append">
            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                <i class="fas fa-eye" id="togglePasswordIcon"></i>
            </button>
        </div>
    </div>
</div> -->

<div class="container">
    <h2>Login</h2>
    <form method="post">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        
        <!-- <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div> -->
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

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
<script src="../assets/js/script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
