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
<div class="w-full h-200 md:h-fit bg-cover flex flex-col justify-center items-center text-white mt-30 py-10 bg-no-repeat bg-scroll"
    style="background-image:url('../Assets/contact_form_bg.png')">
    <h4 class="text-2xl md:text-[45px] font-semibold mb-2 text-center">Contact Us</h4>
    <div class="w-80 md:w-4/5 mx-auto md:mb-5">
        <form class="space-y-5" id="enquiry_form">
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
                <input type="text"
                    class="bg-white text-black px-3 md:px-6 py-3 rounded-2xl focus:outline-none block w-80 md:w-4/5 mx-auto"
                    name="subject" placeholder="Subject">
                <span class="text-sm font-medium w-80 md:w-4/5 mx-auto block">
                    <?php if (!empty($error["subjErr"])) {
                        echo $error["subjErr"];
                    } ?>
                </span>
            </div>

            <div>
                <textarea
                    class="bg-white text-black px-3 md:px-6 py-3 rounded-2xl focus:outline-none block w-80 md:w-4/5 mx-auto"
                    name="message" rows="5" placeholder="Message"></textarea>
                <span class="text-sm font-medium w-80 md:w-4/5 mx-auto block">
                    <?php if (!empty($error["msgErr"])) {
                        echo $error["msgErr"];
                    } ?>
                </span>
            </div>

            <div>
                <button
                    class="block bg-[#513E04] text-white rounded-2xl px-3 md:px-6 py-3 w-80 md:w-4/5 mx-auto block my-5">
                    Send Message
                </button>
            </div>

            <div id="enquiry_msg">
            </div>
        </form>
    </div>
</div>



<!-- Footer -->
<?php
require_once "../VisitorLayout/footer.php";
?>


<script>
    $(document).ready(function () {
        $("#enquiry_form").submit(function (e) {
            e.preventDefault() //prevent page reload

            // Get form input Values
            var formData = $("#enquiry_form").serialize() + "&submit_mode=submit_enquiry"; //passing all the data at once

            $.ajax({
                url: "process_ajax.php",
                type: "POST",
                dataType: "json", //response type
                data: formData,

                success: function (res) {
                    
                    console.log(res)

                    if (res.query_result == 1) {
                        $("#enquiry_msg").html("<p class='w-80 md:w-4/5 mx-auto bg-green-500 p-2 rounded-md'><i class='fa-solid fa-circle-check'></i> " + res.query_msg + "</p>").slideDown()
                        $("#enquiry_msg").trigger("reset") // reset form fields
                    } else {
                        $("#enquiry_msg").html("<p class='w-80 md:w-4/5 mx-auto bg-yellow-500 p-2 rounded-md'><i class='fa-solid fa-triangle-exclamation'></i> " + res.query_msg + "</p>").slideDown()
                    }
                }
            })
        })
    })

</script>