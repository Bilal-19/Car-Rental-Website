<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>
        <?php
        echo isset($titleTag) ? $titleTag : "Default Title"
        ?>
    </title>
    <style>
        body {
            font-family: "Inter", sans-serif;
            background-color: #BFBFBF;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div
        class="w-full bg-[#121212] text-white py-2 flex flex-col md:flex-row justify-between md:items-center border-b-2 border-b-[#EDC549]">
        <div class="flex flex-row justify-between items-center">
            <div>
                <img src="../Assets/logo.png" alt="logo" class="h-12 ml-3">
            </div>
            <div>
                <button class="block md:hidden border border-2 border-[#EDC549] rounded-md px-3 py-1 hover:cursor-pointer mr-3" id="toggleBtn">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
        <div class="hidden flex-col md:flex md:flex-row space-y-1 md:space-y-0 md:space-x-8 md:mr-5 text-sm md:text-base font-light px-4"
            id="toggleMenus">
            <a href="../Visitor/index.php" class="hover:text-[#EDC549] block md:inline">Home</a>
            <a href="../Visitor/car_listing.php" class="hover:text-[#EDC549] block md:inline">Car Listing</a>
            <a href="../Visitor/about_us.php" class="hover:text-[#EDC549] block md:inline">About Us</a>
            <a href="" class="hover:text-[#EDC549] block md:inline">Contact Us</a>
            <a href="" class="bg-[#7B5D01] text-white rounded-3xl px-5 py-1 block">Sign Up</a>
        </div>
    </div>