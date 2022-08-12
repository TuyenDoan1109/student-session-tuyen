<?php
    session_start();
    $id = $_GET['id'];
    foreach($_SESSION['students'] as $key => $student) {
        if($student['id'] == $id) {
            unset($_SESSION['students'][$key]);
        }
    }
    header('Location:index.php');
?>