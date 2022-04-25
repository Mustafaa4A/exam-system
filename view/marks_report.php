<?php
require_once('../common/head.php');
require_once('../common/aside.php');
require_once('../common/header.php');
?>

<section class="section">
    <div class="card">
        <h5 class="card-header">
            Marks Report
        </h5>
        <div class="row p-2">
            <div class="col-sm-4">
                <div class="form-group">
                    <select type="text" id="class" name="class" class="form-control round" placeholder="Class" required>
                        <option value="">Select Class</option>
                        <option value="BC012">BC012</option>
                        <option value="BE010">BE010</option>
                        <option value="BC010">BC010</option>
                        <option value="BC011">BC011</option>
                        <option value="BE009">BE009</option>
                        <option value="BF003">BF003</option>
                        <option value="BF003">BF003</option>
                        <option value="BM001">BM001</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
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
                    <button type="button" class="btn btn-primary block" id="search">Generate Record</button>
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
<?php
require_once('../common/footer.php');
?>

<script src="../assets/vendors/jquery/jquery.min.js"></script>
<script src="../assets/vendors/jquery-datatables/jquery.dataTables.min.js"></script>
<script src="../assets/vendors/jquery-datatables/custom.jquery.dataTables.bootstrap5.min.js"></script>
<script src="../assets/vendors/fontawesome/all.min.js"></script>

<script src="../js/marks_report.js"></script>