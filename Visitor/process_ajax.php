<?php



require_once "../DB/db_connection.php";

$submit_mode = $_REQUEST['submit_mode'];

$arr = array();

if ($submit_mode == "confirm_booking") {
    $pickup_date = $_REQUEST['pickup_date'];
    $return_date = $_REQUEST['return_date'];
    $pickup_location = $_REQUEST['pickup_location'];
    $is_driver_needed = $_REQUEST['is_driver_needed'];
    $additional_notes = $_REQUEST['additional_notes'];
    $vehicle_id = $_REQUEST['vehicle_id'];

    $instBookQry = "INSERT INTO vehicle_booking (pickup_date, return_date, pickup_location,  need_driver, additional_notes, user_id, vehicle_id)
                    VALUES ( '$pickup_date', '$return_date', '$pickup_location', '$is_driver_needed', '$additional_notes', 1, $vehicle_id)";

    $instBookRes = mysqli_query($isConnect, $instBookQry);

    if ($instBookRes == 1) {
        $arr['query_result'] = 1;
    } else {
        $arr['query_result'] = 0;
    }
}

echo json_encode($arr);
?>