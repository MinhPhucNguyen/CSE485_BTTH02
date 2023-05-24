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
    try{
        $pdo = new PDO($sconn,$username,$password,$options);
    }catch(PDOException $e){
        throw new PDOException($e->getMessage(), $e->getCode());
    }
    $sql_select = "SELECT *From students";
    $students = $pdo->query($sql_select);
    $datas = $students->fetchAll();

    //Create
    $id_std = "";
    $birth = "";
    $name = "";
    $phone = "";
    $email = "";
        if(isset($_POST["add-btn"])) { $name = $_POST['name'];$birth = $_POST['birth']; $birth1 = date("Y-m-d", strtotime($birth)); ;$phone = $_POST['phone']; $email = $_POST['email']; 
        $sql_add = "INSERT INTO students (name,birth, phone, email)
        VALUES ('$name', '$birth', '$phone', '$email')";
        $add = $pdo->prepare($sql_add);
        $add->execute();
        if ($add) {
            $_SESSION['success'] = 'Create student successfully';
            header('Location: admin-sv.php');
            exit();
        } else {
            $_SESSION['error'] = 'Create student failed';
            header('Location: admin-sv.php');
            exit();
        }
        }
    

    //edit
        if(isset($_POST["edit_btn"])){
            $id_std = $_POST["edit_btn"];
            $sql_select_edit = "SELECT *FROM students WHERE id_std ='$id_std'";
            $select_edit = $pdo->query($sql_select_edit);
            $datas_select_edit = $select_edit->fetch();
        }
        
    

    //delete
        if(isset($_POST["delete_btn"])){
            $id_std = $_POST["delete_btn"];
            $sql_del = "DELETE FROM students WHERE id_std ='$id_std'";
            $del = $pdo->query($sql_del);
                if ($del) {
                    $_SESSION['success'] = 'Delete student successfully';
                    header('Location: admin-sv.php');
                    exit();
                } else {
                    $_SESSION['error'] = 'Delete student failed';
                    header('Location: admin-sv.php');
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
    <title>Teacher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    
    <div class="container-fluid col-md-6 card-body">
        <h1 class="d-flex justify-content-center">Quản lý sinh viên</h1><?php
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
            <th>ID</th>
            <th>Name</th>
            <th>Birth</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Class</th>
            <th>Action</th>
        </tr>   
        </thead>
        <tbody>
        <?php
        foreach ($datas as $data){?>
        <tr>
            <td><?php echo $data['id_std']?></td>
            <td><?php echo $data['name']?></td>
            <td><?php echo $data['birth']?></td>
            <td><?php echo $data['phone']?></td>
            <td><?php echo $data['email']?></td>
            <td><?php echo $data['id_class']?></td>
            <td>              
                <button type="submit" value="<?= $data['id_std']?>" name="edit_btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit">Edit</button>
                <form action="admin-sv.php" class="d-inline-block" method="POST">
                    <button type="submit" value="<?= $data['id_std']?>" name="delete_btn" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        <?php
        }?>
        </tbody>
        </table>
    </div>
    <div class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-center bg-secondary">
                            <h2 class="text-white">Create Student</h2>
                            <button type="button" class="btn btn-close btn-light float-end" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="card-body mx-auto p-4 " style="width: 500px;">                
                            <form method="POST" action="admin-sv.php">
                                <div class="form-group row mb-4">
                                    <label class="col-md-3 col-form-label text-md-right fw-bold">Name</label>
                                    <div class="col-md-12 ">
                                        <input id="name" name="name" type="text" class="form-control" placeholder="Enter your name">
                                    </div>
                                </div><div class="form-group row mb-4">
                                    <label class="col-md-3 col-form-label text-md-right fw-bold">Birth</label>
                                    <div class="col-md-12 ">
                                        <input id="birth" name="birth" type="date" class="form-control" placeholder="Enter your birth">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-md-3 col-form-label text-md-right fw-bold">Phone</label>
                                    <div class="col-md-12 ">
                                        <input id="phone" name="phone" type="text" class="form-control" placeholder="Enter your phone number">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-md-3 col-form-label text-md-right fw-bold">Email</label>
                                    <div class="col-md-12 ">
                                        <input id="email" name="email" type="email" class="form-control" placeholder="e.g abc@example.com">
                                    </div>
                                </div>
                                <!-- <div class="form-floating form-group row mb-4">
                                    <div class="col-md-12 form-floating ">
                                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                        <?php
                                        foreach($values_select as $value_select){?>
                                        <option value=""><?php echo $value_select['course_name']?></option>
                                        <?php
                                        }?>
                                    </select>
                                    <label for="floatingSelect">Selects class</label>
                                    </div>
                                    
                                </div> -->
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
                            <h2 class="text-white">Edit Student</h2>
                            <?php
                            var_dump($_POST['edit_btn']);
                            ?>
                            <button type="button" class="btn btn-close btn-light float-end" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="card-body mx-auto p-4 " style="width: 500px;">                
                            <form method="POST" action="admin-sv.php">
                                <input id="id" name="id" type="hidden" class="form-control" disabled>
                                <div class="form-group row mb-4">
                                    <label class="col-md-3 col-form-label text-md-right fw-bold">Name</label>
                                    <div class="col-md-12 ">
                                        <input id="name" name="name" type="text" class="form-control" placeholder="Enter your name" value="<?=$datas_select_edit['name']?>">
                                    </div>
                                </div><div class="form-group row mb-4">
                                    <label class="col-md-3 col-form-label text-md-right fw-bold">Birth</label>
                                    <div class="col-md-12 ">
                                        <input id="birth" name="birth" type="date" class="form-control" placeholder="Enter your birth">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-md-3 col-form-label text-md-right fw-bold">Phone</label>
                                    <div class="col-md-12 ">
                                        <input id="phone" name="phone" type="text" class="form-control" placeholder="Enter your phone number">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-md-3 col-form-label text-md-right fw-bold">Email</label>
                                    <div class="col-md-12 ">
                                        <input id="email" name="email" type="email" class="form-control" placeholder="e.g abc@example.com">
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