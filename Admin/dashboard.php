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


// Find total registered users
$totalUserRes = mysqli_query($isConnect, "SELECT count(*) as total FROM users");
$totalUserResCount = mysqli_fetch_assoc($totalUserRes);


// Find total no of enquiries received
$genEnqRes = mysqli_query($isConnect, "SELECT count(*) as total FROM general_enquiry");
$genEnqResCount = mysqli_fetch_assoc($genEnqRes);

// Find monthly booking stats
$monthlyBookQry = "SELECT
                   DATE_FORMAT(pickup_date, '%b %Y') AS booking_month_year,
                   COUNT(*) AS total_booking
                   FROM vehicle_booking
                   GROUP BY MONTH(pickup_date), YEAR(pickup_date)";
$monthBookRes = mysqli_query($isConnect, $monthlyBookQry);

$month_book_x = array();
$month_book_y = array();

while ($row = mysqli_fetch_assoc($monthBookRes)) {
    $month_book_x[] = $row['booking_month_year'];
    $month_book_y[] = $row['total_booking'];
}

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
                    <i class="fa-solid fa-users text-green-700"></i> <?php echo $totalUserResCount['total']; ?>
                </p>
            </div>

            <div class="bg-gray-200 rounded-md p-5 text-center border-x-1 border-b-4 border-gray-900">
                <h3 class="font-medium text-lg">Total Enquiries</h3>
                <p class="md:text-md">
                    <i class="fa-solid fa-question text-red-700"></i> <?php echo $genEnqResCount['total']; ?>
                </p>
            </div>
        </div>

        <h2 class="text-xl font-semibold my-10">Monthy Booking Graph</h2>

        <div class="w-full md:w-1/2 border-2 border-gray-100 shadow-md hover:shadow-xl p-5 rounded-md">
            <canvas id="monthly-booking-chart"></canvas>
        </div>
    </div>
</main>
</div>

<?php include("../AdminLayout/footer.php"); ?>


<script>
    const xVal = <?php echo json_encode($month_book_x); ?>;
    const yVal = <?php echo json_encode($month_book_y, JSON_NUMERIC_CHECK); ?>

    new Chart("monthly-booking-chart", {
        type: "bar",
        data: {
            labels: xVal,
            datasets: [{
                data: yVal,
                backgroundColor: 'rgba(75, 85, 99, 0.15)',
                borderColor: 'rgba(75, 85, 99, 1)',
                borderWidth: 1.5,

                borderRadius: 6,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>