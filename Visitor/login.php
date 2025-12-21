<?php
$titleTag = "Elite Auto Motors | Login";
require_once "../VisitorLayout/header.php";
?>

<?php
// Store users data on backend

function validateInput($value)
{
    // Remove whitespace
    $trimVal = trim($value);
    // Remove oblique character
    $removeSlash = stripslashes($trimVal);
    // Remove tag
    $removeMarkup = htmlspecialchars($removeSlash);
    $result = $removeMarkup;
    return $result;
}

function showNotification($type, $msg)
{
    if ($type == "success") {
        return "<p class='text-green-500 bg-white px-3 py-5 rounded-md text-md w-80 md:w-4/5 mx-auto block'>
        <i class='fa-solid fa-circle-check'></i>
        $msg</p>";
    } else {
        return "<p class='text-red-500 bg-white px-3 py-5 rounded-md text-md w-80 md:w-4/5 mx-auto block'>
        <i class='fa-solid fa-circle-exclamation'></i>
        $msg</p>";
    }
}

// 1. Establish DB Connection
require_once "../DB/db_connection.php";


// 2. Get Form Values
if ($isConnect && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = $_POST["full_name"];
    $email_address = $_POST["email_address"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];

    // 3. Error Handling
    // Create an array named 'error' to store all the error message
    if (empty($user_name)) {
        $error['nameErr'] = "Please enter your full name";
    } else {
        $user_name = validateInput($user_name);
        // pattern matching
        $isPatternMatch = preg_match("/^[a-zA-Z-' ]*$/", $user_name);
        if (!$isPatternMatch) {
            $error['nameErr'] = "Only letters and whiespace allowed";
        }
    }

    if (empty($email_address)) {
        $error['emailErr'] = "Please enter email address";
    } else {
        $email_address = validateInput($email_address);
    }

    if (empty($phone)) {
        $error['phoneErr'] = "Please enter contact number";
    } else {
        $phone = validateInput($phone);
    }

    if (empty($password)) {
        $error['pswdErr'] = "Please set your password";
    } else {
        $password = validateInput($password);
    }


    // Start changes from this line
    if (empty($error)) {
        // 4. Insert Query
        $insertQuery = "INSERT INTO general_enquiry(full_name, email_address,phone,message_subject,user_message) VALUES('$user_name', '$email_address', '$phone','$subject','$message')";
        $result = mysqli_query($isConnect, $insertQuery);
        if ($result) {
            $notifyVisitor = showNotification("success", "Enquiry submitted.");
        }
    } else {
        $notifyVisitor = showNotification("error", "Please fill all the requried fields");
    }
}

?>

<!-- Contact Form -->
<div class="w-full h-200 md:h-152 bg-cover flex flex-col justify-center items-center text-white py-100 bg-no-repeat bg-scroll"
    style="background-image:url('../Assets/auth_bg.png')">
    <h4 class="text-2xl md:text-[40px] mb-2 text-center font-light">Create Your Luxury Drive Account With <span class="font-semibold">Us</span></h4>
    <div class="w-80 md:w-4/5 mx-auto md:mb-5">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="post" class="space-y-5">
            <div>
                <input type="text"
                    class="bg-white text-black px-3 md:px-6 py-3 rounded-2xl focus:outline-none block w-80 md:w-4/5 mx-auto"
                    name="full_name" placeholder="Full Name">
                <span class="text-sm font-medium w-80 md:w-4/5 mx-auto block">
                    <?php if (!empty($error["nameErr"])) {
                        echo $error["nameErr"];
                    } ?>
                </span>
            </div>

            <div>
                <input type="email"
                    class="bg-white text-black px-3 md:px-6 py-3 rounded-2xl focus:outline-none block w-80 md:w-4/5 mx-auto"
                    name="email_address" placeholder="Email Address">
                <span class="text-sm font-medium w-80 md:w-4/5 mx-auto block">
                    <?php if (!empty($error["emailErr"])) {
                        echo $error["emailErr"];
                    } ?>
                </span>
            </div>

            <div>
                <input type="number"
                    class="bg-white text-black px-3 md:px-6 py-3 rounded-2xl focus:outline-none block w-80 md:w-4/5 mx-auto"
                    name="phone" placeholder="Phone / Whatsapp">
                <span class="text-sm font-medium w-80 md:w-4/5 mx-auto block">
                    <?php if (!empty($error["phoneErr"])) {
                        echo $error["phoneErr"];
                    } ?>
                </span>
            </div>

            <div>
                <input type="password"
                    class="bg-white text-black px-3 md:px-6 py-3 rounded-2xl focus:outline-none block w-80 md:w-4/5 mx-auto"
                    name="password" placeholder="Password">
                <span class="text-sm font-medium w-80 md:w-4/5 mx-auto block">
                    <?php if (!empty($error["pswdErr"])) {
                        echo $error["pswdErr"];
                    } ?>
                </span>
            </div>

            <div>
                <button
                    class="block bg-[#513E04] text-white rounded-2xl px-3 md:px-6 py-3 w-80 md:w-4/5 mx-auto block my-5">
                    Create Account
                </button>
            </div>

            <div>
                <?php
                if (isset($notifyVisitor)) {
                    echo $notifyVisitor;
                }
                ?>
            </div>
        </form>
    </div>
</div>


<div class="mt-30 mb-10 w-full flex flex-col md:flex-row justify-around items-start space-y-10 md:space-y-0">
    <div class="w-75 md:w-1/5 text-center mx-auto">
        <img src="../Assets/location.png" alt="location" class="mx-auto h-15">
        <h4 class="font-medium text-md">Showroom Address</h4>
        <p class="font-light text-sm">Luxury Drive Rentals, Shop 4, Marina Walk, Dubai Marina, Dubai, UAE</p>
    </div>

    <div class="w-75 md:w-1/5 text-center mx-auto">
        <img src="../Assets/Phone.png" alt="Phone" class="mx-auto h-15">
        <h4 class="font-medium text-md">Phone Number</h4>
        <p class="font-light text-sm">+971-50-1234567</p>
    </div>

    <div class="w-75 md:w-1/5 text-center mx-auto">
        <img src="../Assets/online_support.png" alt="online_support" class="mx-auto h-15">
        <h4 class="font-medium text-md">Email Address</h4>
        <p class="font-light text-sm">support@eliteautomotors.com</p>
    </div>

    <div class="w-75 md:w-1/5 text-center mx-auto">
        <img src="../Assets/work_hours.png" alt="insured" class="mx-auto h-15">
        <h4 class="font-medium text-md">Working Hours</h4>
        <p class="font-light text-sm">Monday - Sunday | 24/7</p>
    </div>
</div>



<!-- Footer -->
<?php
require_once "../VisitorLayout/footer.php";
?>