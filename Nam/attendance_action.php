<?php

//attendance_action.php

include('database_connection.php');
session_start();
$output = '';
if (isset($_POST["action"])) {
    if ($_POST["action"] == 'fetch') {
        $query = "
  SELECT * FROM tbl_attendance 
  INNER JOIN tbl_student 
  ON tbl_student.student_id = tbl_attendance.student_id 
  INNER JOIN tbl_grade 
  ON tbl_grade.grade_id = tbl_student.student_grade_id 
  WHERE tbl_attendance.teacher_id = '" . $_SESSION["teacher_id"] . "' AND (";
        if (isset($_POST["search"]["value"])) {
            $query .= 'tbl_student.student_name LIKE "%' . $_POST["search"]["value"] . '%" 
      OR tbl_student.student_roll_number LIKE "%' . $_POST["search"]["value"] . '%" 
      OR tbl_attendance.attendance_status LIKE "%' . $_POST["search"]["value"] . '%" 
      OR tbl_attendance.attendance_date LIKE "%' . $_POST["search"]["value"] . '%") ';
        }
        if (isset($_POST["order"])) {
            $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $query .= 'ORDER BY tbl_attendance.attendance_id DESC ';
        }
        if ($_POST["length"] != -1) {
            $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $data = array();
        $filtered_rows = $statement->rowCount();
        foreach ($result as $row) {
            $sub_array = array();
            $status = '';
            if ($row["attendance_status"] == 'Present') {
                $status = '<label class="badge badge-success">Present</label>';
            }
            if ($row["attendance_status"] == 'Absent') {
                $status = '<label class="badge badge-danger">Absent</label>';
            }

            $sub_array[] = $row["student_name"];
            $sub_array[] = $row["student_roll_number"];
            $sub_array[] = $row["grade_name"];
            $sub_array[] = $status;
            $sub_array[] = $row["attendance_date"];
            $data[] = $sub_array;
        }

        $output = array(
            "draw"    => intval($_POST["draw"]),
            "recordsTotal"  =>  $filtered_rows,
            "recordsFiltered" => get_total_records($connect, 'tbl_attendance'),
            "data"    => $data
        );
        echo json_encode($output);
    }
}
