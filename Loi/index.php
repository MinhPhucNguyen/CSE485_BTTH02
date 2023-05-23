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
    $username = "";
    $password = "";
    if(isset($_POST['login_btn'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql_select = "SELECT username,password,role_as From users WHERE username = '$username' and password = '$password'";
        $user = $pdo->query($sql_select);
        $data_user = $user->fetch();
        if($username==$data_user['username'] && $password == $data_user['password']){
            if($data_user['role_as'] == 0){
                header('Location: /Loi/admin-sv.php');
            }
            if($data_user['role_as'] == 1)
            {
                header('Location: /Loi/admin-gv.php');
            }
            // if($data_user['role_as'] == 2){
            //     header('Location: /Loi/admin-gv.php');
            // }
        }
    }
    ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
    <div class="col-md-6 container">
        <div class="card">
            <div class="card-header text-center bg-dark">
                <h2 class="text-white">Login</h2>
            </div>
            <div class="card-body mx-auto p-4 " style="width: 500px;">                
                <form method="POST" action="index.php">
                    <div class="form-group row mb-4">
                        <label class="col-md-3 col-form-label text-md-right fw-bold">Username</label>
                        <div class="col-md-12 ">
                            <input id="username" type="text"
                                class="form-control" name="username" placeholder="Enter Username" autofocus>                            
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-md-3 col-form-label text-md-right fw-bold">Password</label>
                        <div class="col-md-12">
                            <input id="password" type="password"
                                class="form-control" name="password" placeholder="Enter Password" autofocus>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success btn-lg fw-bold" name="login_btn" style="width: 100%;">LOGIN
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>