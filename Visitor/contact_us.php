<?php
$titleTag = "Elite Auto Motors | Contact Us";
require_once "../VisitorLayout/header.php";
?>

<!-- Banner -->
<div class="w-full h-80 md:h-180 bg-cover flex flex-col justify-center items-center text-white mb-20 md:mb-0"
    style="background-image:url('../Assets/contact_banner.png')">
    <div class="md:w-4/5 mx-auto text-center">
        <h1 class="text-3xl md:text-6xl font-medium mb-2">Let’s Get You on the <span class="text-[#EDC549]">Road</span>
            in <span class="text-[#EDC549]">Style</span></h1>
        <p class="md:w-4/6 mx-auto text-base md:text-2xl font-medium">
            Need help booking your dream car? Have a special request or corporate inquiry? We’re here 24/7 to assist
            you.
        </p>
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


<!-- Contact Form -->
<div class="w-full md:h-fit bg-cover flex flex-col justify-center items-center text-white mt-30 py-10 bg-no-repeat bg-scroll"
    style="background-image:url('../Assets/contact_form_bg.png')">
    <div class="md:w-4/5 mx-auto text-center md:my-60">
        <h4 class="text-2xl md:text-[45px] font-semibold mb-2">Contact Us</h4>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" class="space-y-5" method="post">
            <input type="text"
                class="bg-white text-black px-3 md:px-6 py-3 rounded-2xl w-80 md:w-3/5 focus:outline-none"
                name="full_name" placeholder="Full Name">

            <input type="email"
                class="bg-white text-black px-3 md:px-6 py-3 rounded-2xl w-80 md:w-3/5 focus:outline-none"
                name="email_address" placeholder="Email Address">

            <input type="number"
                class="bg-white text-black px-3 md:px-6 py-3 rounded-2xl w-80 md:w-3/5 focus:outline-none" name="phone"
                placeholder="Phone / Whatsapp">

            <input type="text"
                class="bg-white text-black px-3 md:px-6 py-3 rounded-2xl w-80 md:w-3/5 focus:outline-none"
                name="subject" placeholder="Subject">

            <textarea class="bg-white text-black px-3 md:px-6 py-3 rounded-2xl w-80 md:w-3/5 focus:outline-none"
                name="message" rows="5" placeholder="Message"></textarea>

            <button class="bg-[#513E04] text-white rounded-2xl px-3 md:px-6 py-3 w-80 md:w-3/5">Send Message</button>
        </form>
    </div>
</div>

<?php
// Store contact us form values on backend


// 1. Establish DB Connection
require_once "../DB/db_connection.php";

// 2. Get Form Values
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // echo "User click on form submit button";
    $user_name = $_POST["full_name"];
    $email_address = $_POST["email_address"];
    $phone = $_POST["phone"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    echo "username: $user_name" . "<br>";
    echo "email: $email_address" . "<br>";
    echo "phone number: $phone" . "<br>";
    echo "message subject: $subject" . "<br>";
    echo "message: $message" . "<br>";

    // 3. Error Handling
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
}





// 4. Insert Query


// 5. Show success/error notification
?>

<!-- Footer -->
<?php
require_once "../VisitorLayout/footer.php";
?>