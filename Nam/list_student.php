<?php

use LDAP\Result;

include './include/connect.php';
session_start();
?>

<?php require_once './include/header.php'; ?>

<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="log.php" method="POST">
                <div class="modal-body">

                    <div class="form-groups">
                        <label for="">code_course</label>
                        <input type="text" class="form-control" name="c_course">
                    </div>
                    <div class="form-groups">
                        <label for="">Date</label>
                        <input type="datetime-local" class="form-control" name="s_date">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="save_date">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="fs-2 fw-bold">Class
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#createModal">create attendence</button>
                    </h5>


                </div>
                <div class="card-body">
                    <h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">id_student</th>
                                    <th scope="col">name</th>
                                    <th scope="col">code_course</th>
                                    <th scope="col">state</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT s.id_std AS id , s.name, a.code_course, a.state FROM students s INNER JOIN attendance AS a ON s.id_std = a.id_std";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    foreach ($result as $row) { ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['code_course']; ?></td>
                                            <td><?php if ([$row['state'] == 'present']) {
                                                    echo '<span class="badge bg-success">Present</span>';
                                                }  ?>
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-warning"><a href="list_student.php" class="text-white link-underline-warning">View</a></button>
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