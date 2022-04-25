<?php
header("content-Type: application/JSON");
include("../common/database.php");
$action = $_POST['action'];

function read($conn)
{
    extract($_POST);
    $query = "CALL users_read_sp ('$user_id')";
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
    $query = "CALL users_delete_sp ('$user_id')";
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

    $query = "CALL users_sp ('$user_id', '$username', '$password', '$status', '$reg_date', '$action')";
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

    $query = "CALL users_sp ('$user_id', '$username', '$password', '$status', '$reg_date', '$action')";
    $result = $conn->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
        if ($row['message'] == "Updated") {
            $result_data = array("status" => true, "message" => "Updated Successfully");
        } else {
            $result_data = array("status" => false, "message" => $conn->error());
        }
    } else {
        $result_data = array("status" => false, "message" => $conn->error());
    }

    echo json_encode($result_data);
}

//

function fillUser($conn)
{
    extract($_POST);

    $query = "CALL fill_user_sp()"; // statement
    $result = $conn->query($query); // excution

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
        $result_data = array("status" => false, "message" => $conn->error());
    }

    echo json_encode($result_data);
}


function fetchUserRolls($conn)
{
    extract($_POST);

    $query = "CALL user_rolls_get_sp('$user_id')"; // statement
    $result = $conn->query($query); // excution

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
        $result_data = array("status" => false, "message" => $conn->error());
    }

    echo json_encode($result_data);
}


function updateRolls($conn)
{
    extract($_POST);
    // $userId = $_SESSION['user_id'];
    $result_info = '';

    if ($menu_id == 0) {
        $query = "CALL user_rolls_sp('$user_id','$menu_id', '0')";
        // $conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DATABASE);
        $result = $conn->query($query);
        $result_data = [];
        if ($result) {
            $result_data = array('status' => true, 'message' => 'User Permissions has been saved successfully ');
        } else {
            $result_data = array('status' => false, 'message' => $conn->error);
        }
    } else {
        $count = count($menu_id);
        for ($i = 0; $i < $count; $i++) {
            $query = "CALL user_rolls_sp('$user_id','$menu_id[$i]', $i)";
            $conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DATABASE);
            $result = $conn->query($query);
            $result_data = [];
            if ($result) {
                $result_data = array('status' => true, 'message' => 'User Permissions has been saved successfully ');
            } else {
                $result_data = array('status' => false, 'message' => $conn->error);
            }
        }
    }


    echo json_encode($result_data);
}
function readMenus($conn)
{
    extract($_POST);

    $query = "CALL user_menu_get()"; // statement
    $result = $conn->query($query); // excution

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
        $result_data = array("status" => false, "message" => $conn->error());
    }

    echo json_encode($result_data);
}

//
if (isset($action)) {
    $action($conn);
} else {
    echo json_encode(array("status" => false, "message" => "Not Found"));
}
