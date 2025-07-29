<?php
$titleTag = "Elite Auto Motors | Car Listing";
require_once "../VisitorLayout/header.php";
?>

<div class="w-full h-80 md:h-180 bg-cover flex flex-col justify-center items-center text-white mb-20 md:mb-0"
    style="background-image:url('../Assets/car_listing_banner.png')">
    <div class="md:w-4/5 mx-auto text-center">
        <h1 class="text-4xl md:text-6xl font-medium mb-2">Explore Our <span class="text-[#EDC549]">Premium Fleet</span>
        </h1>
        <p class="md:w-4/6 mx-auto text-base md:text-2xl font-medium">
            Choose from a handpicked selection of high-end luxury cars, exotic sports models, and executive sedans — all
            available for rent across Dubai with doorstep delivery.
        </p>
    </div>
</div>

<div class="w-full">
<form action="" class="w-80 md:w-4/5 mx-auto flex flex-col md:flex-row justify-around items-center">
    <div class="w-80 md:w-4/5 mx-auto bg-white px-5 py-2 rounded-xl my-10 md:space-x-5 font-extralight flex flex-row justify-around">
        <input type="text" placeholder="Search by brand/model" class="focus:outline-none">
        <input type="text" onfocus="this.type='date'" placeholder="Availability" class="focus:outline-none">
        <select name="" id="" class="focus:outline-none">
            <option value="" selected>Price Range</option>
            <option value="">AED 500 - AED 1000</option>
            <option value="">AED 1000 - AED 2000</option>
            <option value="">AED 2000 - AED 3000</option>
        </select>
        <select name="" id="" class="focus:outline-none">
            <option value="">Car Type</option>
            <option value="Luxury">Luxury</option>
            <option value="SUV">SUV</option>
            <option value="Convertible">Convertible</option>
            <option value="Sports">Sports</option>
            <option value="Executive">Executive</option>
        </select>
    </div>

    <div>
        <button class="bg-[#7B5D01] text-white px-10 py-2 rounded-xl">Search</button>
    </div>
</form>
</div>