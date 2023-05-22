<?php

use LDAP\Result;

include './include/connect.php';
session_start();
$sql = "SELECT * FROM classes WHERE id_teacher ='1'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
// $id_c = $row['id_class'];
// $cod_c = $row['code_course'];
// $_SESSION['id_class'] = $id_c;
// $_SESSION['code_course'] = $cod_c;
// $id_c = $_SESSION['id_class'];
// $cod_c = $_SESSION['code_course'];
// echo $id_c;

?>

<?php require_once './include/header.php'; ?>


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


                <?php $sql = "select * from teachers where id_teacher = '1'";
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
                                <tr class="bcd">
                                    <td class="id_c"><?php echo $row['id_class']; ?></td>
                                    <td class="cod_c"><?php echo $row['code_course']; ?></td>
                                    <td><?php echo $row['time_class']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning view_btn"><a
                                                href="list_student.php"
                                                class="text-white link-underline-warning">View</a></button>
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

<?php require_once 'include/footer.php'; ?>


<script>
$(document).ready(function() {
    $('.edit_btn').click(function(e) {
        e.preventDefault();

        var id_t = $(this).closest('.abc').find('.id_t').text();
        console.log(id_t);
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

    $('.view_btn').click(function(e) {
        e.preventDefault();

        var id_c = $(this).closest('.bcd').find('.id_c').text();
        var cod_c = $(this).closest('.bcd').find('.cod_c').text();
        console.log(id_c);
        console.log(cod_c);
        $.ajax({
            type: "POST",
            url: 'log.php',

            data: {
                'vieww': true,
                'id_class': id_c,
                'cod_c': cod_c

            },
            // success: function(response) {
            //     var newDoc = document.open("list_student.php", "replace");
            //     newDoc.write(response);
            //     newDoc.close();
            // }

        });

    });
});
</script>
</body>

</html>