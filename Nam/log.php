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
    echo '<div class="card-body">
    <h5>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id_student</th>
                    <th scope="col">name</th>
                    <th scope="col">state</th>
                    <th scope="col">time</th>


                </tr>
            </thead>
            <tbody>';
    $cod_c = $_POST['cod_c'];
    $id_c = $_POST['id_class'];

    $sql = "SELECT s.id_std AS id , s.name, a.code_course, a.state, CAST(a.time_attendance AS DATE) AS dates FROM students s INNER JOIN attendance AS a ON s.id_std = a.id_std";
    $result = mysqli_query($conn, $sql);
    $data = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $status = '';
        if ($row["state"] == 'present') {
            $status = '<span class="badge bg-success">Present</span>';
        } elseif ($row["state"] == 'absent') {
            $status = '<label class="badge bg-danger">Absent</label>';
        }

        $data[] = array(
            $row["id"],
            $row["name"],
            $status,
            $row["dates"]
        );
    }

    if (mysqli_num_rows($result) > 0) {
        foreach ($data as $row) {
            echo $return = '<tr>
            <td>' . $row[0] . '</td>
            <td>' . $row[1] . '</td>
            <td>' . $row[2] . '</td>
            <td>' . $row[3] . '</td>
            </tr>';
        }
    }
    echo '</tbody>
    </table>
</h5>
</div>';
}


if (isset($_POST['save_cre'])) {

    $cod_c = $_POST['cod_cou'];
    $id_c = $_POST['id_cla'];
    $dates = date('Y-m-d H:i:s', strtotime($_POST['s_date']));
    $datee = date('Y-m-d H:i:s', strtotime($_POST['e_date']));
    $sql = "INSERT INTO attend_time (code_course,id_class , time_start, time_end) VALUES ('$cod_c','$id_c','$dates','$datee')";
    $Result = mysqli_query($conn, $sql);
    if ($Result) {
        $_SESSION['status'] = "success";
        header("Location: teacher_profile.php");
    } else {
        $_SESSION['status'] = "not found";
        header("Location: teacher_profile.php");
    }
}
