<?php
session_start();
include('./layouts/assets/header.php');
if (isset($_SESSION['student'])) {
    $student = $_SESSION['student'];
}

// var_dump($student);

if (isset($_POST['save-btn'])) {
    $id_std = $_POST['id_std'];
    $name = $_POST['name'];
    $birth = date('Y-m-d', strtotime($_POST['birth']));
    // $birth = $_POST['birth'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $sql = "UPDATE students SET name = ?, birth = ?, phone = ?, email = ? WHERE id_std = ?";

    $query = $conn->prepare($sql);
    $query->bindValue(1, $name);
    $query->bindValue(2, $birth);
    $query->bindValue(3, $phone);
    $query->bindValue(4, $email);
    $query->bindValue(5, $id_std);

    $query->execute();

    if ($query->rowCount() > 0) {
        $_SESSION['success'] = "Update information successfully";
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['error'] = "Update information failed";
        header("Location: index.php");
        exit();
    }
}
?>



<div class="modal fade" id="studentBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="studentcBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="studentcBackdropLabel">Edit Information</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" value="<?= $student['id_std'] ?>" name="id_std">
                    <div class="form-group mb-4">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" value="<?= $student['name'] ?>">
                    </div>
                    <div class="form-group mb-4">
                        <label for="">Birth</label>
                        <input type="date " class="form-control" name="birth" value="<?= $student['birth'] ?>" placeholder="dd-mm-yyyy">
                    </div>
                    <div class="form-group mb-4">
                        <label for="">Phone</label>
                        <input type="text" class="form-control" name="phone" value="<?= $student['phone'] ?>">
                    </div>
                    <div class="form-group mb-4">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $student['email'] ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="save-btn">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="d-flex flex-column float-end" style="width: calc(100% - 280px)">
    <nav class="navbar bg-body-tertiary ">
        <div class="container-fluid">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <!-- MAIN content -->
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
                <h3>Student: <strong><?= $student['name'] ?></strong> </h3>
            </div>
            <div class="card-body">
                <div class="form-group mb-4">
                    <label for="">Birth</label>
                    <input type="date" class="form-control" name="birth" value="<?= $student['birth'] ?>" disabled>
                </div>
                <div class="form-group mb-4">
                    <label for="">Phone</label>
                    <input type="text" class="form-control" name="phone" value="<?= $student['phone'] ?>" disabled>
                </div>
                <div class="form-group mb-4">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" value="<?= $student['email'] ?>" disabled>
                </div>
                <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentBackdrop">Change Information</a>
            </div>
        </div>
    </div>
</div>


<?php
include('../CSE485_BTTH02/layouts/includes/sidebar.php');
include('./layouts/assets/footer.php');
?>