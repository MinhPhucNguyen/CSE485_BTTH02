<?php
session_start();
$type     = 'mysql';
$server   = 'localhost';
$db       = 'btth02';
$port     = '3306';
$charset  = 'utf8mb4';
$username = 'root';
$password = '';
$options  = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$sconn = "$type:host=$server;dbname=$db;port=$port;charset=$charset";
try {
    $pdo = new PDO($sconn, $username, $password, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), $e->getCode());
}

//Create
$code_course = "";
$name = "";
$Describe = "";
if (isset($_POST["add-btn"])) {
    $code_course = $_POST['code-course'];
    $name = $_POST['name'];
    $Describe = $_POST['describe'];
    $sql_add = "INSERT INTO courses (code_course, course_name, course_desc)
        VALUES ('$code_course','$name', '$Describe')";
    $add = $pdo->prepare($sql_add);
    $add->execute();
    if ($add) {
        $_SESSION['success'] = 'Create course successfully';
        header('Location: admin-course.php');
        exit();
    } else {
        $_SESSION['error'] = 'Create course failed';
        header('Location: admin-course.php');
        exit();
    }
}


//edit
if (isset($_POST["edit_btn"])) {
    $edit_course_id = $_POST["edit_btn"];
    $sql_select_edit = "SELECT * FROM courses WHERE code_course = ?";
    $select_edit = $pdo->prepare($sql_select_edit);
    $select_edit->bindValue(1, $edit_course_id);
    $select_edit->execute();
    $datas_select_edit = $select_edit->fetch();
}






//delete
if (isset($_POST["delete_btn"])) {
    $code_course = $_POST["delete_btn"];
    $sql_del = "DELETE FROM courses WHERE code_course='$code_course'";
    $del = $pdo->query($sql_del);
    if ($del) {
        $_SESSION['success'] = 'Delete course successfully';
        header('Location: admin-course.php');
        exit();
    } else {
        $_SESSION['error'] = 'Delete course failed';
        header('Location: admin-course.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>

    <div class="container-fluid col-md-6 card-body">
        <h1 class="d-flex justify-content-center">Course management</h1><?php
                                                                        if (isset($_SESSION['success'])) {
                                                                        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['success'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
                                                                            unset($_SESSION['success']);
                                                                        }
        ?>
        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create">Create</a>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr class="text-center">
                    <th>Code</th>
                    <th>Name</th>
                    <th>Describe</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_select = "SELECT * From courses";
                $courses = $pdo->query($sql_select);
                $datas = $courses->fetchAll();                
                foreach ($datas as $data) { ?>
                    <tr>
                        <td><?= $data['code_course'] ?></td>
                        <td><?php echo $data['course_name'] ?></td>
                        <td><?php echo $data['course_desc'] ?></td>
                        <td>

                            <button type="submit" name="edit_btn" class="btn btn-primary" value="<?= $data['code_course'] ?>" data-bs-toggle="modal" data-bs-target="#edit">Edit</button>
                            <form class="d-inline-block" method="POST">

                                <button type="submit" name="delete_btn" class="btn btn-danger" value="<?= $data['code_course'] ?>">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php
                } ?>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-center bg-secondary">
                            <h2 class="text-white">Create Course</h2>
                            <button type="button" class="btn btn-close btn-light float-end" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="card-body mx-auto p-4 " style="width: 500px;">
                            <form method="POST" action="admin-course.php">
                                <div class="form-group row mb-4">
                                    <label class="col-md-3 col-form-label text-md-right fw-bold">Code</label>
                                    <div class="col-md-12 ">
                                        <input id="code-course" name="code-course" type="text" class="form-control" placeholder="Enter code course">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-md-3 col-form-label text-md-right fw-bold">Name</label>
                                    <div class="col-md-12 ">
                                        <input id="name" name="name" type="text" class="form-control" placeholder="Enter course name" >
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-md-3 col-form-label text-md-right fw-bold">Describe</label>
                                    <div class="col-md-12 ">
                                        <input id="email" name="describe" type="text" class="form-control" placeholder="Enter describe">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success btn-add fw-bold" name="add-btn" style="width: 100%;">ADD
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-center bg-secondary">
                            <h2 class="text-white">Edit Course</h2>
                            <button type="button" class="btn btn-close btn-light float-end" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="card-body mx-auto p-4 " style="width: 500px;">
                            <form method="POST" action="admin-course.php">
                                <input id="id" name="id" type="hidden" class="form-control" value="" disabled>
                                <div class="form-group row mb-4">
                                    <label class="col-md-3 col-form-label text-md-right fw-bold">Code</label>
                                    <div class="col-md-12 ">
                                        <input id="phone" name="code-course" type="text" class="form-control" value="<?= $datas_select_edit['code_course'] ?>" placeholder="Enter code course" disabled>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-md-3 col-form-label text-md-right fw-bold">Name</label>
                                    <div class="col-md-12 ">
                                        <input id="name" name="name" type="text" class="form-control" placeholder="Enter course name"  value="<?= $datas_select_edit['course_name'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-md-3 col-form-label text-md-right fw-bold">Describe</label>
                                    <div class="col-md-12 ">
                                        <input id="email" name="describe" type="text" class="form-control" placeholder="Enter describe">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success btn-add fw-bold" name="update-btn" style="width: 100%;">SAVE
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>