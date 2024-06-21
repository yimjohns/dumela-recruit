<!DOCTYPE html>
<html>
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Loader CSS */
        #loader {
            position: fixed;
            left: 50%;
            top: 50%;
            z-index: 1;
            width: 100px;
            height: 100px;
            margin: -50px 0 0 -50px;
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Add animation to "page content" */
        .animate-bottom {
            position: relative;
            -webkit-animation-name: animatebottom;
            -webkit-animation-duration: 1s;
            animation-name: animatebottom;
            animation-duration: 1s;
        }

        @-webkit-keyframes animatebottom {
            from { bottom: -100px; opacity: 0; }
            to { bottom: 0px; opacity: 1; }
        }

        @keyframes animatebottom {
            from { bottom: -100px; opacity: 0; }
            to { bottom: 0; opacity: 1; }
        }

        #content {
            display: none;
        }
    </style>
</head>
<body onload="myFunction()">

<!-- Loader HTML -->
<div id="loader"></div>

<div id="content" class="animate-bottom">
    <div class="container">
        <!-- Existing content -->

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
                        <a href="update_candidate.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Update</a>
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
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function myFunction() {
        setTimeout(showPage, 1000);
    }

    function showPage() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("content").style.display = "block";
    }
</script>

</body>
</html>
