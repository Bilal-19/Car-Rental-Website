<?php
$titleTag = "Elite Auto Motors | Login";
require_once "../VisitorLayout/header.php";
?>

<!-- Contact Form -->
<div class="w-full h-200 md:h-152 bg-cover flex flex-col justify-center items-center text-white py-100 bg-no-repeat bg-scroll"
    style="background-image:url('../Assets/auth_bg.png')">
    <h4 class="text-2xl md:text-[40px] mb-5 text-center font-semibold">Welcome Back</h4>
    <div class="w-80 md:w-4/5 mx-auto md:mb-5">
        <form class="space-y-5" id="login_form">
            
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
                <button id="create_account"
                    class="bg-[#513E04] cursor-pointer text-white rounded-2xl px-3 md:px-6 py-3 w-80 md:w-4/5 mx-auto block my-5">
                    Login
                </button>
            </div>

            <div id="create_account_msg">
            </div>


            <div>
                <p class="w-80 md:w-4/5 mx-auto block my-5">
                    Don't have an account? <a href="<?php echo "http://" . $_SERVER['HTTP_HOST'] . '/Visitor/signup.php'; ?>" class="text-[#EDC549] underline">Sign Up</a>
                </p>
            </div>
        </form>
    </div>
</div>


<div class="my-30 w-full flex flex-col md:flex-row justify-around items-start space-y-10 md:space-y-0">
    <div class="w-75 md:w-1/5 text-center mx-auto">
        <img src="<?php echo $path . '/Assets/location.png' ?>" alt="location" class="mx-auto h-15">
        <h4 class="font-medium text-md">Showroom Address</h4>
        <p class="font-light text-sm">Luxury Drive Rentals, Shop 4, Marina Walk, Dubai Marina, Dubai, UAE</p>
    </div>

    <div class="w-75 md:w-1/5 text-center mx-auto">
        <img src="<?php echo $path . '/Assets/Phone.png' ?>" alt="Phone" class="mx-auto h-15">
        <h4 class="font-medium text-md">Phone Number</h4>
        <p class="font-light text-sm">+971-50-1234567</p>
    </div>

    <div class="w-75 md:w-1/5 text-center mx-auto">
        <img src="<?php echo $path . '/Assets/online_support.png' ?>" alt="online_support" class="mx-auto h-15">
        <h4 class="font-medium text-md">Email Address</h4>
        <p class="font-light text-sm">support@eliteautomotors.com</p>
    </div>

    <div class="w-75 md:w-1/5 text-center mx-auto">
        <img src="<?php echo $path . '/Assets/work_hours.png' ?>" alt="insured" class="mx-auto h-15">
        <h4 class="font-medium text-md">Working Hours</h4>
        <p class="font-light text-sm">Monday - Sunday | 24/7</p>
    </div>
</div>



<!-- Footer -->
<?php
require_once "../VisitorLayout/footer.php";
?>

<script>
    $(document).ready(function () {
        $("#login_form").submit(function (e) {
            e.preventDefault() //prevent page reload

            // Get form input Values
            var formData = $("#login_form").serialize() + "&submit_mode=login"; //passing all the data at once

            $.ajax({
                url: "process_ajax.php",
                type: "POST",
                dataType: "json", //response type
                data: formData,

                success: function (res) {
                    
                    console.log(res)

                    if (res.query_result == 1) {
                        $("#create_account_msg").html("<p class='w-80 md:w-4/5 mx-auto bg-green-500 p-2 rounded-md'><i class='fa-solid fa-circle-check'></i> " + res.query_msg + "</p>").slideDown()
                        window.location.href = '../index.php';
                        // $("#login_form").trigger("reset") // reset form fields
                    } else {
                        $("#create_account_msg").html("<p class='w-80 md:w-4/5 mx-auto bg-yellow-500 p-2 rounded-md'><i class='fa-solid fa-triangle-exclamation'></i> " + res.query_msg + "</p>").slideDown()
                    }
                    

                }
            })
        })
    })

</script>