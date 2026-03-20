<?php

require_once "../DB/db_connection.php";
require_once "../utilities.php";

$submit_mode = $_REQUEST['submit_mode'];


if ($submit_mode == "add_vehicle") {
    $arr = array();

    // Get Values and Implement SQL Injection

    $car_maker = mysqli_real_escape_string($isConnect, $_POST['car_maker']);
    $car_model = mysqli_real_escape_string($isConnect, $_POST['car_model']);
    $car_engine = mysqli_real_escape_string($isConnect, $_POST['car_engine']);
    $car_category = mysqli_real_escape_string($isConnect, $_POST['car_category']);
    $car_transmission = mysqli_real_escape_string($isConnect, $_POST['car_transmission']);
    $car_trim = mysqli_real_escape_string($isConnect, $_POST['car_trim']);
    $car_hp = mysqli_real_escape_string($isConnect, $_POST['car_hp']);
    $car_doors = mysqli_real_escape_string($isConnect, $_POST['car_doors']);
    $car_fuel_type = mysqli_real_escape_string($isConnect, $_POST['car_fuel_type']);
    $car_cylinders = mysqli_real_escape_string($isConnect, $_POST['car_cylinders']);
    $interior_color = mysqli_real_escape_string($isConnect, $_POST['interior_color']);
    $exterior_color = mysqli_real_escape_string($isConnect, $_POST['exterior_color']);
    $car_drive_type = mysqli_real_escape_string($isConnect, $_POST['car_drive_type']);
    $seating_capacity = mysqli_real_escape_string($isConnect, $_POST['seating_capacity']);
    $per_day_cost = mysqli_real_escape_string($isConnect, $_POST['per_day_cost']);
    $registration_number = mysqli_real_escape_string($isConnect, $_POST['registration_number']);
    $thumbnail_timestamp = uploadImage('preview_img');

    $instVehicleQry = "INSERT INTO vehicles 
                       (
                       make, model, engine_capacity, category, transmission, TRIM, horsepower, doors, fuel_type, no_of_cylinders,
                       interior_color, exterior_color, per_day_cost, drive_type, seating_capacity, registration_number,thumbnail_image
                       )
                       VALUES
                       (
                       '$car_maker', '$car_model', '$car_engine', '$car_category', '$car_transmission', '$car_trim', '$car_hp', '$car_doors',
                       '$car_fuel_type', '$car_cylinders', '$interior_color', '$exterior_color', '$per_day_cost', '$car_drive_type',
                       '$seating_capacity', '$registration_number', '$thumbnail_timestamp'
                       )
                       ";
    if (mysqli_query($isConnect, $instVehicleQry)) {
        $arr['query_result'] = 1;

        $vehicle_foreign_key = mysqli_insert_id($isConnect);

        foreach ($_FILES['vehicle_imgs']['name'] as $key => $val) {
            // Key: Index(0,1)
            // Value: cnic_back.jpg

            $file = [
                'name' => $_FILES['vehicle_imgs']['name'][$key],
                'type' => $_FILES['vehicle_imgs']['type'][$key],
                'tmp_name' => $_FILES['vehicle_imgs']['tmp_name'][$key],
                'error' => $_FILES['vehicle_imgs']['error'][$key],
                'size' => $_FILES['vehicle_imgs']['size'][$key]
            ];

            $filename = uploadImage($file);

            if (mysqli_query($isConnect, "INSERT INTO vehicle_images (image_path, vehicle_id) VALUES ('$filename', '$vehicle_foreign_key')")) {
                $arr['query_result'] = 1;
            } else {
                $arr['query_result'] = 0;
            }
        }
    } else {
        $arr['query_result'] = 0;
        $arr['query_msg'] = 'Something Went Wrong. Please Try Again Later.';
    }

    echo json_encode($arr);
}

?>