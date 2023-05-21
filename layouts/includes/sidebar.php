<!-- Sidebar -->
<div class="d-flex flex-column flex-shrink-0 p-3 text-secondary bg-white border d-inline-block fixed-top" style="width: 280px; height: 100vh ">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32">
            <use xlink:href="#bootstrap" />
        </svg>
        <span class="fs-4 text-primary fw-bolder">TLUni</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="courses.php" class="nav-link  text-primary fw-bolder text-uppercase" aria-current="page">
                <svg class="bi me-2 mb-4" width="16" height="16">
                    <use xlink:href="#home" />
                </svg>
                courses
            </a>
        </li>
        <li>
            <a href="registered.php" class="nav-link text-primary fw-bolder text-uppercase">
                <svg class="bi me-2 mb-4" width="16" height="16">
                    <use xlink:href="#table" />
                </svg>
                Registered course
            </a>
        </li>
        <li>
            <a href="attendence.php" class="nav-link text-primary fw-bolder text-uppercase">
                <svg class="bi me-2 mb-4" width="16" height="16">
                    <use xlink:href="#grid" />
                </svg>
                Attendance
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-primary text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <span style="margin-right: 15px;">
                <i class="fa-solid fa-user text-primary"></i>
            </span>
            <strong class="text-primary">mdo</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="student.php">Student Information</a></li>
            <li><a class="dropdown-item" href="#">Logout</a></li>
        </ul>
    </div>
</div>