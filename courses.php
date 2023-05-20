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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['selected'])) {
        $selecteds = $_POST['selected'];
        var_dump($selecteds);
    }
}

?>

<div class="d-flex flex-column float-end" style="width: calc(100% - 280px)">
    <?php include('../CSE485_BTTH02/layouts/includes/topbar.php') ?>

    <!-- Main content -->
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header">
                <h3>Courses List</h3>
            </div>
            <div class="card-body">
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
                                    <div class="border rounded-top mb-2" style="padding: 15px;">
                                        <strong>Description:</strong></br>
                                        <?= $course['course_desc'] ?>
                                    </div>
                                    <div class="border rounded-bottom">
                                        <?php
                                        $sql = "SELECT * FROM classes WHERE code_course = ?";
                                        $query = $conn->prepare($sql);
                                        $query->bindValue(1, $course['code_course']);
                                        $query->execute();
                                        $classes = $query->fetchAll();
                                        // var_dump($classes);
                                        if (!empty($classes)) {
                                            foreach ($classes as $class) {

                                        ?>
                                                <form action="" method="POST" id="checkboxForm">

                                                    <div class="p-3">
                                                        <input type="hidden" name="code_course" value="<?= $class['code_course'] ?>">
                                                        <input type="hidden" name="id_class" value="<?= $class['id_class'] ?>">
                                                        <div class="bg-secondary text-white p-3 rounded-top">
                                                            Class: <strong><?= $class['class_name'] ?></strong>
                                                        </div>
                                                        <table class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr class="fw-bolder">
                                                                    <td>Time</td>
                                                                    <td>Class</td>
                                                                    <td>Teacher</td>
                                                                    <td>Register</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td name="time_class"><?= $class['time_class'] ?></td>
                                                                    <td name="class_name"><?= $class['class_name'] ?></td>
                                                                    <td name="id_teacher"><?= $class['id_teacher'] ?></td>
                                                                    <td> <input type="checkbox" id="checkboxRegister" name="selected[]"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </form>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <div class="text-danger text-center fw-bolder">No Classes</div>
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

<script>
    $checkboxForm = document.querySelector('#checkboxForm');
    console.log($checkboxForm);
    $checkboxRegisters = document.querySelectorAll('input[type="checkbox"][name="selected[]"]');
    $checkboxRegisters.forEach(function($checkbox) {
        $checkbox.addEventListener('change', function() {
            if ($checkbox.checked) {
                $checkboxForm.submit();
            }
        })
    })
</script>
<?php
include('./layouts/assets/footer.php');
?>