<?php
require_once "../VisitorLayout/header.php";
?>

<!-- Banner -->
<div class="w-full h-80 md:h-180 bg-cover flex flex-col justify-center items-center text-white mb-20 md:mb-0"
    style="background-image:url('../Assets/home_banner.png')">
    <div class="md:w-4/5 mx-auto text-center">
        <h1 class="text-4xl md:text-6xl font-medium mb-2">Drive <span class="text-[#EDC549]">Dubai</span> in <span
                class="text-[#EDC549]">Style</span></h1>
        <p class="md:w-4/6 mx-auto text-base md:text-2xl font-medium">Rent luxury, exotic, and sports cars from the #1
            premium car rental service in
            Dubai.</p>
    </div>
</div>

<div class="container-fluid text-center mt-20 mb-10">
    <h3 class="text-3xl md:text-5xl font-light">Why Choose <span class="text-[#7B5D01] font-medium">Us?</span></h3>
    <p class="text-md md:text-2xl font-light">Why Rent With Us?</p>
</div>

<div class="w-full flex flex-col md:flex-row justify-around items-center">
    <div class="w-75 md:w-1/6 text-center">
        <img src="../Assets/premium.png" alt="premium_fleet" class="mx-auto h-20">
        <h4 class="font-medium text-md">Premium Fleet</h4>
        <p class="font-light text-sm">Choose from Lamborghini, Rolls-Royce, Ferrari, and more.</p>
    </div>
    
     <div class="w-75 md:w-1/6 text-center">
        <img src="../Assets/pickup_delivery.png" alt="pickup_delivery" class="mx-auto h-20">
        <h4 class="font-medium text-md">Free Pickup & Delivery</h4>
        <p class="font-light text-sm">Get your car delivered to your hotel, airport, or location.</p>
    </div>

     <div class="w-75 md:w-1/6 text-center">
        <img src="../Assets/support.png" alt="support" class="mx-auto h-20">
        <h4 class="font-medium text-md">24/7 Support</h4>
        <p class="font-light text-sm">Our concierge service is available around the clock.</p>
    </div>

     <div class="w-75 md:w-1/6 text-center">
        <img src="../Assets/insured.png" alt="insured" class="mx-auto h-20">
        <h4 class="font-medium text-md">Fully Insured</h4>
        <p class="font-light text-sm">Comprehensive coverage for peace of mind.</p>
    </div>
</div>

<div class="container-fluid text-center mt-20 mb-10">
    <h3 class="text-3xl md:text-5xl font-light">Our <span class="text-[#7B5D01] font-medium">Featured Cars</span></h3>
    <p class="text-md md:text-2xl font-light">Featured Luxury Cars</p>
</div>

<div class="w-full flex flex-col md:flex-row justify-around items-center space-y-15 md:space-y-0">
    <div class="w-80 md:w-1/4">
        <img src="../Assets/Lamborghini.png" alt="Lamborghini" class="mx-auto mb-3">
        <div class="flex flex-row justify-between items-center">
            <p class="font-light text-sm">From <b class="font-medium">AED 2,500 / day</b></p>
            <button class="bg-[#7B5D01] text-white rounded-full text-sm py-1.5 px-4">View Detail</button>
        </div>
    </div>
    
     <div class="w-80 md:w-1/4">
        <img src="../Assets/Rolls_Royce.png" alt="Rolls_Royce" class="mx-auto mb-3">
        <div class="flex flex-row justify-between items-center">
            <p class="font-light text-sm">From <b class="font-medium">AED 2,500 / day</b></p>
            <button class="bg-[#7B5D01] text-white rounded-full text-sm py-1.5 px-4">View Detail</button>
        </div>
    </div>

     <div class="w-80 md:w-1/4">
        <img src="../Assets/Ferrari.png" alt="Ferrari" class="mx-auto mb-3">
        <div class="flex flex-row justify-between items-center">
            <p class="font-light text-sm">From <b class="font-medium">AED 2,500 / day</b></p>
            <button class="bg-[#7B5D01] text-white rounded-full text-sm py-1.5 px-4">View Detail</button>
        </div>
    </div>
</div>
<?php
require_once "../VisitorLayout/footer.php";
?>