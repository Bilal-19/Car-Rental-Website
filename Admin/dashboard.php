<?php
include("../AdminLayout/header.php");
include("../AdminLayout/sidebar.php");

require_once "../DB/db_connection.php";

// Find count of no of vehicles
$noOfVehicleRes = mysqli_query($isConnect, "SELECT count(*) as total FROM vehicles");
$noOfVehicleCount = mysqli_fetch_assoc($noOfVehicleRes);
$countVehicles = $noOfVehicleCount['total'];

// Find no of booked vehicles
$noOfBookedVehicleRes = mysqli_query($isConnect, "SELECT count(DISTINCT vehicle_id) as total FROM vehicle_booking");
$noOfBookedVehicleResCount = mysqli_fetch_assoc($noOfBookedVehicleRes);
$countBookedVehicles = $noOfBookedVehicleResCount['total'];

?>
<main class="flex-1 p-6 overflow-x-auto">
    <div class="w-full mt-5 bg-white rounded p-6">
        <h2 class="text-xl font-semibold mb-5">Admin Dashboard</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div class="bg-gray-200 rounded-md p-5 text-center border-x-1 border-b-4 border-gray-900">
                <h3 class="font-medium text-lg">Total Vehicles</h3>
                <p class="md:text-md">
                    <i class="fa-solid fa-car text-blue-700"></i> <?php echo $countVehicles; ?>
                </p>
            </div>

            <div class="bg-gray-200 rounded-md p-5 text-center border-x-1 border-b-4 border-gray-900">
                <h3 class="font-medium text-lg">Booked Vehicles</h3>
                <p class="md:text-md">
                    <i class="fas fa-car-side text-red-700"></i> <?php echo $countBookedVehicles; ?>
                </p>
            </div>

            <div class="bg-gray-200 rounded-md p-5 text-center border-x-1 border-b-4 border-gray-900">
                <h3 class="font-medium text-lg">Available Vehicles</h3>
                <p class="md:text-md">
                    <i class="fas fa-car-side text-green-700"></i> <?php echo ($countVehicles - $countBookedVehicles) ?>
                </p>
            </div>

            <div class="bg-gray-200 rounded-md p-5 text-center border-x-1 border-b-4 border-gray-900">
                <h3 class="font-medium text-lg">Total Users</h3>
                <p class="md:text-md">
                    <i class="fa-solid fa-users text-green-700"></i> 300
                </p>
            </div>

            <div class="bg-gray-200 rounded-md p-5 text-center border-x-1 border-b-4 border-gray-900">
                <h3 class="font-medium text-lg">Total Enquiries</h3>
                <p class="md:text-md">
                    <i class="fa-solid fa-question text-red-700"></i> 50
                </p>
            </div>
        </div>

    </div>
</main>
</div>

<?php include("../AdminLayout/footer.php"); ?>