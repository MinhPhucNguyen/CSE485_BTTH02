<?php

use LDAP\Result;

include './include/connect.php';
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <div class="abc">
        <div class="modal fade" id="editTeacherModal" tabindex="-1" aria-labelledby="editTeacherModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="log.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="edit_id" id="edit_id">


                            <div class="mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name_t" id="edit_name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Email</label>
                                <input type="email" name="email_t" id="edit_email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Phone</label>
                                <input type="text" name="phone_t" id="edit_phone" class="form-control">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="save" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="row col-lg-6 border rounded mx-auto mt-5 p-1 ">
            <div class="col-md-4 text-center">
                <img src="images/profile.jpg" alt="" class="img-fluid rounded"
                    style="width: 180px;height:180x;object-fit: cover">
                <div class="p-1">
                    <button type="button" class="btn btn-primary edit_btn" data-bs-toggle="modal"
                        data-bs-target="#editTeacherModal">
                        Edit
                    </button>
                    <button type="button" class="btn btn-info text-white">Logout</button>

                </div>
            </div>


            <div class="col-md-8">
                <div class="h2 fw-bolder">Profile</div>
                <table class="table table-striped">


                    <?php $sql = "select * from teachers where id_teacher = '2'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                    ?>

                    <tr>
                        <th>id</th>
                        <td class="id_t"><?php echo $row['id_teacher']; ?></td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td><?php echo $row['name'];   ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo $row['email'];   ?></td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td><?php echo $row['phone'];   ?></td>
                    </tr>
                    <?php
                        }
                    } ?>

                </table>
                <table>

                </table>
            </div>


        </div>
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="fs-2 fw-bold">Class</h5>
                    </div>
                    <div class="card-body">
                        <h5>
                            <table class="table">
                                <thead>
                                    <tr>

                                        <th scope="col">id_class</th>
                                        <th scope="col">code_course</th>
                                        <th scope="col">time_class</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM classes WHERE id_teacher ='1'";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        foreach ($result as $row) { ?>
                                    <tr>
                                        <td><?php echo $row['id_class']; ?></td>
                                        <td><?php echo $row['code_course']; ?></td>
                                        <td><?php echo $row['time_class']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-warning view_btn">View</button>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                    ?>



                                </tbody>
                            </table>

                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <script>
    $(document).ready(function() {

        $('.view_btn').click(function(e) {
            e.preventDefault();

            var id_t = $(this).closest('.abc').find('.id_t').text();
            $.ajax({
                type: "POST",
                url: 'log.php',

                data: {
                    'savee': true,
                    'teacher_id': id_t
                },
                success: function(response) {
                    $.each(response, function(key, value) {
                        $('#edit_id').val(value['id_teacher']);
                        $('#edit_name').val(value['name']);
                        $('#edit_email').val(value['email']);
                        $('#edit_phone').val(value['phone']);
                    });


                    $('#editTeacherModal').modal('show');
                },
                error: function() {
                    console.log('Có lỗi xảy ra khi cập nhật dữ liệu');
                }
            });

        });



        $('.edit_btn').click(function(e) {
            e.preventDefault();

            var id_t = $(this).closest('.abc').find('.id_t').text();
            $.ajax({
                type: "POST",
                url: 'log.php',

                data: {
                    'savee': true,
                    'teacher_id': id_t
                },
                success: function(response) {
                    $.each(response, function(key, value) {
                        $('#edit_id').val(value['id_teacher']);
                        $('#edit_name').val(value['name']);
                        $('#edit_email').val(value['email']);
                        $('#edit_phone').val(value['phone']);
                    });


                    $('#editTeacherModal').modal('show');
                },
                error: function() {
                    console.log('Có lỗi xảy ra khi cập nhật dữ liệu');
                }
            });

        });
    });
    </script>


</body>

</html>