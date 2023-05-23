<?php
session_start();
include('./layouts/assets/header.php');
$sql = "SELECT * FROM students WHERE id_std = 1 LIMIT 1";
$query = $conn->prepare($sql);
$query->execute();
$student = $query->fetch();
// var_dump($student);
$_SESSION['student'] = $student;
// var_dump($_SESSION['student']);
?>



<div class="d-flex flex-column float-end" style="width: calc(100% - 280px)">
    <?php include('../CSE485_BTTH02/layouts/includes/topbar.php') ?>
    <div class="container-fluid mt-4">
        <h3> <span>Welcome, </span><strong><?= $student['name'] ?></strong></h3>
    </div>
</div>
<?php
include('../CSE485_BTTH02/layouts/includes/sidebar.php');
?>
<?php
include('./layouts/assets/footer.php');
?>