<?php
session_start();
include('./layouts/assets/header.php');
$sql = "SELECT * FROM students WHERE id_std = 1 LIMIT 1";
$query = $conn->prepare($sql);
$query->execute();
$student = $query->fetch();
$_SESSION['student'] = $student;
// var_dump($_SESSION['student']);

$sql = "SELECT * FROM courses";
$query = $conn->prepare($sql);
$query->execute();
$courses = $query->fetchAll();

$sql = "SELECT * FROM attendance";
$query = $conn->prepare($sql);
$query->execute();
$attendanceList = $query->fetchAll();

if (isset($_POST['registerBtn'])) {
    $id_std = $_SESSION['student']['id_std'];
    $id_class  = $_POST['id_class'];
    $courseCode = $_POST['code_course'];

    $sql = "INSERT INTO registered (id_std, id_class, code_course) VALUES (?,?,?)";
    $query = $conn->prepare($sql);
    $query->bindValue(1, $id_std, PDO::PARAM_INT);
    $query->bindValue(2, $id_class, PDO::PARAM_STR);
    $query->bindValue(3, $courseCode, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() > 0) {
        $_SESSION['success'] = "Register class successfully";
        Header("Location: registered.php");
    } else {
        $_SESSION['error'] = "Register class failed";
        Header("Location: registered.php");
    }
}

if (isset($_POST['attendence-btn'])) {
    $codeCourse = $_POST['code_course'];
    $idStudent =  $_SESSION['student']['id_std'];
    $idClass =  $_POST['id_class'];
    $timeAttendance = date('Y-m-d H:i:s', strtotime($_POST['timeClass']));
    $state = $_POST['radio'];

    $sql = "INSERT INTO attendance(code_course, id_std, id_class, time_attendance, state) VALUES (?,?,?,?,?)";
    $query = $conn->prepare($sql);
    $query->bindValue(1, $codeCourse, PDO::PARAM_STR);
    $query->bindValue(2, $idStudent, PDO::PARAM_INT);
    $query->bindValue(3, $idClass, PDO::PARAM_STR);
    $query->bindValue(4, $timeAttendance, PDO::PARAM_STR);
    $query->bindValue(5, $state, PDO::PARAM_INT);
    $query->execute();

    if ($query->rowCount() > 0) {
        $_SESSION['success'] = "Attendance successfully";
        header("Location: attendance.php");
    }
}

?>

<div class="d-flex flex-column float-end" style="width: calc(100% - 280px)">
    <?php include('../CSE485_BTTH02/layouts/includes/topbar.php') ?>

    <!-- Main content -->
    <div class="container-fluid mt-4">
        <?php
        if (isset($_SESSION['success'])) {
        ?>
            <div class="alert alert-success alert-dismissible fade show fw-bolder" role="alert">
                <?= $_SESSION['success'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            unset($_SESSION['success']);
        }
        ?>
        <div class="card">
            <div class="card-header">
                <h3>Attendence</h3>
            </div>
            <div class="card-body">
                <h4 class="text-warning mb-4">Choose a class in the course to take attendance </h4>
                <div class="row">
                    <div class="col-3">
                        <div class="list-group" id="list-tab" role="tablist">
                            <?php
                            foreach ($courses as $course) {
                            ?>
                                <a class="list-group-item list-group-item-action" id="list-<?= $course['code_course'] ?>-list" data-bs-toggle="list" href="#list-<?= $course['code_course'] ?>" role="tab" aria-controls="list-<?= $course['code_course'] ?>">
                                    <strong> <?= $course['course_name'] ?></strong>
                                    </br>
                                    <small>
                                        <?= $course['code_course'] ?>
                                    </small>
                                </a>
                            <?php
                            }

                            ?>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="tab-content " id="nav-tabContent">
                            <?php
                            foreach ($courses as $course) {
                            ?>
                                <div class="tab-pane fade show" id="list-<?= $course['code_course'] ?>" role="tabpanel" aria-labelledby="list-<?= $course['code_course'] ?>-list">
                                    <div class="border rounded-bottom">
                                        <?php

                                        $sql = "SELECT c.*, a.time_start, a.time_end, r.state FROM classes as c 
                                        INNER JOIN attend_time as a ON c.code_course = a.code_course AND c.id_class = c.id_class 
                                        INNER JOIN registered as r ON c.code_course = r.code_course AND c.id_class = r.id_class WHERE c.code_course = ?";

                                        $query = $conn->prepare($sql);
                                        $query->bindValue(1, $course['code_course']);
                                        $query->execute();
                                        $classes = $query->fetchAll();
                                        // var_dump($classes);
                                        foreach ($classes as $class) {
                                            $isAttendanced = false;
                                            foreach ($attendanceList as $attendance) {
                                                if (($attendance['code_course'] == $class['code_course'])
                                                    && ($attendance['id_std'] == $_SESSION['student']['id_std'])
                                                    && ($attendance['id_class'] == $class['id_class'])
                                                ) {
                                                    $isAttendanced = true;
                                                } else {
                                                    $isAttendanced = false;
                                                }
                                            }
                                        ?>
                                            <div class="p-3">
                                                <form action="attendance.php" method="POST" id="checkboxForm">
                                                    <input type="hidden" name="code_course" value="<?= $class['code_course'] ?>">
                                                    <input type="hidden" name="id_class" value="<?= $class['id_class'] ?>">
                                                    <input type="hidden" name="timeClass" value="<?= $class['time_class'] ?>">
                                                    <div class="bg-secondary text-white p-3 rounded-top">
                                                        Class: <strong><?= $class['class_name'] ?></strong>

                                                    </div>
                                                    <table class="table table-bordered table-striped class-section">
                                                        <thead>
                                                            <tr class="fw-bolder">
                                                                <td>Time</td>
                                                                <td>Class</td>
                                                                <td>State</td>
                                                                <td>Attendence</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="fw-bolder  <?= $isAttendanced ? 'text-success' : 'text-danger' ?>  ">
                                                                    <input type="hidden" name="time_class" value="<?= date("Y-m-d H:i:s") ?>">
                                                                    (
                                                                    <?php
                                                                    $date = new DateTime($class['time_start']);
                                                                    echo $date->format('l');
                                                                    ?>
                                                                    )
                                                                    <?php
                                                                    $timeStart = new DateTime($class['time_start']);
                                                                    echo  $timeStart->format('H:i:s');
                                                                    ?>
                                                                    <i class="fa-solid fa-arrow-right text-danger"></i>
                                                                    <?php
                                                                    $timeEnd = new DateTime($class['time_end']);
                                                                    echo  $timeStart->format('H:i:s');
                                                                    ?>
                                                                </td>
                                                                <td name="class_name"><?= $class['class_name'] ?></td>
                                                                <td name="id_teacher">
                                                                    <input type="radio" name="radio" value="1" <?= $isAttendanced ? 'checked' : '' ?>>
                                                                    <label for="radio" class="fw-bolder"> <span class="text-danger">*</span> Present</label>
                                                                    <input type="radio" name="radio" value="0">
                                                                    <label for="radio" class="fw-bolder"> <span class="text-danger">*</span>Absent</label>
                                                                </td>
                                                                <td>
                                                                    <button type="submit" name="attendence-btn" class="btn <?= $isAttendanced ? 'btn-success' : 'btn-primary' ?> text-white" <?= $isAttendanced ? 'disabled' : '' ?>>
                                                                        <?= $isAttendanced ? 'Submited' : 'Submit' ?>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </form>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('../CSE485_BTTH02/layouts/includes/sidebar.php');
?>
<!-- <script>
    registersBtn = document.querySelectorAll('.register-btn');
    registersBtn.forEach(registerBtn => {
        registerBtn.addEventListener('click', function(e) {
            e.preventDefault();
        })
    })
</script> -->
<?php
include('./layouts/assets/footer.php');
?>