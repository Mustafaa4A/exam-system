<?php
header("content-Type: application/JSON");
include("../common/database.php");
$action = $_POST['action'];


//read
function studentsCount($conn)
{
    extract($_POST);
    $query = "SELECT COUNT(*) as count from student";
    $result = $conn->query($query);
    $data =   $result->fetch_assoc();

    if ($result) {
        $result_data = array("status" => true, "message" => $data);
    } else {
        $result_data = array("status" => false, "message" => $conn->error());
    }

    echo json_encode($result_data);
}

function UsersCount($conn)
{
    extract($_POST);
    $query = "SELECT COUNT(*) as count from users";
    $result = $conn->query($query);
    $data =   $result->fetch_assoc();

    if ($result) {
        $result_data = array("status" => true, "message" => $data);
    } else {
        $result_data = array("status" => false, "message" => $conn->error());
    }

    echo json_encode($result_data);
}

function EmployeeCount($conn)
{
    extract($_POST);
    $query = "SELECT COUNT(*) as count from employee";
    $result = $conn->query($query);
    $data =   $result->fetch_assoc();

    if ($result) {
        $result_data = array("status" => true, "message" => $data);
    } else {
        $result_data = array("status" => false, "message" => $conn->error());
    }

    echo json_encode($result_data);
}
function RecordsCount($conn)
{
    extract($_POST);
    $query = "SELECT COUNT(*) as count from marks";
    $result = $conn->query($query);
    $data =   $result->fetch_assoc();

    if ($result) {
        $result_data = array("status" => true, "message" => $data);
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
