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
    // echo $instBookQry;

    // Check for duplicate booking.
    // Criteria: Pickup date, return date, & vehicle id

    $dupQry = "SELECT COUNT(*) as 'total' FROM vehicle_booking 
               WHERE 
               vehicle_id = $vehicle_id AND
               pickup_date <= '$pickup_date' AND return_date <= '$return_date'";
    
    // echo $dupQry; die();
    $dupRes = mysqli_query($isConnect, $dupQry);
    $dupResArr = mysqli_fetch_assoc($dupRes);

    if ($dupResArr['total'] == 0) {
        $instBookRes = mysqli_query($isConnect, $instBookQry);
        if ($instBookRes == 1) {
            $arr['query_result'] = 1;
            $arr['query_msg'] = 'Booking Confirmed';
        } else {
            $arr['query_result'] = 0;
            $arr['query_msg'] = 'Something went wrong.';
        }
    } else {
        $arr['query_result'] = 0;
        $arr['query_msg'] = 'Vehicle already booked for the selected dates.';
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