<?php
header("content-Type: application/JSON");
include("../common/database.php");
$action = $_POST['action'];


//read
function read($conn)
{
    extract($_POST);
    $query = "CALL transcript_sp('$student_id')";
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



//
if (isset($action)) {
    $action($conn);
} else {
    echo json_encode(array("status" => false, "message" => "Not Found"));
}
