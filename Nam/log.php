<?php
session_start();
// $id_c = $_SESSION['id_class'];
// $cod_c = $_SESSION['code_course'];


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

if (isset($_POST['vieww'])) {
    header("Location: list_student.php");
}


if (isset($_POST['save_date'])) {
    $cod_c = $_POST['$cod_c'];
    $id_c = $_POST['id_class'];
    $dates = date('Y-m-d H:i:s', strtotime($_POST['s_date']));
    $datee = date('Y-m-d H:i:s', strtotime($_POST['e_date']));
    $sql = "INSERT INTO attend_time (code_course,id_class , time_start, time_end) VALUES ('$cod_c','$id_c','$dates','$datee')";
    $Result = mysqli_query($conn, $sql);
    if ($Result) {
        $_SESSION['status'] = "success";
        header("Location: list_student.php");
    } else {
        $_SESSION['status'] = "not found";
        header("Location: list_student.php");
    }
}
