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




if ($submit_mode == "create_account") {
    $arr = array();

    // Form Method: POST, then extract the value using $_POST

    // Create user account here

    // To prevent sql injection, use mysqli_real_escape_string
    $full_name = mysqli_real_escape_string($isConnect, $_POST['full_name']);
    $email_address = mysqli_real_escape_string($isConnect, $_POST['email_address']);
    $phone = mysqli_real_escape_string($isConnect, $_POST['phone']);
    $password = mysqli_real_escape_string($isConnect, $_POST['password']);

    if (empty($full_name) || empty($email_address) || empty($phone) || empty($password)) {
        $arr['query_result'] = 0;
        $arr['query_msg'] = 'Please fill all the required fields.';
    } else {

        // To store password in hash/encrypted format, use password_hash, not md5 (not secure anymore).

        // PASSWORD_DEFAULT: Use the strongest recommended password hashing algorithm available in the current PHP version.
        $password = password_hash($password, PASSWORD_DEFAULT);


        // Check for email with this user already exist or not
        $dupEmailQry = "SELECT count(*) as total FROM users WHERE email_address = '{$email_address}'";
        $dupEmailRes = mysqli_query($isConnect, $dupEmailQry);
        $dupEmailResArr = mysqli_fetch_assoc($dupEmailRes);

        $createUserQry = "INSERT INTO users (full_name, email_address, phone, user_pswd) VALUES ('$full_name', '$email_address', '$phone', '$password')";

        if ($dupEmailResArr['total'] == 0) {
            // Create user
            $createUserRes = mysqli_query($isConnect, $createUserQry); //Return boolean 1 or 0

            if ($createUserRes) {
                $arr['query_result'] = 1;
                $arr['query_msg'] = 'Account Created Successfully';
            } else {
                $arr['query_result'] = 0;
                $arr['query_msg'] = 'Something went wrong. Please try again later.';
            }
        } else {
            $arr['query_result'] = 0;
            $arr['query_msg'] = 'User with this Email Already Exist.';
        }
    }

    echo json_encode($arr);
}


if ($submit_mode == "login") {
    $arr = array();

    // To prevent sql injection, use mysqli_real_escape_string
    $email_address = mysqli_real_escape_string($isConnect, $_POST['email_address']);
    $password = mysqli_real_escape_string($isConnect, $_POST['password']);

    // hashed_password
    // hashed_pswd = password_hash($password, PASSWORD_DEFAULT);

    // Find stored password from DB
    $storePswdQry = "SELECT * FROM users WHERE email_address = '{$email_address}'";
    $storePswdRes = mysqli_query($isConnect, $storePswdQry);
    $storePswdResArr = mysqli_fetch_assoc($storePswdRes);

    $stored_password = $storePswdResArr['user_pswd'];

    // echo $hashed_pswd . "<br>" . $stored_password; die();

    if (password_verify($password, $stored_password)) {
        session_start();

        $_SESSION['username'] = $storePswdResArr['full_name'];
        $_SESSION['useremail'] = $storePswdResArr['email_address'];

        $arr['query_result'] = 1;
        $arr['query_msg'] = 'Logged In Successfully';
    } else {
        $arr['query_result'] = 0;
        $arr['query_msg'] = 'Incorrect Email or Password';
    }

    echo json_encode($arr);


} else if ($submit_mode == "submit_enquiry") {

    $arr = array();

    // Fetch form values
    $full_name = mysqli_real_escape_string($isConnect, $_POST['full_name']);
    $email_address = mysqli_real_escape_string($isConnect, $_POST['email_address']);
    $phone = mysqli_real_escape_string($isConnect, $_POST['phone']);
    $subject = mysqli_real_escape_string($isConnect, $_POST['subject']);
    $message = mysqli_real_escape_string($isConnect, $_POST['message']);

    if (empty($full_name) || empty($email_address) || empty($phone) || empty($subject) || empty($message)) {
        $arr['query_result'] = 0;
        $arr['query_msg'] = 'Please fill all the fields.';
    } else {
        $enquiryQry = "INSERT INTO general_enquiry(full_name, email_address,phone,message_subject,user_message) 
                        VALUES('$full_name', '$email_address', '$phone','$subject','$message')";
        $enquiryRes = mysqli_query($isConnect, $enquiryQry);

        if ($enquiryRes) {
            $arr['query_result'] = 1;
            $arr['query_msg'] = 'Enquiry submitted.';
        } else {
            $arr['query_result'] = 0;
            $arr['query_msg'] = 'Something went wrong. Please try again later.';
        }
    }
    echo json_encode($arr); //Convert object / array into JSON format
}

?>