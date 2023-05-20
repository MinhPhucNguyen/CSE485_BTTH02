<?php
session_start();
include './include/connect.php';

if (isset($_POST['savee'])) {
    $id_t = $_POST['teacher_id'];
    $result_array = [];
    $query = "select * from teachers where id_teacher ='$id_t'";
    $query_run = mysqli_query($conn, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $row) {
            array_push($result_array, $row);
            header("Content-Type: application/json");
            echo json_encode($result_array);
        }
    }
}
if (isset($_POST['save'])) {
    $id = $_POST['edit_id'];
    $name = $_POST['name_t'];
    $email = $_POST['email_t'];
    $phone = $_POST['phone_t'];

    $sql = "update teachers set name='$name',phone='$phone',email='$email' WHERE id_teacher='$id'";
    $Result = mysqli_query($conn, $sql);
    if ($Result) {
        $_SESSION['status'] = "success";

        header("Location: teacher_profile.php");
    } else {
        $_SESSION['status'] = "not found";
        die(mysqli_error($conn));
    }
}