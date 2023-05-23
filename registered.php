<?php
session_start();
include('./layouts/assets/header.php');

$sql = "SELECT r.*, c.course_name, c.course_desc, d.class_name, d.time_class, d.id_teacher 
FROM registered as r INNER JOIN courses as c ON r.code_course = c.code_course 
INNER JOIN classes as d ON r.id_class = d.id_class";

$query = $conn->prepare($sql);
$query->execute();
$courses = $query->fetchAll();

if (isset($_POST['unregisterd-btn'])) {
    $id_class = $_POST['unregisterd-btn'];
    // var_dump($id_class);
    $id_std = $_SESSION['student']['id_std'];
    // var_dump($id_std);
    $code_course = $_POST['code_course'];
    // var_dump($code_course);

    $sql = "DELETE FROM registered WHERE id_std = ? AND id_class = ? AND code_course = ?";
    $query = $conn->prepare($sql);
    $query->bindValue(1, $id_std, PDO::PARAM_INT);
    $query->bindValue(2, $id_class, PDO::PARAM_STR);
    $query->bindValue(3, $code_course, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() > 0) {
        $_SESSION['success'] = "Unregisterd class successfully";
        Header("Location: registered.php");
    } else {
        $_SESSION['error'] = "Unregisterd class failed";
        Header("Location: registered.php");
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
                <h3>Registered List</h3>
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
                                        $sql = "SELECT r.state, r.id_class, r.code_course, c.class_name, c.time_class, c.id_teacher, c.code_course 
                                        FROM registered as r INNER JOIN classes as c ON r.id_class = c.id_class WHERE c.code_course = ? GROUP BY c.code_course ";

                                        $query = $conn->prepare($sql);
                                        $query->bindValue(1, $course['code_course']);
                                        $query->execute();
                                        $classes = $query->fetchAll();

                                        if (!empty($classes)) {
                                            foreach ($classes as $class) {
                                        ?>
                                                <div class="p-3">
                                                    <!-- <input type="hidden" name="id_class" value=""> -->
                                                    <div class="bg-secondary text-white p-3 rounded-top">
                                                        Class: <strong><?= $class['class_name'] ?></strong>
                                                    </div>
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr class="fw-bolder">
                                                                <td>Time</td>
                                                                <td>Class</td>
                                                                <td>Teacher</td>
                                                                <td>Action</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td name="time_class" class="fw-bolder"><?= $class['time_class'] ?></td>
                                                                <td name="class_name"><?= $class['class_name'] ?></td>
                                                                <td name="id_teacher"><?= $class['id_teacher'] ?></td>
                                                                <td>
                                                                    <button type="submit" name="registerBtn" class="btn btn-success text-white" <?= $class['state'] == 1 ? 'disabled' : '' ?>><?= $class['state'] == 1 ? 'Registered' : '' ?></button>
                                                                    <form action="registered.php" method="POST" class="d-inline-block">
                                                                        <input type="hidden" name="code_course" value="<?= $class['code_course'] ?>">
                                                                        <button type="submit" class="btn btn-danger" name="unregisterd-btn" value="<?= $class['id_class'] ?>">Unregistered</button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
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
    $alertSuccess = document.querySelector('.alert-success');
    // console.log($alertSuccess);
    if ($alertSuccess) {
        setTimeout(() => {
            $alertSuccess.remove();
        }, 2500)
    }
</script>

<?php
include('./layouts/assets/footer.php');
?>