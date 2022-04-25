<?php
header("content-Type: application/JSON");
include("../common/database.php");
$action = $_POST['action'];


//read
function read($conn)
{
    extract($_POST);
    $query = "CALL menu_read_sp ('$menu_id')";
    $result = $conn->query($query);

    if ($result) {
        $num_rows = $result->num_rows;
        if ($num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $result_data = array("status" => true, "message" => $data);
        } else {
            $result_data = array("status" => false, "message" => "Not Found");
        }
    } else {
        $result_data = array("status" => false, "message" => $conn->error());
    }

    echo json_encode($result_data);
}

//fill employee
function fillUser($conn)
{
    extract($_POST);
    $query = "CALL users_fill_sp ()";
    $result = $conn->query($query);

    if ($result) {
        $num_rows = $result->num_rows;
        if ($num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $result_data = array("status" => true, "message" => $data);
        } else {
            $result_data = array("status" => false, "message" => "Not Found");
        }
    } else {
        $result_data = array("status" => false, "message" => $conn->error());
    }

    echo json_encode($result_data);
}
//delete
function delete($conn)
{

    extract($_POST);
    $query = "CALL menu_delete_sp ('$menu_id')";
    $result = $conn->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
        if ($row['message'] == "Success") {
            $result_data = array("status" => true, "message" => "Deleted Successfully");
        } else {
            $result_data = array("status" => false, "message" => $conn->error());
        }
    } else {
        $result_data = array("status" => false, "message" => $conn->error());
    }

    echo json_encode($result_data);
}

//insert
function insert($conn)
{

    extract($_POST);
    $user_id = $_SESSION['ID'];
    $query = "CALL menu_sp ('$menu_id', '$menu_name', '$menu_link', '$menu_module', '$user_id' ,'$reg_date', '$action')";
    $result = $conn->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
        if ($row['message'] == "Inserted") {
            $result_data = array("status" => true, "message" => "Inserted Successfully");
        } else {
            $result_data = array("status" => false, "message" => $conn->error());
        }
    } else {
        $result_data = array("status" => false, "message" => $conn->error());
    }

    echo json_encode($result_data);
}
//update
function update($conn)
{

    extract($_POST);
    $user_id = $_SESSION['ID'];
    $query = "CALL menu_sp ('$menu_id', '$menu_name', '$menu_link', '$menu_module', '$user_id' ,'$reg_date', '$action')";
    $result = $conn->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
        if ($row['message'] == "Updated") {
            $result_data = array("status" => true, "message" => "Updated Successfully");
        } else {
            $result_data = array("status" => false, "message" => "Unable to Update");
        }
    } else {
        $result_data = array("status" => false, "message" => $conn->error());
    }

    echo json_encode($result_data);
}

function load_nav($conn)
{
    extract($_POST);
    $userId = $_SESSION['user_id'];
    $query = "CALL `load_nav_user_ps`('$userId')";
    $result = $conn->query($query);
    $result_data = array();
    if ($result) {
        $num_rows = $result->num_rows;
        if ($num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $result_data = array("status" => true, "message" => $data);
        } else {
            $result_data = array("status" => false, "message" => "Data Not Found");
        }
    } else {
        $result_data = array("status" => false, "message" => $conn->error);
    }

    echo json_encode($result_data);
}

//
if (isset($action)) {
    $action($conn);
} else {
    echo json_encode(array("status" => false, "message" => "Not Found"));
}
