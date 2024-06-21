<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include_once '../config/Database.php';
include_once '../classes/User.php';
include_once '../classes/Candidate.php';

$database = new Database();
$db = $database->connect();
$user = new User($db);
$candidate = new Candidate($db);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['user_action'])) {
        switch($_POST['user_action']) {
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

    if(isset($_POST['candidate_action'])) {
        switch($_POST['candidate_action']) {
            case 'create':
                $candidate->first_name = $_POST['first_name'];
                $candidate->middle_name = $_POST['middle_name'];
                $candidate->last_name = $_POST['last_name'];
                $candidate->email = $_POST['email'];
                $candidate->country = $_POST['country'];
                $candidate->state = $_POST['state'];
                $candidate->city = $_POST['city'];
                $candidate->job_title = $_POST['job_title'];
                $candidate->level = $_POST['level'];
                $candidate->resume = $_FILES['resume']['name'];

                // Handle file upload
                $target_dir = "../uploads/";
                $target_file = $target_dir . basename($_FILES["resume"]["name"]);
                if (move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {
                    $candidate->create();
                }
                break;
            case 'update':
                $candidate->id = $_POST['id'];
                $candidate->first_name = $_POST['first_name'];
                $candidate->middle_name = $_POST['middle_name'];
                $candidate->last_name = $_POST['last_name'];
                $candidate->email = $_POST['email'];
                $candidate->country = $_POST['country'];
                $candidate->state = $_POST['state'];
                $candidate->city = $_POST['city'];
                $candidate->job_title = $_POST['job_title'];
                $candidate->level = $_POST['level'];
                $candidate->resume = $_FILES['resume']['name'];

                // Handle file upload
                if ($_FILES['resume']['name']) {
                    $target_file = $target_dir . basename($_FILES["resume"]["name"]);
                    move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file);
                } else {
                    $candidate->resume = $_POST['existing_resume'];
                }

                $candidate->update();
                break;
            case 'delete':
                $candidate->id = $_POST['id'];
                $candidate->delete();
                break;
        }
    }
}

$users = $user->read();
$candidates = $candidate->read();
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
        <input type="hidden" name="user_action" value="create">
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
                        <input type="hidden" name="user_action" value="update">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="text" name="username" value="<?php echo $row['username']; ?>" required>
                        <input type="password" name="password" placeholder="New password" required>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </form>
                    <form method="post" style="display:inline-block;">
                        <input type="hidden" name="user_action" value="delete">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h3>Create Candidate</h3>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="candidate_action" value="create">
        <div class="form-group">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Middle Name</label>
            <input type="text" name="middle_name" class="form-control">
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Country</label>
            <input type="text" name="country" class="form-control" required>
        </div>
        <div class="form-group">
            <label>State</label>
            <input type="text" name="state" class="form-control" required>
        </div>
        <div class="form-group">
            <label>City</label>
            <input type="text" name="city" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Job Title</label>
            <input type="text" name="job_title" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Level</label>
            <select name="level" class="form-control" required>
                <option value="Entry">Entry</option>
                <option value="Junior">Junior</option>
                <option value="Intermediate">Intermediate</option>
                <option value="Senior">Senior</option>
            </select>
        </div>
        <div class="form-group">
            <label>Resume</label>
            <input type="file" name="resume" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Create Candidate</button>
    </form>

    <h3>Candidates</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Country</th>
                <th>State</th>
                <th>City</th>
                <th>Job Title</th>
                <th>Level</th>
                <th>Resume</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $candidates->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['middle_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['country']; ?></td>
                <td><?php echo $row['state']; ?></td>
                <td><?php echo $row['city']; ?></td>
                <td><?php echo $row['job_title']; ?></td>
                <td><?php echo $row['level']; ?></td>
                <td><a href="../uploads/<?php echo $row['resume']; ?>" target="_blank">View</a></td>
                <td>
                    <form method="post" enctype="multipart/form-data" style="display:inline-block;">
                        <input type="hidden" name="candidate_action" value="update">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="existing_resume" value="<?php echo $row['resume']; ?>">
                        <input type="text" name="first_name" value="<?php echo $row['first_name']; ?>" required>
                        <input type="text" name="middle_name" value="<?php echo $row['middle_name']; ?>">
                        <input type="text" name="last_name" value="<?php echo $row['last_name']; ?>" required>
                        <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
                        <input type="text" name="country" value="<?php echo $row['country']; ?>" required>
                        <input type="text" name="state" value="<?php echo $row['state']; ?>" required>
                        <input type="text" name="city" value="<?php echo $row['city']; ?>" required>
                        <input type="text" name="job_title" value="<?php echo $row['job_title']; ?>" required>
                        <select name="level" class="form-control" required>
                            <option value="Entry" <?php echo ($row['level'] == 'Entry') ? 'selected' : ''; ?>>Entry</option>
                            <option value="Junior" <?php echo ($row['level'] == 'Junior') ? 'selected' : ''; ?>>Junior</option>
                            <option value="Intermediate" <?php echo ($row['level'] == 'Intermediate') ? 'selected' : ''; ?>>Intermediate</option>
                            <option value="Senior" <?php echo ($row['level'] == 'Senior') ? 'selected' : ''; ?>>Senior</option>
                        </select>
                        <input type="file" name="resume">
                        <button type="submit" class="btn btn-warning">Update</button>
                    </form>
                    <form method="post" style="display:inline-block;">
                        <input type="hidden" name="candidate_action" value="delete">
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
