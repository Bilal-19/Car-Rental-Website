<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Elite Auto Motors</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            font-family: "Open Sans", sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Montserrat", sans-serif;
        }
    </style>

    <!-- jQuery reference -->
    <script src="https://code.jquery.com/jquery-4.0.0.min.js"
        integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous">
        </script>

    <!-- Add Char JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0"></script>
</head>

<body class="bg-gray-100 min-h-dvh h-full flex flex-col">

    <!-- Login Form -->
  <div class="w-full h-200 md:h-screen bg-cover flex flex-col justify-center items-center text-white py-100 bg-no-repeat bg-scroll"
    style="background-image:url('../Assets/auth_bg.png')">
    <h4 class="text-2xl md:text-[40px] mb-5 text-center font-light">Create <span class="font-bold">Administrator</span> Account</h4>
    <div class="w-80 md:w-4/5 mx-auto md:mb-5">
        <form class="space-y-5" id="signup_form">
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
                <button id="create_account"
                    class="bg-[#513E04] hover:bg-[#3b3112] hover:cursor-pointer text-white rounded-2xl px-3 md:px-6 py-3 w-80 md:w-4/5 mx-auto block my-5">
                    <i class="fa-solid fa-user-plus"></i> Create Account
                </button>
            </div>

            <div id="create_account_msg">
            </div>


            <div>
                <p class="py-3 w-80 md:w-4/5 mx-auto block my-5">
                    Have an account? <a href="<?php echo "http://" . $_SERVER['HTTP_HOST'] . '/Admin/login.php'; ?>" class="text-[#EDC549] underline">Sign In</a>
                </p>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#signup_form").submit(function (e) {
            e.preventDefault() //prevent page reload

            // Get form input Values
            var formData = $("#signup_form").serialize() + "&submit_mode=create_account"; //passing all the data at once

            $.ajax({
                url: "admin_process_ajax.php",
                type: "POST",
                dataType: "json", //response type
                data: formData,

                success: function (res) {
                    console.log(res)

                    if (res.query_result == 1) {
                        $("#create_account_msg").html("<p class='w-80 md:w-4/5 mx-auto bg-green-500 p-2 rounded-md'><i class='fa-solid fa-circle-check'></i> " + res.query_msg + "</p>").slideDown()
                        $("#signup_form").trigger("reset") // reset form fields
                    } else {
                        $("#create_account_msg").html("<p class='w-80 md:w-4/5 mx-auto bg-yellow-500 p-2 rounded-md'><i class='fa-solid fa-triangle-exclamation'></i> " + res.query_msg + "</p>").slideDown()
                    }

                }
            })
        })
    })

</script>

<script>
    const sidebar = document.getElementById('sidebar');
    const menuBtn = document.getElementById('menu-btn');

    menuBtn.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
    });
</script>
</body>

</html>