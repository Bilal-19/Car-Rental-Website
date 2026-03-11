<?php



require_once "../DB/db_connection.php";

$submit_mode = $_REQUEST['submit_mode'];

// Vehicle Booking
if ($submit_mode == "confirm_booking") {
    $arr = array();
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
    echo json_encode($arr);
}

// Vehicle Live Search
if ($submit_mode == "live_search") {
    // echo "youre in the right place";

    // Fetch data based on search term
    $search = $_REQUEST['search_term'];

    $filterVehicles = "SELECT * FROM vehicles WHERE (make LIKE '%{$search}%' OR model LIKE '%{$search}%')";
    $filterVehiclesRes = mysqli_query($isConnect, $filterVehicles);
    $countRows = mysqli_num_rows($filterVehiclesRes);
    $output = "";

    if ($countRows > 0) {
        while ($row = mysqli_fetch_assoc($filterVehiclesRes)) {
            $output .=
                "
                <div class='relative'>
                    <img src='../Assets/Lamborghini.png' alt='Lamborghini' class='mx-auto mb-3'>
                    <p class='font-medium text-sm ml-12 md:ml-6'>" . $row['make'] . " . " . $row['model'] . "</p>
                    <p class='font-light text-sm ml-12 md:ml-6'>From <b class='font-medium'>AED " . $row['per_day_cost'] . '/ day' . "</b></p>
                    <a class='bg-[#000000] text-white rounded-full text-sm py-1.5 px-4 absolute right-15 md:right-10 bottom-15'
                        target='_blank'
                        href='" . 'http://' . $_SERVER['HTTP_HOST'] . '/Visitor/car_details.php?id=' . $row['id'] . "'>
                        View Detail</a>
                </div>
            ";

            echo $output;
        }
    } else {
        $output .= "<p class='font-medium text-sm ml-12 md:ml-6'>No records found</p>";

        echo $output;
    }
}

?>