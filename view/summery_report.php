<?php
require_once('../common/head.php');
require_once('../common/aside.php');
require_once('../common/header.php');
?>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Bar Chart</h4>
        </div>
        <div class="card-body">
            <canvas id="bar"></canvas>
        </div>
    </div>
</section>
<?php
require_once('../common/footer.php');
?>

<script src="../assets/vendors/chartjs/Chart.min.js"></script>
<script src="../assets/js/pages/ui-chartjs.js"></script>