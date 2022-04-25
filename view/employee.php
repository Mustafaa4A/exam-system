<?php
require_once('../common/head.php');
require_once('../common/aside.php');
require_once('../common/header.php');
?>
<style>
    .card {
        overflow-y: hidden;
    }
</style>

<section class="container-fluid section">
    <div class="card">
        <h5 class="card-header">
            Employee Datatable
        </h5>
        <div class="alert alert-light-success alert-dismissible show fade ml-4 m-4" id="alert">
            <span></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="text-right ms-auto">
            <button type="button" class="btn btn-outline-primary block m-3" data-bs-toggle="modal" data-bs-target="#modal" id="register">
                Register New Employee
            </button>
        </div>
        <div class="card-body">

            <table class="table" id="table">
                <thead>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</section>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Employee Registration</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="" class="form" method="POST" id="form">
                <div class="modal-body">

                    <div class="row">
                        <input type="text" id="emp_id" name="emp_id" class="form-control round" placeholder="Employee ID" readonly hidden>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="roundText">Employee name</label>
                                <input type="text" id="emp_name" name="emp_name" class="form-control round" placeholder="Employeename" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="roundText">Gender</label>
                                <select type="password" id="gender" name="gender" class="form-control round" placeholder="Status" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="roundText">Degree</label>
                                <select type="password" id="degree" name="degree" class="form-control round" placeholder="Status" required>
                                    <option value="Baschler Degree">Baschler Degree</option>
                                    <option value="Master Degree">Master Degree</option>
                                    <option value="PhD">PhD</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="roundText">Title</label>
                                <select type="password" id="title" name="title" class="form-control round" placeholder="Status" required>
                                    <option value="Manager">Manager</option>
                                    <option value="Vice Manager">Vice Manager</option>
                                    <option value="Staff">Staff</option>
                                    <option value="Lecturer">Lecturer</option>
                                    <option value="Coordinator">Coordinator</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="roundText">Address</label>
                                <input type="text" id="address" name="address" class="form-control round" placeholder="Address" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="roundText">Phone Number</label>
                                <input type="tell" id="phone" name="phone" class="form-control round" placeholder="Phone Number" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="roundText">Email</label>
                                <input type="email" id="email" name="email" class="form-control round" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="roundText">Salary</label>
                                <input type="text" id="salary" name="salary" class="form-control round" placeholder="Salary" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="roundText">User</label>
                                <select type="password" id="user_id" name="user_id" class="form-control round" placeholder="User ID">
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="roundText">Status</label>
                                <select type="password" id="status" name="status" class="form-control round" placeholder="Status" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">In Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="roundText">Registred Date</label>
                                <input type="date" id="date" name="date" class="form-control round" placeholder="Registred Date" value="<?php echo Date('Y-m-d') ?>" required>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Save Changes</span>
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
<?php
require_once('../common/footer.php');
?>


<script src="../assets/vendors/jquery/jquery.min.js"></script>
<script src="../assets/vendors/jquery-datatables/jquery.dataTables.min.js"></script>
<script src="../assets/vendors/jquery-datatables/custom.jquery.dataTables.bootstrap5.min.js"></script>
<script src="../assets/vendors/fontawesome/all.min.js"></script>

<script src="../js/employee.js"></script>
<script>
    $(".alert").hide();
</script>