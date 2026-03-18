<?php

require_once "../DB/db_connection.php";

$submit_mode = $_REQUEST['submit_mode'];


if ($submit_mode == "add_vehicle") {

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    

    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";

    die();
    

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
    // $thumbnail_image = mysqli_real_escape_string($isConnect, $_POST['thumbnail_image']); //Get image name

    /*
    // Check image file type
    echo strtolower(pathinfo("/Assets/uploads/" . basename($_FILES['thumbnail_image']['name']), PATHINFO_EXTENSION));
    echo $thumbnail_image; die();

    // Add logic to fetch image and store into folder

    function uploadImage()
    {
        $filename = $_FILES['thumbnail_image']['name'];
        echo $filename; die();
    }
    uploadImage();

    // Prepare Insert Query

    $instVehicleQry = "INSERT INTO vehicles 
                       (
                       make, model, engine_capacity, category, transmission, TRIM, horsepower, doors, fuel_type, no_of_cylinders,
                       interior_color, exterior_color, per_day_cost, drive_type, seating_capacity, registration_number
                       )
                       VALUES
                       (
                       '$car_maker', '$car_model', '$car_engine', '$car_category', '$car_transmission', '$car_trim', '$car_hp', '$car_doors',
                       '$car_fuel_type', '$car_cylinders', '$interior_color', '$exterior_color', '$per_day_cost', '$car_drive_type',
                       '$seating_capacity', '$registration_number'
                       )
                       ";
    echo $instVehicleQry;
    die();

    // Insert records only when all fields are filled
    */
}

?>