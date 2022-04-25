<?php
require_once('../common/head.php');
require_once('../common/aside.php');
require_once('../common/header.php');
?>

<section class="section">
    <div class="card">
        <h5 class="card-header">
            Show As Transcript
        </h5>
        <div class="row p-4">
            <div class="col-sm-5">
                <div class="form-group">
                    <input list="students" id="student" name="student" class="form-control round" placeholder="Studnt" required>
                    <datalist id="students">
                    </datalist>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <button type="button" class="btn btn-primary block" id="search">Search Record</button>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="row" id="transcript">
            </div>
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

<script src="../js/transcript.js"></script>