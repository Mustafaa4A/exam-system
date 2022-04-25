<?php
require_once('../common/head.php');
require_once('../common/aside.php');
require_once('../common/header.php');
?>

<style>
    fieldset {
        border: 1px solid #ddd !important;
        margin: 0;
        padding: 10px;
        position: relative;
        border-radius: 4px;
        background-color: #ffffff;
        padding-left: 10px !important;
    }

    legend {
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 0px;
        width: auto;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px 15px 5px 15px;
        background-color: #ffffff;
    }
</style>
<section class="section">
    <div class="card">
        <form action="" method="POST" id="form">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="user_id">Select User</label>
                            <input list="users" id="user_id" name="user_id" class="form-control round" placeholder="Users" required>
                            <datalist id="users">
                            </datalist>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <fieldset class="col-md-12 pb-5 custom-checkbox">
                    <legend style="background-color: #eb262c;color: #fff;">SYSTEM ROLES &nbsp; &nbsp; &nbsp;
                        <input type="checkbox" class="custom-control-input" id="check_all" name="check_all"> &nbsp;
                        &nbsp;
                        <label class="custom-control-label" for="check_all">CHECK ALL</label>
                    </legend>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div id="content_body" class="row" style="justify-content:center;">
                                <fieldset class="col-md-2 m-3 pl-3 custom-checkbox">
                                    <legend style="font-weight:600;background-color: #231B50;color: #fff;"><b><label class="custom-control custom-checkbox mt-2" for="Admin"><input type="checkbox" class="custom-control-input" id="Admin" name="module[]" module="Admin" value="Admin">
                                                <span class="custom-control-label">Admin</span></label></b></legend>
                                    <ul class="custom-control custom-checkbox" style="list-style-type:none">
                                        <li><label class="custom-control custom-checkbox" for="1"><input type="checkbox" class="custom-control-input" id="1" name="submenu[]" menu_id="1" module="Admin" value="1">
                                                <span class="custom-control-label">Dashboard</span></label></li>
                                    </ul>
                                </fieldset>
                                <!-- <fieldset class="col-md-2 m-3 pl-3 custom-checkbox">
                                    <legend style="font-weight:600;background-color: #231B50;color: #fff;"><b><label class="custom-control custom-checkbox mt-2" for="Customer"><input type="checkbox" class="custom-control-input" id="Customer" name="module[]" module="Customer" value="Customer">
                                                <span class="custom-control-label">Customer</span></label></b></legend>
                                    <ul class="custom-control custom-checkbox" style="list-style-type:none">
                                        <li><label class="custom-control custom-checkbox" for="7"><input type="checkbox" class="custom-control-input" id="7" name="submenu[]" menu_id="7" module="Customer" value="7">
                                                <span class="custom-control-label">Customers</span></label></li>
                                    </ul>
                                </fieldset>
                                <fieldset class="col-md-2 m-3 pl-3 custom-checkbox">
                                    <legend style="font-weight:600;background-color: #231B50;color: #fff;"><b><label class="custom-control custom-checkbox mt-2" for="Expense"><input type="checkbox" class="custom-control-input" id="Expense" name="module[]" module="Expense" value="Expense">
                                                <span class="custom-control-label">Expense</span></label></b></legend>
                                    <ul class="custom-control custom-checkbox" style="list-style-type:none">
                                        <li><label class="custom-control custom-checkbox" for="9"><input type="checkbox" class="custom-control-input" id="9" name="submenu[]" menu_id="9" module="Expense" value="9">
                                                <span class="custom-control-label">Expense</span></label></li>
                                    </ul>
                                </fieldset>
                                <fieldset class="col-md-2 m-3 pl-3 custom-checkbox">
                                    <legend style="font-weight:600;background-color: #231B50;color: #fff;"><b><label class="custom-control custom-checkbox mt-2" for="Medicine"><input type="checkbox" class="custom-control-input" id="Medicine" name="module[]" module="Medicine" value="Medicine">
                                                <span class="custom-control-label">Medicine</span></label></b></legend>
                                    <ul class="custom-control custom-checkbox" style="list-style-type:none">
                                        <li><label class="custom-control custom-checkbox" for="4"><input type="checkbox" class="custom-control-input" id="4" name="submenu[]" menu_id="4" module="Medicine" value="4">
                                                <span class="custom-control-label">Pharmacy Stock</span></label></li>
                                        <li><label class="custom-control custom-checkbox" for="5"><input type="checkbox" class="custom-control-input" id="5" name="submenu[]" menu_id="5" module="Medicine" value="5">
                                                <span class="custom-control-label">Pharmacy Sales</span></label></li>
                                        <li><label class="custom-control custom-checkbox" for="6"><input type="checkbox" class="custom-control-input" id="6" name="submenu[]" menu_id="6" module="Medicine" value="6">
                                                <span class="custom-control-label">Purchase Pharmacy</span></label></li>
                                    </ul>
                                </fieldset>
                                <fieldset class="col-md-2 m-3 pl-3 custom-checkbox">
                                    <legend style="font-weight:600;background-color: #231B50;color: #fff;"><b><label class="custom-control custom-checkbox mt-2" for="Reports"><input type="checkbox" class="custom-control-input" id="Reports" name="module[]" module="Reports" value="Reports">
                                                <span class="custom-control-label">Reports</span></label></b></legend>
                                    <ul class="custom-control custom-checkbox" style="list-style-type:none">
                                        <li><label class="custom-control custom-checkbox" for="11"><input type="checkbox" class="custom-control-input" id="11" name="submenu[]" menu_id="11" module="Reports" value="11">
                                                <span class="custom-control-label">Stock Report</span></label></li>
                                    </ul>
                                </fieldset>
                                <fieldset class="col-md-2 m-3 pl-3 custom-checkbox">
                                    <legend style="font-weight:600;background-color: #231B50;color: #fff;"><b><label class="custom-control custom-checkbox mt-2" for="Staff"><input type="checkbox" class="custom-control-input" id="Staff" name="module[]" module="Staff" value="Staff">
                                                <span class="custom-control-label">Staff</span></label></b></legend>
                                    <ul class="custom-control custom-checkbox" style="list-style-type:none">
                                        <li><label class="custom-control custom-checkbox" for="2"><input type="checkbox" class="custom-control-input" id="2" name="submenu[]" menu_id="2" module="Staff" value="2">
                                                <span class="custom-control-label">Employee</span></label></li>
                                    </ul>
                                </fieldset>
                                <fieldset class="col-md-2 m-3 pl-3 custom-checkbox">
                                    <legend style="font-weight:600;background-color: #231B50;color: #fff;"><b><label class="custom-control custom-checkbox mt-2" for="Supplier"><input type="checkbox" class="custom-control-input" id="Supplier" name="module[]" module="Supplier" value="Supplier">
                                                <span class="custom-control-label">Supplier</span></label></b></legend>
                                    <ul class="custom-control custom-checkbox" style="list-style-type:none">
                                        <li><label class="custom-control custom-checkbox" for="8"><input type="checkbox" class="custom-control-input" id="8" name="submenu[]" menu_id="8" module="Supplier" value="8">
                                                <span class="custom-control-label">Supplier</span></label></li>
                                    </ul>
                                </fieldset>
                                <fieldset class="col-md-2 m-3 pl-3 custom-checkbox">
                                    <legend style="font-weight:600;background-color: #231B50;color: #fff;"><b><label class="custom-control custom-checkbox mt-2" for="User"><input type="checkbox" class="custom-control-input" id="User" name="module[]" module="User" value="User">
                                                <span class="custom-control-label">User</span></label></b></legend>
                                    <ul class="custom-control custom-checkbox" style="list-style-type:none">
                                        <li><label class="custom-control custom-checkbox" for="10"><input type="checkbox" class="custom-control-input" id="10" name="submenu[]" menu_id="10" module="User" value="10">
                                                <span class="custom-control-label">User</span></label></li>
                                    </ul>
                                </fieldset> -->
                            </div>
                        </div>
                    </div>

                </fieldset>
            </div>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-success">Save Change</button>
            </div>
        </form>
    </div>
</section>


<?php
require_once('../common/footer.php');
?>


<script src="../assets/vendors/jquery/jquery.min.js"></script>
<script src="../assets/vendors/jquery-datatables/jquery.dataTables.min.js"></script>
<script src="../assets/vendors/jquery-datatables/custom.jquery.dataTables.bootstrap5.min.js"></script>
<script src="../assets/vendors/fontawesome/all.min.js"></script>

<script src="../js/user_rolls.js"></script>
<script>
    $(".alert").hide();
</script>