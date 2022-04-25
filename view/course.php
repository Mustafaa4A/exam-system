<?php
require_once('../common/head.php');
require_once('../common/aside.php');
require_once('../common/header.php');
?>

<section class="section">
    <div class="card">
        <h5 class="card-header">
            Course Datatable
        </h5>
        <div class="alert alert-light-success alert-dismissible show fade ml-4 m-4" id="alert">
            <span></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="text-right ms-auto">
            <button type="button" class="btn btn-outline-primary block m-3" data-bs-toggle="modal" data-bs-target="#modal" id="register">
                Register New Course
            </button>
        </div>
        <div class="card-body">

            <table class="table" id="table">
                <thead></thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</section>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Course Registration</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="" class="form" method="POST" id="form">
                <div class="modal-body">

                    <div class="row">
                        <input type="text" id="course_id" name="course_id" class="form-control round" placeholder="course ID" readonly hidden>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="roundText">Course Name</label>
                                <input type="text" id="course_name" name="course_name" class="form-control round" placeholder="course Name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="roundText">Credit Hours</label>
                                <input type="number" min="30" max="52" id="credit_hours" name="credit_hours" class="form-control round" placeholder="Credit Hours" required>
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

<script src="../js/course.js"></script>
<script>
    $(".alert").hide();
</script>