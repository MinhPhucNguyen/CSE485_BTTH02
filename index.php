<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
    <!-- <nav class="navbar bg-dark d-flex justify-content-end">
      <div class="col-md-4">
        <button type="button" class="btn btn-success col-md-3" data-bs-toggle="modal" data-bs-target="#login">Login</button>
        <button type="button" class="btn btn-success col-md-3" style="margin-left:30px" data-bs-toggle="modal" data-bs-target="#register">Register</button>
      </div>
    </nav>
    <div class="modal fade" id="login" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center bg-secondary">
                        <h2 class="text-white">Login</h2>
                        <button type="button" class="btn btn-close btn-light float-end" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="card-body mx-auto p-4 " style="width: 500px;">                
                        <form method="POST" action="">
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
                                    <button type="submit" class="btn btn-success btn-lg fw-bold" name="login-btn" style="width: 100%;">LOGIN
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row mb-0 text-center">
                                <p class="text-secondary">Are you not a member yet?
                                <a href="" data-bs-toggle="modal" data-bs-target="#register" class="fw-bold text-decoration-none text-dark">Sign up now!</a></p>
                                <hr>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="register" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-center bg-secondary">
                            <h2 class="text-white">Register</h2>
                            <button type="button" class="btn btn-close btn-light float-end" data-bs-dismiss="modal"></button>
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
                                    <label class="col-md-3 col-form-label text-md-right fw-bold">Email</label>
                                    <div class="col-md-12 ">
                                        <input id="email" type="email" class="form-control" placeholder="e.g abc@example.com">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-md-3 col-form-label text-md-right fw-bold">Phone</label>
                                    <div class="col-md-12 ">
                                        <input id="phone" type="text" class="form-control" placeholder="Enter your phone number">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-md-3 col-form-label text-md-right fw-bold">Address</label>
                                    <div class="col-md-12 ">
                                        <input id="address" type="text" class="form-control" placeholder="Enter your address">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-md-3 col-form-label text-md-right fw-bold">Password</label>
                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-md-6 col-form-label text-md-right fw-bold">Confirm Password</label>
                                    <div class="col-md-12">
                                        <input id="confirm_password" type="password" class="form-control" placeholder="Confirm Password">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success btn-lg fw-bold" name="login-btn" style="width: 100%;">Register
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
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
                            <button type="submit" class="btn btn-success btn-lg fw-bold" name="login-btn" style="width: 100%;">LOGIN
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