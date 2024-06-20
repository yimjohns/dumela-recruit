<?php
    session_start();
    if(!isset($_SESSION['user_id'])) {
        header('Location: ../login.php');
        exit;
    }

    include_once '../../config/Database.php';
    include_once '../../classes/User.php';
    include_once '../../classes/Candidate.php';

    $database = new Database();
    $db = $database->connect();
    $user = new User($db);
    $candidate = new Candidate($db);



    $candidates = $candidate->read();

    // if(isset($_POST['candidate_action'])){
    //     if($_POST['candidate_action'] == 'update'){
    //         $_SESSION['page'] = 'candidates/update.php';
    //         include 'candidates/update.php';
    //     }
    // }


?>

<h3>Candidates</h3>
    <table class="table">
        <thead>
            <tr>
                <!-- <th>ID</th> -->
                <th>First Name</th>
                <!-- <th>Middle Name</th> -->
                <th>Last Name</th>
                <!-- <th>Email</th> -->
                <th>Country</th>
                <th>State</th>
                <!-- <th>City</th> -->
                <th>Job Title</th>
                <th>Level</th>
                <th>Resume</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $candidates->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <!-- <td><?php // echo $row['id']; ?></td> -->
                <td><?php echo $row['first_name']; ?></td>
                <!-- <td><?php // echo $row['middle_name']; ?></td> -->
                <td><?php echo $row['last_name']; ?></td>
                <!-- <td><?php // echo $row['email']; ?></td> -->
                <td><?php echo $row['country']; ?></td>
                <td><?php echo $row['state']; ?></td>
                <!-- <td><?php // echo $row['city']; ?></td> -->
                <td><?php echo $row['job_title']; ?></td>
                <td><?php echo $row['level']; ?></td>
                <td><a href="../../uploads/<?php echo $row['resume']; ?>" target="_blank">View</a></td>
                <td>
                    <form method="get" enctype="multipart/form-data" style="display:inline-block;">
                        <input type="hidden" name="candidate_action" value="update">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="existing_resume" value="<?php echo $row['resume']; ?>">
                    <button type="submit" class="btn btn-outline-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                        </svg> Update
                    </button>
                    <!-- onclick="loadUpdateForm(<?php // echo $row['id']; ?>)" -->

                    </form>
                    <form method="post" style="display:inline-block;">
                        <input type="hidden" name="candidate_action" value="delete">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn btn-outline-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                            </svg> Delete
                        </button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>


    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sure you want to delete?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Delete" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript function to load the update form dynamically
        // function loadUpdateForm(candidateId) {
        //     $.ajax({
        //         url: 'candidates/update.php',
        //         type: 'GET',
        //         data: { id: candidateId },
        //         success: function(response) {
        //             $('#main-content').html(response);
        //         },
        //         error: function() {
        //             alert('Error loading the update form.');
        //         }
        //     });
        // }
    </script>