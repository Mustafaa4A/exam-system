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
            Student Datatable
        </h5>
        <div class="alert alert-light-success alert-dismissible show fade ml-4 m-4" id="alert">
            <span></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="text-right ms-auto">
            <button type="button" class="btn btn-outline-primary block m-3" data-bs-toggle="modal" data-bs-target="#modal" id="register">
                Register New Student
            </button>
        </div>
        <div class="card-body">

            <table class="table table-striped table-sm table-responsive-sm" id="table">
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
                <h5 class="modal-title" id="exampleModalCenterTitle">Student Registration</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="" class="form" method="POST" id="form">
                <div class="modal-body">
                    <div class="row">
                        <input type="text" id="student_id" name="student_id" class="form-control round" placeholder="Student ID" readonly hidden>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="roundText">Student name</label>
                                <input type="text" id="student_name" name="student_name" class="form-control round" placeholder="Student Name" required>
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
                                <label for="roundText">Semester</label>
                                <select type="password" id="semester" name="semester" class="form-control round" placeholder="Status" required>
                                    <option value="">Select Semester</option>
                                    <option value="1">Semester 1</option>
                                    <option value="2">Semester 2</option>
                                    <option value="3">Semester 3</option>
                                    <option value="4">Semester 4</option>
                                    <option value="5">Semester 5</option>
                                    <option value="6">Semester 6</option>
                                    <option value="7">Semester 7</option>
                                    <option value="8">Semester 8</option>
                                    <option value="9">Semester 9</option>
                                    <option value="10">Semester 10</option>
                                    <option value="11">Semester 11</option>
                                    <option value="12">Semester 12</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="roundText">Class</label>
                                <input type="text" id="class" name="class" class="form-control round" placeholder="Class" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="roundText">Faculty</label>
                                <select type="password" id="faculty" name="faculty" class="form-control round" placeholder="Faculty" required>
                                    <option value="Computer Science">Computer Science</option>
                                    <option value="Engineering">Engineering</option>
                                    <option value="Health Science">Health Science</option>
                                    <option value="Computer Sceince">Computer Sceince</option>
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

<script src="../js/student.js"></script>
<script>
    $(".alert").hide();
</script>