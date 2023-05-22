<?php

include('include/header.php');

?>

<div class="container" style="margin-top:30px">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-9">Attendance List</div>
                <div class="col-md-3" align="right">
                    <button type="button" id="report_button" class="btn btn-danger btn-sm">Report</button>
                    <button type="button" id="add_button" class="btn btn-info btn-sm">Add</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <span id="message_operation"></span>
                <table class="table table-striped table-bordered" id="attendance_table">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Roll Number</th>
                            <th>Grade</th>
                            <th>Attendance Status</th>
                            <th>Attendance Date</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>

</html>
<?php
include('include/footer.php');
?>