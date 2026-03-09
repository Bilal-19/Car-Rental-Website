<?php
$titleTag = "Elite Auto Motors | Car Listing";
require_once "../VisitorLayout/header.php";
require_once "../DB/db_connection.php";

// Fetch vehicles listing
$allVehiclesQry = "SELECT * FROM vehicles";


// Filter form
$conditionFilters = [];
if (isset($_GET['isSubmbitted']) && ($_GET['isSubmbitted'] == 'Yes')) {
    // echo "do something"; die();
    $vehicleBrand = $_GET['brand_model'] ?? null;
    $vehicleRent = $_GET['price_range'] ?? null;
    $vehicleType = $_GET['car_type'] ?? null;

    // echo $vehicleBrand . "<br>" . $vehicleRent . "<br>" . $vehicleType;
    // die();
    if (!empty($vehicleBrand)) {
        $conditionFilters[] = "make = '$vehicleBrand'";
    }

    if (!empty($vehicleType)) {
        $conditionFilters[] = "category = '$vehicleType'";
    }

    if (!empty($conditionFilters)) {
        $allVehiclesQry .= " WHERE " . implode(" OR ", $conditionFilters);
    }
    if (!empty($vehicleRent)) {
        if ($vehicleRent == "asc_order") {
            $allVehiclesQry .= " ORDER BY per_day_cost ASC";
        } else {
            $allVehiclesQry .= " ORDER BY per_day_cost DESC";
        }
    }
}

// echo $allVehiclesQry;

$allVehiclesRes = mysqli_query($isConnect, $allVehiclesQry);
$countRows = mysqli_num_rows($allVehiclesRes);
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
    <form action="" class="w-80 md:w-4/5 mx-auto flex flex-col md:flex-row justify-around items-center space-x-3"
        name="filterForm" method="Get">
        <input type="hidden" name="isSubmbitted" value="Yes">
        <div
            class="w-80 md:w-4/5 mx-auto bg-white px-2 py-2 rounded-xl my-10 md:space-x-3 font-extralight flex flex-col md:flex-row justify-around md:mr-5">
            <input type="text" placeholder="Search by brand/model" class="focus:outline-none focus:border-b-1"
                name="brand_model" value="<?php if (!empty($vehicleBrand))
                    echo $vehicleBrand; ?>">
            <span class="hidden md:visible">|</span>
            <select name="price_range" id="" class="focus:outline-none">
                <option value="" selected>Price Range</option>
                <option value="asc_order" <?php echo (isset($_GET['price_range']) && $_GET['price_range'] == 'asc_order' ) ? 'selected' : '' ?>>Low to High</option>
                <option value="desc_order" <?php echo (isset($_GET['price_range']) && $_GET['price_range'] == 'desc_order') ? 'selected' : '' ?> >High to Low</option>
            </select>
            <span class="hidden md:visible">|</span>
            <select name="car_type" id="" class="focus:outline-none">
                <option value="">Car Type</option>
                <option value="Luxury">Luxury</option>
                <option value="SUV">SUV</option>
                <option value="Convertible">Convertible</option>
                <option value="Sports">Sports</option>
                <option value="Executive">Executive</option>
            </select>
        </div>

        <div class="flex flex-row space-x-5">
            <button class="bg-[#7B5D01] text-white px-10 py-2 rounded-xl flex items-center gap-2"><i class="fas fa-search"></i>Search</button>
            <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/Visitor/car_listing.php'; ?>" class="bg-[#01377b] text-white px-5 py-2 rounded-xl flex items-center gap-2"><i class="fas fa-times"></i> Reset</a>
        </div>

    </form>
</div>

<div class="container-fluid text-center mt-20 mb-10">
    <h3 class="text-3xl md:text-5xl font-light">Our <span class="text-[#7B5D01] font-medium">Featured Cars</span></h3>
    <p class="text-md md:text-2xl font-light">Featured Luxury Cars</p>
</div>

<div class="w-full grid grid-cols-1 md:grid-cols-3 gap-5 space-y-5 md:space-y-0 mb-20 md:mb-100">
    <?php
    while ($row = mysqli_fetch_assoc($allVehiclesRes)) { ?>
        <div class="relative">
            <img src="../Assets/Lamborghini.png" alt="Lamborghini" class="mx-auto mb-3">
            <p class="font-medium text-sm ml-12 md:ml-6"><?php echo $row['make'] . " . " . $row['model']; ?></p>
            <p class="font-light text-sm ml-12 md:ml-6">From <b
                    class="font-medium"><?php echo "AED " . $row['per_day_cost'] . "/ day"; ?></b></p>
            <a class="bg-[#000000] text-white rounded-full text-sm py-1.5 px-4 absolute right-15 md:right-10 bottom-15"
                target="_blank"
                href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/Visitor/car_details.php?id=' . $row['id']; ?>">
                View Detail</a>
        </div>
    <?php } ?>
</div>

<div class="mt-30 w-full h-52 md:h-132 text-white flex flex-col justify-center text-start p-10 bg-cover"
    style="background-image:url('../Assets/car_listing_cta.png')">
    <h3 class="text-xl md:text-4xl mb-1">Can't Find What You're Looking For?</h3>
    <p class="text-base md:text-2xl font-light mb-4">
        Get in touch with our team for exclusive models and custom bookings.
    </p>
    <button class="bg-[#7B5D01] w-fit px-3 py-3 rounded-xl">Contact Us</button>
</div>

<!-- Footer -->
<?php
require_once "../VisitorLayout/footer.php";
?>