<?php
// session_start();
header("content-Type: application/JSON");
include("../common/database.php");
$action = $_POST['action'];


//insert
function login($conn)
{

    extract($_POST);

    $query = "CALL login_sp ('$username', '$password')";
    $result = $conn->query($query);
    $data = [];
    if ($result) {
        $row = $result->fetch_assoc();
        if (isset($row['message']) && $row['message'] == "Denied") {
            $result_data = array("status" => false, "message" => "Incorrect username or password..");
        } else if (isset($row['message']) && $row['message'] == "inActive") {
            $result_data = array("status" => false, "message" => "This user has been locked please contact to the Administrator..");
        } else {
            $data[] = $row;
            $result_data = array("status" => true, "message" => $data);
            foreach ($row as $key => $value) {
                $_SESSION[$key] = $value;
            }
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
