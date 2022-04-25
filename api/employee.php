<?php
header("content-Type: application/JSON");
include("../common/database.php");
$action = $_POST['action'];


//read
function read($conn)
{
    extract($_POST);
    $query = "CALL employee_read_sp ('$emp_id')";
    $result = $conn->query($query);

    // echo $result;

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
    $query = "CALL employee_delete_sp ('$emp_id')";
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

    $query = "CALL employee_sp('$emp_id', '$emp_name', '$gender', '$degree','$title', '$address' , '$phone','$email', '$salary','$user_id','$status', '$date', '$action')";
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

    $query = "CALL employee_sp ('$emp_id', '$emp_name', '$gender', '$degree','$title', '$address' , '$phone','$email', '$salary','$user_id','$status', '$date', '$action')";
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
if (isset($action)) {
    $action($conn);
} else {
    echo json_encode(array("status" => false, "message" => "Not Found"));
}
