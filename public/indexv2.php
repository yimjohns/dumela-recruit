<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include_once '../config/Database.php';
include_once '../classes/User.php';

$database = new Database();
$db = $database->connect();
$user = new User($db);

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    switch($_POST['action']) {
        case 'create':
            $user->username = $_POST['username'];
            $user->password = $_POST['password'];
            $user->register();
            break;
        case 'update':
            $user->id = $_POST['id'];
            $user->username = $_POST['username'];
            $user->password = $_POST['password'];
            $user->update();
            break;
        case 'delete':
            $user->id = $_POST['id'];
            $user->delete();
            break;
    }
}

$users = $user->read();
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <p>This is your dashboard.</p>
    <a href="logout.php" class="btn btn-primary">Logout</a>

    <h3>Create User</h3>
    <form method="post">
        <input type="hidden" name="action" value="create">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Create User</button>
    </form>

    <h3>Users</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $users->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['created_at']; ?></td>
                <td>
                    <form method="post" style="display:inline-block;">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="text" name="username" value="<?php echo $row['username']; ?>" required>
                        <input type="password" name="password" placeholder="New password" required>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </form>
                    <form method="post" style="display:inline-block;">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
