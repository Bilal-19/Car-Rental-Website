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
        <div
            class="w-80 md:w-4/5 mx-auto bg-white px-5 py-2 rounded-xl my-10 md:space-x-5 font-extralight flex flex-col md:flex-row justify-around">
            <input type="text" placeholder="Search by brand/model" class="focus:outline-none focus:border-b-1">
            <input type="text" onfocus="this.type='date'" placeholder="Availability"
                class="focus:outline-none focus:border-b-1">
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

<div class="container-fluid text-center mt-20 mb-10">
    <h3 class="text-3xl md:text-5xl font-light">Our <span class="text-[#7B5D01] font-medium">Featured Cars</span></h3>
    <p class="text-md md:text-2xl font-light">Featured Luxury Cars</p>
</div>

<div class="w-full grid grid-cols-1 md:grid-cols-3 gap-5 space-y-5 md:space-y-0 mb-20 md:mb-100">
    <div class="relative">
        <img src="../Assets/Lamborghini.png" alt="Lamborghini" class="mx-auto mb-3">
        <p class="font-medium text-sm ml-12 md:ml-6">Lamborghini Huracán EVO</p>
        <p class="font-light text-sm ml-12 md:ml-6">From <b class="font-medium">AED 2,500 / day</b></p>
        <button
            class="bg-[#000000] text-white rounded-full text-sm py-1.5 px-4 absolute right-15 md:right-10 bottom-15">View
            Detail</button>
    </div>

    <div class="relative">
        <img src="../Assets/Lamborghini.png" alt="Lamborghini" class="mx-auto mb-3">
        <p class="font-medium text-sm ml-12 md:ml-6">Lamborghini Huracán EVO</p>
        <p class="font-light text-sm ml-12 md:ml-6">From <b class="font-medium">AED 2,500 / day</b></p>
        <button
            class="bg-[#000000] text-white rounded-full text-sm py-1.5 px-4 absolute right-15 md:right-10 bottom-15">View
            Detail</button>
    </div>

    <div class="relative">
        <img src="../Assets/Lamborghini.png" alt="Lamborghini" class="mx-auto mb-3">
        <p class="font-medium text-sm ml-12 md:ml-6">Lamborghini Huracán EVO</p>
        <p class="font-light text-sm ml-12 md:ml-6">From <b class="font-medium">AED 2,500 / day</b></p>
        <button
            class="bg-[#000000] text-white rounded-full text-sm py-1.5 px-4 absolute right-15 md:right-10 bottom-15">View
            Detail</button>
    </div>

    <div class="relative">
        <img src="../Assets/Lamborghini.png" alt="Lamborghini" class="mx-auto mb-3">
        <p class="font-medium text-sm ml-12 md:ml-6">Lamborghini Huracán EVO</p>
        <p class="font-light text-sm ml-12 md:ml-6">From <b class="font-medium">AED 2,500 / day</b></p>
        <button
            class="bg-[#000000] text-white rounded-full text-sm py-1.5 px-4 absolute right-15 md:right-10 bottom-15">View
            Detail</button>
    </div>

    <div class="relative">
        <img src="../Assets/Lamborghini.png" alt="Lamborghini" class="mx-auto mb-3">
        <p class="font-medium text-sm ml-12 md:ml-6">Lamborghini Huracán EVO</p>
        <p class="font-light text-sm ml-12 md:ml-6">From <b class="font-medium">AED 2,500 / day</b></p>
        <button
            class="bg-[#000000] text-white rounded-full text-sm py-1.5 px-4 absolute right-15 md:right-10 bottom-15">View
            Detail</button>
    </div>

    <div class="relative">
        <img src="../Assets/Lamborghini.png" alt="Lamborghini" class="mx-auto mb-3">
        <p class="font-medium text-sm ml-12 md:ml-6">Lamborghini Huracán EVO</p>
        <p class="font-light text-sm ml-12 md:ml-6">From <b class="font-medium">AED 2,500 / day</b></p>
        <button
            class="bg-[#000000] text-white rounded-full text-sm py-1.5 px-4 absolute right-15 md:right-10 bottom-15">View
            Detail</button>
    </div>

    <div class="relative">
        <img src="../Assets/Lamborghini.png" alt="Lamborghini" class="mx-auto mb-3">
        <p class="font-medium text-sm ml-12 md:ml-6">Lamborghini Huracán EVO</p>
        <p class="font-light text-sm ml-12 md:ml-6">From <b class="font-medium">AED 2,500 / day</b></p>
        <button
            class="bg-[#000000] text-white rounded-full text-sm py-1.5 px-4 absolute right-15 md:right-10 bottom-15">View
            Detail</button>
    </div>

    <div class="relative">
        <img src="../Assets/Lamborghini.png" alt="Lamborghini" class="mx-auto mb-3">
        <p class="font-medium text-sm ml-12 md:ml-6">Lamborghini Huracán EVO</p>
        <p class="font-light text-sm ml-12 md:ml-6">From <b class="font-medium">AED 2,500 / day</b></p>
        <button
            class="bg-[#000000] text-white rounded-full text-sm py-1.5 px-4 absolute right-15 md:right-10 bottom-15">View
            Detail</button>
    </div>

    <div class="relative">
        <img src="../Assets/Lamborghini.png" alt="Lamborghini" class="mx-auto mb-3">
        <p class="font-medium text-sm ml-12 md:ml-6">Lamborghini Huracán EVO</p>
        <p class="font-light text-sm ml-12 md:ml-6">From <b class="font-medium">AED 2,500 / day</b></p>
        <button
            class="bg-[#000000] text-white rounded-full text-sm py-1.5 px-4 absolute right-15 md:right-10 bottom-15">View
            Detail</button>
    </div>

    <div class="relative">
        <img src="../Assets/Lamborghini.png" alt="Lamborghini" class="mx-auto mb-3">
        <p class="font-medium text-sm ml-12 md:ml-6">Lamborghini Huracán EVO</p>
        <p class="font-light text-sm ml-12 md:ml-6">From <b class="font-medium">AED 2,500 / day</b></p>
        <button
            class="bg-[#000000] text-white rounded-full text-sm py-1.5 px-4 absolute right-15 md:right-10 bottom-15">View
            Detail</button>
    </div>

    <div class="relative">
        <img src="../Assets/Lamborghini.png" alt="Lamborghini" class="mx-auto mb-3">
        <p class="font-medium text-sm ml-12 md:ml-6">Lamborghini Huracán EVO</p>
        <p class="font-light text-sm ml-12 md:ml-6">From <b class="font-medium">AED 2,500 / day</b></p>
        <button
            class="bg-[#000000] text-white rounded-full text-sm py-1.5 px-4 absolute right-15 md:right-10 bottom-15">View
            Detail</button>
    </div>

    <div class="relative">
        <img src="../Assets/Lamborghini.png" alt="Lamborghini" class="mx-auto mb-3">
        <p class="font-medium text-sm ml-12 md:ml-6">Lamborghini Huracán EVO</p>
        <p class="font-light text-sm ml-12 md:ml-6">From <b class="font-medium">AED 2,500 / day</b></p>
        <button
            class="bg-[#000000] text-white rounded-full text-sm py-1.5 px-4 absolute right-15 md:right-10 bottom-15">View
            Detail</button>
    </div>

    <div class="relative">
        <img src="../Assets/Lamborghini.png" alt="Lamborghini" class="mx-auto mb-3">
        <p class="font-medium text-sm ml-12 md:ml-6">Lamborghini Huracán EVO</p>
        <p class="font-light text-sm ml-12 md:ml-6">From <b class="font-medium">AED 2,500 / day</b></p>
        <button
            class="bg-[#000000] text-white rounded-full text-sm py-1.5 px-4 absolute right-15 md:right-10 bottom-15">View
            Detail</button>
    </div>

    <div class="relative">
        <img src="../Assets/Lamborghini.png" alt="Lamborghini" class="mx-auto mb-3">
        <p class="font-medium text-sm ml-12 md:ml-6">Lamborghini Huracán EVO</p>
        <p class="font-light text-sm ml-12 md:ml-6">From <b class="font-medium">AED 2,500 / day</b></p>
        <button
            class="bg-[#000000] text-white rounded-full text-sm py-1.5 px-4 absolute right-15 md:right-10 bottom-15">View
            Detail</button>
    </div>

    <div class="relative">
        <img src="../Assets/Lamborghini.png" alt="Lamborghini" class="mx-auto mb-3">
        <p class="font-medium text-sm ml-12 md:ml-6">Lamborghini Huracán EVO</p>
        <p class="font-light text-sm ml-12 md:ml-6">From <b class="font-medium">AED 2,500 / day</b></p>
        <button
            class="bg-[#000000] text-white rounded-full text-sm py-1.5 px-4 absolute right-15 md:right-10 bottom-15">View
            Detail</button>
    </div>
</div>

<div class="mt-30 w-full h-52 md:h-132 text-white flex flex-col justify-center text-start p-10"
    style="background-image:url('../Assets/car_listing_cta.png')">
    <h3 class="text-xl md:text-4xl mb-1">Can’t Find What You’re Looking For?</h3>
    <p class="text-base md:text-2xl font-light mb-4">
        Get in touch with our team for exclusive models and custom bookings.
    </p>
    <button class="bg-[#7B5D01] w-fit px-3 py-3 rounded-xl">Contact Us</button>
</div>

<!-- Footer -->
<?php
require_once "../VisitorLayout/footer.php";
?>