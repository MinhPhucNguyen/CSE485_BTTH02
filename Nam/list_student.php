<?php

use LDAP\Result;

include './include/connect.php';
session_start();
// $id_c = $_SESSION['id_class'];
// $cod_c = $_SESSION['code_course'];
?>

<!-- SELECT TIMEDIFF('2023-05-22 19:08:20', '2023-05-22 20:08:20'); -->

<?php require_once './include/header.php'; ?>

<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createModalLabel">Create attendance time</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="log.php" method="POST">
                <div class="modal-body">
                    <div class="form-groups">
                        <label for="">DateStart</label>
                        <input type="datetime-local" class="form-control" name="s_date">
                    </div>
                    <div class="form-groups">
                        <label for="">DateEnd</label>
                        <input type="datetime-local" class="form-control" name="e_date">
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
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                            data-bs-target="#createModal">create attendence</button>
                    </h5>


                </div>
                <div class="card-body">
                    <h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">id_student</th>
                                    <th scope="col">name</th>
                                    <th scope="col">state</th>
                                    <th scope="col">time</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT s.id_std AS id , s.name, a.code_course, a.state, CAST(a.time_attendance AS DATE) AS dates FROM students s INNER JOIN attendance AS a ON s.id_std = a.id_std";
                                $result = mysqli_query($conn, $sql);
                                $data = array();

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $status = '';
                                    if ($row["state"] == 'present') {
                                        $status = '<span class="badge bg-success">Present</span>';
                                    } elseif ($row["state"] == 'absent') {
                                        $status = '<label class="badge bg-danger">Absent</label>';
                                    }

                                    $data[] = array(
                                        $row["id"],
                                        $row["name"],
                                        $status,
                                        $row["dates"]
                                    );
                                }

                                if (mysqli_num_rows($result) > 0) {
                                    foreach ($data as $row) { ?>
                                <tr>
                                    <td><?php echo $row[0]; ?></td>
                                    <td><?php echo $row[1]; ?></td>
                                    <td><?php echo $row[2]; ?></td>
                                    <td><?php echo $row[3]; ?></td>
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

</script>
</body>

</html>