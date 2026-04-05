<?php
include("../AdminLayout/header.php");
include("../AdminLayout/sidebar.php");

require_once "../DB/db_connection.php";
require_once "../utilities.php";

$bookVehiclesQry = "SELECT
                    c.full_name,
                    c.phone,
                    b.make,
                    b.model,
                    b.registration_number,
                    b.thumbnail_image,
                    a.pickup_date,
                    a.return_date,
                    DATEDIFF(a.return_date, a.pickup_date) as 'no_of_days',
                    a.need_driver,
                    a.additional_notes,
                    a.created_at as 'booking_datetime'
                    FROM
                    vehicle_booking a
                    INNER JOIN vehicles b ON
                    a.vehicle_id = b.id
                    INNER JOIN users c ON
                    a.user_id = c.id
                    LIMIT 10
                    ";
$bookVehiclesRes = mysqli_query($isConnect, $bookVehiclesQry);

?>
<main class="flex-1 p-6 overflow-x-auto">
    <div class="w-full mt-5 bg-white rounded p-6">
        <h2 class="text-xl font-semibold">Booked Vehicles</h2>
        <p class="text-xs md:text-sm mb-5"><?php echo $bookVehiclesRes->num_rows; ?> records found</p>

        <div id="notification" class="text-sm my-3"></div>
        <!-- Table responsive won't work if you remove 'whitespace-nowrap' class -->
        <div class="overflow-x-auto relative my-3">
            <table class="w-full">
                <thead class="text-xs md:text-sm text-left whitespace-nowrap bg-gray-300">
                    <tr class="border-b-2 border-gray-900 text-center">
                        <th class="p-3" rowspan="2">#</th>
                        <th class="p-3" colspan="2">Customer</th>
                        <th class="p-3" colspan="3">Vehicle</th>
                        <th class="p-3" colspan="3">Dates</th>
                        <th class="p-3" rowspan="2">Driver?</th>
                        <th class="p-3" rowspan="2">Notes</th>
                        <th class="p-3" rowspan="2">Days</th>
                    </tr>
                    <tr>
                        <th class="p-3">Name</th>
                        <th class="p-3">Phone</th>
                        <th class="p-3">Make</th>
                        <th class="p-3">Model</th>
                        <th class="p-3">Reg #</th>
                        <th class="p-3">Pickup</th>
                        <th class="p-3">Return</th>
                        <th class="p-3">Booked</th>
                    </tr>
                </thead>

                <tbody class="text-xs whitespace-nowrap">
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($bookVehiclesRes)) {
                        // echo "<pre>";
                        // print_r($row);
                        ?>
                        <tr class="border-b border-gray-600 hover:bg-gray-200">
                            <td class="p-2 border-x"><?php echo $i++; ?></td>
                            <td class="p-2 border-x"><?php echo $row['full_name']; ?></td>
                            <td class="p-2 border-x"><?php echo $row['phone']; ?></td>
                            <td class="p-2 border-x"><?php echo $row['make']; ?></td>
                            <td class="p-2 border-x"><?php echo $row['model']; ?></td>
                            <td class="p-2 border-x"><?php echo $row['registration_number']; ?></td>
                            <td class="p-2 border-x"><?php echo displayDate($row['pickup_date']); ?></td>
                            <td class="p-2 border-x"><?php echo displayDate($row['return_date']); ?></td>
                            <td class="p-2 border-x"><?php echo displayDate($row['booking_datetime']); ?></td>
                            <td class="p-2 border-x"><?php echo $row['need_driver']; ?></td>
                            <td class="p-2 border-x"><?php echo $row['additional_notes']; ?></td>
                            <td class="p-2 border-x"><?php echo $row['no_of_days']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</main>
</div>

<?php include("../AdminLayout/footer.php"); ?>

<script>
    $(document).ready(function () {
        $('.del_vehicle').on('click', function () {
            var id = $(this).val();
            // alert(id);

            $.ajax({
                url: 'admin_process_ajax.php',
                dataType: "json",
                data: { 'vehicle_id': id, 'submit_mode': 'delete_vehicle' },
                success: function (data) {
                    console.log("AJAX Response: " + data.query_result)
                    if (data.query_result == 1) {
                        $("#notification").slideDown('slow')
                        $("#notification").html(`<p class='w-80 md:w-full mx-auto bg-green-500 text-white p-2 rounded-md'><i class='fa-solid fa-circle-check'></i> ` + data.query_msg + '</p>')
                        $("#notification").delay(2000).slideUp('slow', function () {
                            location.reload()
                        })
                    } else {
                        $("#notification").html(`<p class='w-80 md:w-full mx-auto bg-yellow-500 text-white p-2 rounded-md'><i class='fa-solid fa-triangle-exclamation'></i> ` + data.query_msg + '</p>')
                    }
                }
            })
        })
    })
</script>