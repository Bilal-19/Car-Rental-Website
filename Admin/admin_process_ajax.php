<?php

require_once "../DB/db_connection.php";
require_once "../utilities.php";

$submit_mode = $_REQUEST['submit_mode'];

// session_start();


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


    if ($_FILES['preview_img']['size'] > 0) {
        $uploaded_image_arr = uploadImage('preview_img');

        if ($uploaded_image_arr['status'] == 1) {
            $thumbnail_timestamp = $uploaded_image_arr['new_filename'];
            $isFileUploaded = 1;

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
            // Check if vehicle with same registration number already exist or not
            $regDupQry = "SELECT count(*) as total FROM vehicles WHERE registration_number = '{$registration_number}'";
            $regDupRes = mysqli_query($isConnect, $regDupQry);
            $regDupArr = mysqli_fetch_assoc($regDupRes);
            $count = $regDupArr['total'];

            if ($count > 0) {
                $arr['query_result'] = 0;
                $arr['query_msg'] = 'Vehicle with this Registration Number Already Exist.';
            } else {
                if (mysqli_query($isConnect, $instVehicleQry)) {
                    $arr['query_result'] = 1;
                    $arr['query_msg'] = 'New Vehicle Added Successfully.';

                } else {
                    $arr['query_result'] = 0;
                    $arr['query_msg'] = 'Something Went Wrong. Please Try Again Later.';
                }
            }
        } else {
            $isFileUploaded = 0;
        }
    }
    echo json_encode($arr);
} elseif ($submit_mode == "update_vehicle") {
    $arr = array();

    // Get Values and Implement SQL Injection

    $id = mysqli_real_escape_string($isConnect, $_POST['vehicle_id']);
    $maker = mysqli_real_escape_string($isConnect, $_POST['car_maker']);
    $model = mysqli_real_escape_string($isConnect, $_POST['car_model']);
    $engine = mysqli_real_escape_string($isConnect, $_POST['car_engine']);
    $category = mysqli_real_escape_string($isConnect, $_POST['car_category']);
    $transmission = mysqli_real_escape_string($isConnect, $_POST['car_transmission']);
    $trim = mysqli_real_escape_string($isConnect, $_POST['car_trim']);
    $hp = mysqli_real_escape_string($isConnect, $_POST['car_hp']);
    $doors = mysqli_real_escape_string($isConnect, $_POST['car_doors']);
    $fuel_type = mysqli_real_escape_string($isConnect, $_POST['car_fuel_type']);
    $cylinders = mysqli_real_escape_string($isConnect, $_POST['car_cylinders']);
    $interior_color = mysqli_real_escape_string($isConnect, $_POST['interior_color']);
    $exterior_color = mysqli_real_escape_string($isConnect, $_POST['exterior_color']);
    $drive_type = mysqli_real_escape_string($isConnect, $_POST['car_drive_type']);
    $seating_capacity = mysqli_real_escape_string($isConnect, $_POST['seating_capacity']);
    $per_day_cost = mysqli_real_escape_string($isConnect, $_POST['per_day_cost']);
    $registration_number = mysqli_real_escape_string($isConnect, $_POST['registration_number']);

    // Check if user uploads the image
    if ($_FILES['preview_img']['size'] > 0) {
        // echo 'Yes uploaded';
        $uploaded_image_arr = uploadImage('preview_img');
        if ($uploaded_image_arr['status'] == 1) {
            $thumbnail_timestamp = $uploaded_image_arr['new_filename'];
            $isFileUploaded = 1;
        } else {
            $isFileUploaded = 0;
        }
    } else {
        // Find timestamp of previous uploaded thumbnail image
        $imgQry = mysqli_query($isConnect, "SELECT thumbnail_image FROM vehicles WHERE id = $id");
        $imgRes = mysqli_fetch_assoc($imgQry);
        $thumbnail_timestamp = $imgRes['thumbnail_image'];
    }

    // Prepare update query

    $updVehicleQry = "UPDATE vehicles
            SET
            make                = '$maker', 
            model               = '$model', 
            engine_capacity     = '$engine', 
            category            = '$category', 
            transmission        = '$transmission', 
            TRIM                = '$trim', 
            horsepower          = '$trim', 
            doors               = '$doors',
            fuel_type           = '$fuel_type', 
            no_of_cylinders     = '$cylinders',
            interior_color      = '$interior_color', 
            exterior_color      = '$exterior_color',
            per_day_cost        = '$per_day_cost', 
            drive_type          = '$drive_type', 
            seating_capacity    = '$seating_capacity', 
            registration_number = '$registration_number',
            thumbnail_image     = '$thumbnail_timestamp'
    WHERE id = $id";

    if (mysqli_query($isConnect, $updVehicleQry)) {
        $arr['query_result'] = 1;
        $arr['query_msg'] = 'Vehicle Information Updated Successfully.';

    } else {
        $arr['query_result'] = 0;
        $arr['query_msg'] = 'Something Went Wrong. Please Try Again Later.';
    }
    echo json_encode($arr);

} else if ($submit_mode == "delete_vehicle") {
    $arr = array();

    $id = mysqli_escape_string($isConnect, $_GET['vehicle_id']);

    $delQry = "UPDATE vehicles SET enabled = 0 WHERE id = $id";

    if (mysqli_query($isConnect, $delQry)) {
        $arr['query_result'] = 1;
        $arr['query_msg'] = 'Record move to trash successfully.';
    } else {
        $arr['query_result'] = 0;
        $arr['query_msg'] = 'Something went wrong. Please try again later.';
    }
    echo json_encode($arr);
} else if ($submit_mode == "reset_password") {
    $arr = array();

    $user_id = mysqli_escape_string($isConnect, $_GET['user_id']);

    $hash_pswd = password_hash(12345678, PASSWORD_DEFAULT);

    $updPswdQry = "UPDATE users SET user_pswd = '$hash_pswd' WHERE id = $user_id";

    if (mysqli_query($isConnect, $updPswdQry)) {
        $arr['query_result'] = 1;
        $arr['query_msg'] = 'User password reset successfully.';
    } else {
        $arr['query_result'] = 0;
        $arr['query_msg'] = 'Something went wrong while resetting user password.';
    }

    echo json_encode($arr);
} else if ($submit_mode == "upd_account_status") {
    $arr = array();

    $acc_id = mysqli_escape_string($isConnect, $_GET['account_id']);

    // Find current status
    $AccStatusQry = mysqli_query($isConnect, "SELECT is_account_activated FROM users WHERE id = $acc_id");
    $AccStatusRes = mysqli_fetch_assoc($AccStatusQry);

    if ($AccStatusRes['is_account_activated'] == 0) {
        $updAccStatus = "UPDATE users SET is_account_activated = 1 WHERE id = $acc_id";
        if (mysqli_query($isConnect, $updAccStatus)) {
            $arr['query_result'] = 1;
            $arr['query_msg'] = 'Account Activated Successfully';
        } else {
            $arr['query_result'] = 0;
            $arr['query_msg'] = 'Something went wrong. Please try again later';
        }
    } else {
        $updAccStatus = "UPDATE users SET is_account_activated = 0 WHERE id = $acc_id";
        if (mysqli_query($isConnect, $updAccStatus)) {
            $arr['query_result'] = 1;
            $arr['query_msg'] = 'Account De-activated Successfully';
        } else {
            $arr['query_result'] = 0;
            $arr['query_msg'] = 'Something went wrong. Please try again later';
        }
    }
    echo json_encode($arr);
} else if ($submit_mode == "add_edit_brands") {
    // print_r($_POST);

    $arr = array();

    $car_brand = mysqli_real_escape_string($isConnect, $_POST['brand_name']);
    $action = mysqli_real_escape_string($isConnect, $_POST['action']);


    if ($action == "Submit") {
        $add_by = 'bilal';
        $add_ip = $_SERVER['REMOTE_ADDR'];

        $insertBrandQry = "INSERT INTO vehicle_brands 
                       (brand_name, add_by, add_ip)
                       VALUES
                       ('$car_brand','$add_by', '$add_ip')
                       ";
        // Check if record already exist.
        $dupBrandQry = "SELECT id FROM vehicle_brands WHERE brand_name = '{$car_brand}'";
        $dupBrandRes = mysqli_query($isConnect, $dupBrandQry);

        if (mysqli_num_rows($dupBrandRes) == 0 && !empty($car_brand)) {
            if (mysqli_query($isConnect, $insertBrandQry)) {
                $arr['query_result'] = 1;
                $arr['query_msg'] = 'Vehicle Brand Added Successfully';
            } else {
                $arr['query_result'] = 0;
                $arr['query_msg'] = 'Something went wrong. Please try again later.';
            }
        } else {
            $arr['query_result'] = 0;
            $arr['query_msg'] = 'Brand Name Cannot be Empty';
        }
    } else if ($action == "Update") {
        $rec_id = mysqli_real_escape_string($isConnect, $_POST['rec_id']);
        $updBrandQry = "UPDATE  vehicle_brands 
                        SET 
                        brand_name = '{$car_brand}',
                        update_by = 'admin',
                        update_ip = '{$_SERVER['REMOTE_ADDR']}',
                        update_date = NOW()
                        WHERE id = $rec_id";

        if (mysqli_query($isConnect, $updBrandQry)) {
            $arr['query_result'] = 1;
            $arr['query_msg'] = 'Vehicle Brand Updated Successfully';
        } else {
            $arr['query_result'] = 0;
            $arr['query_msg'] = 'Something went wrong. Please try again later.';
        }

    }



    echo json_encode($arr);
    // die();
} else if ($submit_mode == "edit_brand_form") {

    // Return brand name value inside a form
    $arr = array();
    // Find vehicle information
    $rec_id = mysqli_real_escape_string($isConnect, $_GET['rec_id']);

    $vehicleBrandRes = mysqli_query($isConnect, "SELECT id, brand_name FROM vehicle_brands WHERE id = $rec_id");
    $vehicleBrandResArr = mysqli_fetch_assoc($vehicleBrandRes);

    if (mysqli_num_rows($vehicleBrandRes) > 0) {
        $arr['query_result'] = 1;
        $arr['brand_name'] = $vehicleBrandResArr['brand_name'];
        $arr['id'] = $vehicleBrandResArr['id'];
    } else {
        $arr['query_result'] = 0;
    }

    echo json_encode($arr);
} else if ($submit_mode == "delete_brand") {
    $arr = array();
    $rec_id = mysqli_real_escape_string($isConnect, $_GET['rec_id']);

    if (mysqli_query($isConnect, "DELETE FROM vehicle_brands WHERE id = $rec_id")) {
        $arr['query_result'] = 1;
        $arr['query_msg'] = 'Selected Vehicle Brand Deleted Successfully.';
    } else {
        $arr['query_result'] = 0;
        $arr['query_msg'] = 'Something went wrong. Please try again later.';
    }
    echo json_encode($arr);
} else if ($submit_mode == "add_edit_model") {
    // print_r($_POST);



    $arr = array();

    $brand_id = mysqli_real_escape_string($isConnect, $_POST['brand_id']);
    $model_name = mysqli_real_escape_string($isConnect, $_POST['model_name']);
    $action = mysqli_real_escape_string($isConnect, $_POST['action']);


    if ($action == "Submit") {
        $add_by = 'bilal';
        $add_ip = $_SERVER['REMOTE_ADDR'];

        $insModelQry = "INSERT INTO vehicle_models (model_name, brand_id, add_by, add_ip) VALUES ('$model_name', '$brand_id' ,'$add_by', '$add_ip')";
        // echo $insModelQry; die();
        // Check if record already exist.
        $dupModelQry = "SELECT id FROM vehicle_models WHERE model_name = '{$model_name}'";
        $dupModelRes = mysqli_query($isConnect, $dupModelQry);

        if (mysqli_num_rows($dupModelRes) == 0 && !empty($model_name)) {
            if (mysqli_query($isConnect, $insModelQry)) {
                $arr['query_result'] = 1;
                $arr['query_msg'] = 'New Model Added Successfully';
            } else {
                $arr['query_result'] = 0;
                $arr['query_msg'] = 'Something went wrong. Please try again later.';
            }
        } else {
            $arr['query_result'] = 0;
            $arr['query_msg'] = 'Model Name Cannot be Empty';
        }
    }

    /*else if ($action == "Update") {
        $rec_id = mysqli_real_escape_string($isConnect, $_POST['rec_id']);
        $updBrandQry = "UPDATE  vehicle_brands 
                        SET 
                        brand_name = '{$car_brand}',
                        update_by = 'admin',
                        update_ip = '{$_SERVER['REMOTE_ADDR']}',
                        update_date = NOW()
                        WHERE id = $rec_id";

        if (mysqli_query($isConnect, $updBrandQry)) {
            $arr['query_result'] = 1;
            $arr['query_msg'] = 'Vehicle Brand Updated Successfully';
        } else {
            $arr['query_result'] = 0;
            $arr['query_msg'] = 'Something went wrong. Please try again later.';
        }

    }
    */
    echo json_encode($arr);
    // die();
} else if ($submit_mode == 'editable_model_form') {
    // Return brand name value inside a form
    $arr = array();
    // Find vehicle information
    $rec_id = mysqli_real_escape_string($isConnect, $_GET['record_id']);

    $vehicleModelRes = mysqli_query($isConnect, "SELECT model_name, brand_id FROM vehicle_models WHERE id = $rec_id");
    $vehicleModelResArr = mysqli_fetch_assoc($vehicleModelRes);

    if (mysqli_num_rows($vehicleModelRes) > 0) {
        $arr['query_result'] = 1;
        $arr['model_name'] = $vehicleModelResArr['model_name'];
        $arr['brand_id'] = $vehicleModelResArr['brand_id'];
    } else {
        $arr['query_result'] = 0;
    }

    echo json_encode($arr);
}

if ($submit_mode == "upload_vehicle_images") {
    // Code this part later for uploading multiple images of vehicle
    /*
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

            if ($file['size'] > 0) {
                $filename = uploadImage($file);
                if (mysqli_query($isConnect, "INSERT INTO vehicle_images (image_path, vehicle_id) VALUES ('$filename', '$vehicle_foreign_key')")) {
                    $isFileUploaded = 1;
                } else {
                }
            } else {
                $isFileUploaded = 0;
            }
        }

        if ($isFileUploaded == 1) {
            $arr['query_result'] = 1;
            $arr['query_msg'] = 'New Vehicle Added Successfully.';
        } else {
            $arr['query_result'] = 0;
            $arr['query_msg'] = 'Failed to Add New Vehicle.';
        }
        */
}
?>