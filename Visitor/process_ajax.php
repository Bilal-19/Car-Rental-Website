<?php
session_start();

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
            $output .= "
                        <div class='relative'>
                            <img src='http://" . $_SERVER['HTTP_HOST'] . "/Assets/uploads/" . $row['thumbnail_image'] . "' alt='Lamborghini' class='object-cover h-72 w-full rounded-md mb-2'>
                            
                            <div class='flex flex-row justify-between items-center'>
                                <div>
                                    <p class='font-medium text-sm'>" . $row['make'] . " " . $row['model'] . "</p>
                                    <p class='font-light text-sm'>
                                        From <b class='font-medium'>AED " . $row['per_day_cost'] . "/ day</b>
                                    </p>
                                </div>
                                
                                <div>
                                    <a class='bg-[#7B5D01] hover:bg-[#3b3112] text-white rounded-md text-sm py-2 px-3'
                                        target='_blank'
                                        href='http://" . $_SERVER['HTTP_HOST'] . "/Visitor/car_details.php?id=" . $row['id'] . "'>
                                        <i class='fa-solid fa-circle-info'></i>
                                        View Detail
                                    </a>
                                </div>
                            </div>
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
        $dupEmailQry = "SELECT 
                        count(email_address) as total_email, 
                        count(phone) as total_phone_no 
                        FROM users 
                        WHERE email_address = '{$email_address}' OR phone = '{$phone}'";
        $dupEmailRes = mysqli_query($isConnect, $dupEmailQry);
        $dupEmailResArr = mysqli_fetch_assoc($dupEmailRes);

        $createUserQry = "INSERT INTO users (full_name, email_address, phone, user_pswd) VALUES ('$full_name', '$email_address', '$phone', '$password')";

        $errorField = "";
        if ($dupEmailResArr['total_phone_no'] > 0 && $dupEmailResArr['total_email'] > 0) $errorField = "Email Address & Phone Number";
        if ($dupEmailResArr['total_phone_no'] > 0 && $dupEmailResArr['total_email'] == 0) $errorField = "Phone Number";
        if ($dupEmailResArr['total_email'] > 0 && $dupEmailResArr['total_phone_no'] == 0) $errorField = "Email Address";

        if ($dupEmailResArr['total_email'] == 0 && $dupEmailResArr['total_phone_no'] == 0) {

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
            $arr['query_msg'] = 'User with this ' . $errorField . ' Already Exist.';
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
} else if ($submit_mode == "load_more_vehicles") {
    // Get current page & active query

    $current_page = (int) $_GET['page'];
    $active_query = $_GET['active_query'];

    // echo "Page: " . $current_page . "<br> Active Query: " . $active_query; die;
    // Set Limit & Offset
    $limit = 6;
    $off_set = ($current_page - 1) * $limit;

    // Construct paginate query
    $paginate_query = $active_query . " LIMIT $off_set, $limit";
    //var_dump($current_page);

    // echo $paginate_query . '<br>'; die;
    $allVehiclesRes = mysqli_query($isConnect, $paginate_query);

    while ($row = mysqli_fetch_assoc($allVehiclesRes)) { ?>
                <!-- Check if vehcile is already booked or not -->
            <?php
            $isBookRes = mysqli_query($isConnect, "SELECT COUNT(*) as total FROM vehicle_booking WHERE vehicle_id = " . $row['id']);
            $isBookResArr = mysqli_fetch_assoc($isBookRes);
            $bookedCount = $isBookResArr['total'];
            ?>
                <div class="w-80 mx-auto md:w-full relative">
                    <img src="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/Assets/uploads/' . $row['thumbnail_image']; ?>"
                        alt="Lamborghini" class="object-cover h-72 w-full rounded-md mb-2">
                    <div class="flex flex-row justify-between items-center">
                        <div>
                            <p class="font-light text-sm"><?php echo $row['make'] . " | " . $row['model']; ?></p>
                            <p class="font-light text-sm">From <b class="font-medium">AED
                            <?php echo floor($row['per_day_cost']) . ' / day'; ?></b></p>
                        </div>
                        <div>
                            <a target="_blank"
                                href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/Visitor/car_details.php?id=' . $row['id']; ?>"
                                class="bg-[#7B5D01] hover:bg-[#3b3112] text-white rounded-md text-sm py-2 px-3">
                                <i class="fa-solid fa-circle-info"></i>
                                View Detail
                            </a>
                        </div>
                    </div>
                    <div>
                <?php if ($bookedCount == 0) { ?>
                            <button class="absolute top-6 right-5 bg-green-600 text-white text-xs px-2 py-1 rounded-sm"><i
                                    class="fa-solid fa-circle-check"></i> Available</button>
                <?php } else { ?>
                            <button class="absolute top-6 right-5 bg-red-600 text-white text-xs px-2 py-1 rounded-sm"><i
                                    class="fa-solid fa-calendar-xmark"></i> Booked</button>
                <?php } ?>
                    </div>
                </div>
    <?php } ?>
<?php } ?>