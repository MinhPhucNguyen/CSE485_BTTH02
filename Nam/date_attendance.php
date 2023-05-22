<?php

use LDAP\Result;

include './include/connect.php';
session_start();
?>
<!-- SELECT TIMEDIFF('2023-05-22 19:08:20', '2023-05-22 20:08:20'); -->
<?php require_once './include/header.php'; ?>



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
                                        <button type="button" class="btn btn-warning"><a href="list_student.php"
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


    <?php require_once 'include/footer.php'; ?>


    <script>

    </script>
    </body>

    </html>