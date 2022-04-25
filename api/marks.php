<?php
header("content-Type: application/JSON");
include("../common/database.php");
$action = $_POST['action'];


//read
function read($conn)
{
    extract($_POST);
    $query = "CALL marks_read_sp ('$record_id')";
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

//search record
function search($conn)
{
    extract($_POST);
    $query = "CALL marks_record_sp('$student_id', '$course_id', '$semester')";
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


//fill courses
function fillCourse($conn)
{
    extract($_POST);
    $query = "CALL course_fill_sp()";
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
function fillStudent($conn)
{
    extract($_POST);
    $query = "CALL student_fill_sp()";
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
    $query = "CALL marks_delete_sp ('$record_id')";
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
    $query = "CALL marks_sp('$record_id','$student_id','$course_id','$semester','$course_work','$midterm','$final','$total','$remark', '$user_id','$date', '$action')";
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
    $query = "CALL marks_sp('$record_id','$student_id','$course_id','$semester','$course_work','$midterm','$final','$total','$remark', '$user_id','$date', '$action')";
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
