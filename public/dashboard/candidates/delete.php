<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['candidate_action']) && $_POST['candidate_action'] == 'delete') {
        die("We are preparing to delete the candidate.");
    }
?>