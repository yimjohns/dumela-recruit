<?php
session_start();

$_SESSION['user_id'] = $_POST['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $resume = $_FILES['resume'];

    // Validate email format
    if (!preg_match("/^[a-zA-Z0-9._%+-]+@dumelacorp\.com$/", $username)) {
        $_SESSION['status'] = [
            'type' => 'error',
            'message' => 'Invalid email format. Email must end with @dumelacorp.com.'
        ];
        header('Location: dashboard/candidates/?page=register');
        exit;
    }

    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'dumela_recruit');
    if ($conn->connect_error) {
        $_SESSION['status'] = [
            'type' => 'error',
            'message' => 'Database connection failed: ' . $conn->connect_error
        ];
        header('Location: dashboard/candidates/?page=register');
        exit;
    }

    // Check if the user already exists
    $stmt = $conn->prepare("SELECT id FROM test WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['status'] = [
            'type' => 'error',
            'message' => 'User already exists.'
        ];
        $stmt->close();
        $conn->close();
        header('Location: dashboard/candidates/?page=register');
        exit;
    }

    $stmt->close();

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($resume["name"]);
    $uploadOk = 1;

    // Check if file already exists
    if (file_exists($target_file)) {
        $_SESSION['status'] = [
            'type' => 'error',
            'message' => 'Sorry, file already exists.'
        ];
        $uploadOk = 0;
    }

    // Check file size
    if ($resume["size"] > 5000000) { // 5MB limit
        $_SESSION['status'] = [
            'type' => 'error',
            'message' => 'Sorry, your file is too large.'
        ];
        $uploadOk = 0;
    }

    // Allow certain file formats
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if($fileType != "pdf" && $fileType != "doc" && $fileType != "docx") {
        $_SESSION['status'] = [
            'type' => 'error',
            'message' => 'Sorry, only PDF, DOC, & DOCX files are allowed.'
        ];
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        header('Location: dashboard/candidates/?page=register');
        exit;
    } else {
        // Try to upload file
        if (move_uploaded_file($resume["tmp_name"], $target_file)) {
            // Insert the new user into the database
            $stmt = $conn->prepare("INSERT INTO test (username, password, resume) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $hashedPassword, $target_file);

            if ($stmt->execute()) {
                $_SESSION['status'] = [
                    'type' => 'success',
                    'message' => 'User registered successfully.'
                ];
            } else {
                $_SESSION['status'] = [
                    'type' => 'error',
                    'message' => 'Error: ' . $stmt->error
                ];
            }

            $stmt->close();
            $conn->close();

            header('Location: dashboard/candidates/?page=register');
            exit;
        } else {
            $_SESSION['status'] = [
                'type' => 'error',
                'message' => 'Sorry, there was an error uploading your file.'
            ];
            header('Location: dashboard/candidates/?page=register');
            exit;
        }
    }
}
?>


