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
    <title>Home</title>
    <style>
        body {
            font-family: "Inter", sans-serif;
            background-color: #BFBFBF;
        }
    </style>
</head>

<!-- Header -->
<div
    class="w-full bg-[#121212] text-white py-2 flex flex-col md:flex-row justify-between md:items-center border-b-2 border-b-[#EDC549]">
    <div class="flex flex-row justify-between">
        <div>
            <img src="../Assets/logo.png" alt="logo" class="h-12">
        </div>
        <div>
            <a href="" class="block md:hidden">
                <i class="fa-solid fa-bars"></i>
            </a>
        </div>
    </div>
    <div class="md:space-x-8 md:mr-5 text-sm md:text-base font-light flex flex-col md:flex-row space-y-1 md:space-y-0 ml-3 md:ml-0">
        <a href="" class="hover:text-[#EDC549]">Home</a>
        <a href="" class="hover:text-[#EDC549]">Car Listing</a>
        <a href="" class="hover:text-[#EDC549]">About Us</a>
        <a href="" class="hover:text-[#EDC549]">Contact Us</a>
        <a href="" class="bg-[#7B5D01] text-white rounded-3xl px-5 py-1">Sign Up</a>
    </div>
</div>

<body>