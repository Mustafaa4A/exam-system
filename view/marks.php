<?php
require_once('../common/head.php');
require_once('../common/aside.php');
require_once('../common/header.php');
?>

<section class="container-fluid section">
    <div class="card">
        <h5 class="card-header">
            Marks Datatable
        </h5>
        <div class="alert alert-light-success alert-dismissible show fade ml-4 m-4" id="alert">
            <span></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="text-right ms-auto">
            <button type="button" class="btn btn-outline-primary block m-3" data-bs-toggle="modal" data-bs-target="#modal" id="register">
                Add New Record
            </button>
            <!-- <form method="POST" id="import_exel" class="form m-4">
                <div class="mb-3">
                    <label for="exel_file" class="form-label"></label>
                    <input type="file" class="form-control" id="exel_file" name="exel_file">
                </div>
            </form> -->
        </div>
        <div class="row p-2">
            <div class="col-sm-3">
                <div class="form-group">
                    <input list="students" id="student" name="student" class="form-control round" placeholder="Studnt" required>
                    <datalist id="students">
                    </datalist>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <input list="courses" id="course" name="course" class="form-control round" placeholder="Course" required>
                    <datalist id="courses">
                    </datalist>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <select type="text" id="sem" name="sem" class="form-control round" placeholder="Studnt ID" required>
                        <option value="">Select Semester</option>
                        <option value="1">Semester 1</option>
                        <option value="2">Semester 2</option>
                        <option value="3">Semester 3</option>
                        <option value="4">Semester 4</option>
                        <option value="5">Semester 5</option>
                        <option value="6">Semester 6</option>
                        <option value="7">Semester 7</option>
                        <option value="8">Semester 8</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <button type="button" class="btn btn-primary block" id="search">Search Record</button>
                </div>
            </div>
        </div>
        <div class="card-body" id="result">
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
                <h5 class="modal-title" id="exampleModalCenterTitle">Marks Recording</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="" class="form" method="POST" id="form">
                <div class="modal-body">

                    <div class="row">
                        <input type="text" id="record_id" name="record_id" class="form-control round" placeholder="Record ID" readonly hidden>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input list="students" id="student_id" name="student_id" class="form-control round" placeholder="Studnt" required>
                                <datalist id="students">
                                </datalist>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input list="courses" id="course_id" name="course_id" class="form-control round" placeholder="Course" required>
                                <datalist id="courses">
                                </datalist>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="roundText">Semester</label>
                                <select type="text" id="semester" name="semester" class="form-control round" placeholder="Status" required>
                                    <option value="">Select Semester</option>
                                    <option value="1">Semester 1</option>
                                    <option value="2">Semester 2</option>
                                    <option value="3">Semester 3</option>
                                    <option value="4">Semester 4</option>
                                    <option value="5">Semester 5</option>
                                    <option value="6">Semester 6</option>
                                    <option value="7">Semester 7</option>
                                    <option value="8">Semester 8</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="roundText">Course Work</label>
                                <input type="number" min="0" max="20" id="course_work" name="course_work" class="form-control round" placeholder="Course Work" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="roundText">Midterm Exam</label>
                                <input type="number" min="0" max="30" id="midterm" name="midterm" class="form-control round" placeholder="Midterm Exam" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="roundText">Final Exam</label>
                                <input type="number" min="0" max="50" id="final" name="final" class="form-control round" placeholder="Final Exam" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="roundText">Total Marks</label>
                                <input type="number" min="0" max="100" id="total" name="total" class="form-control round" placeholder="Total Marks" required readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="roundText">Remark</label>
                                <input type="text" id="remark" name="remark" class="form-control round" placeholder="" readonly>
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

<script src="../js/marks.js"></script>
<script>
    $(".alert").hide();


    $('#course_work').change(() => sumMarks());
    $('#midterm').change(() => sumMarks());
    $('#final').change(() => sumMarks());

    function sumMarks(value) {
        if ($('#course_work').val() != '' && $('#midterm').val() != '' && $('#final').val() != '') {
            let courseWork = Number($('#course_work').val());
            let midterm = Number($('#midterm').val());
            let final = Number($('#final').val());
            let total = courseWork + midterm + final;

            $('#total').val(total);
            $('#remark').val((total < 50 ? "Re-Exam" : ''));

        }



    }
</script>