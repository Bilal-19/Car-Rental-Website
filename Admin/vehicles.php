<?php
include("../AdminLayout/header.php");
include("../AdminLayout/sidebar.php");

require_once "../DB/db_connection.php";

$listVehiclesQry = "SELECT * FROM vehicles WHERE enabled = 1 LIMIT 10";
$listVehiclesRes = mysqli_query($isConnect, $listVehiclesQry);

?>
<main class="flex-1 p-6 overflow-x-auto">
    <div class="w-full mt-5 bg-white rounded p-6">
        <h2 class="text-xl font-semibold mb-5">All Vehicles</h2>

        <div class="flex flex-col md:flex-row justify-between">
            <p><?php echo $listVehiclesRes->num_rows; ?> records found</p>
            <button class="bg-blue-500 text-white text-xs md:text-sm px-3 py-1 rounded-md inline-block">
                <a href="./add_vehicle.php">Add New Vehicle</a>
            </button>
        </div>

        <div id="notification" class="text-sm my-3"></div>
        <!-- Table responsive won't work if you remove 'whitespace-nowrap' class -->
        <div class="overflow-x-auto relative my-3">
            <table class="w-full">
                <thead class="text-xs md:text-sm text-left whitespace-nowrap bg-gray-300">
                    <tr class="border-b-2 border-gray-900">
                        <th class="p-3">#</th>
                        <th class="p-3">Make</th>
                        <th class="p-3">Model</th>
                        <th class="p-3">Category</th>
                        <th class="p-3">Transmission</th>
                        <th class="p-3">Engine Capacity</th>
                        <th class="p-3">Per Day Cost</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>

                <tbody class="text-xs whitespace-nowrap">
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($listVehiclesRes)) { ?>
                        <!-- echo "<pre>"; -->
                        <!-- print_r($row); -->
                        <tr class="border-b border-gray-600 hover:bg-gray-300">
                            <td class="p-2 border-x"><?php echo $i++; ?></td>
                            <td class="p-2 border-x"><?php echo $row['make']; ?></td>
                            <td class="p-2 border-x"><?php echo $row['model']; ?></td>
                            <td class="p-2 border-x"><?php echo $row['category']; ?></td>
                            <td class="p-2 border-x"><?php echo $row['transmission']; ?></td>
                            <td class="p-2 border-x"><?php echo $row['engine_capacity'] . " CC"; ?></td>
                            <td class="p-2 border-x"><?php echo floor($row['per_day_cost']) . " AED / day"; ?></td>
                            <td class="p-2 border-x text-center">
                                <a target="_blank"
                                    href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/Admin/edit_vehicles.php?id=' . $row['id']; ?>"><i
                                        class="fa-regular fa-pen-to-square text-blue-600"></i></a>
                                &nbsp;&nbsp;
                                <button class="del_vehicle" value="<?php echo $row['id']; ?>">
                                    <i class="fa-solid fa-trash-arrow-up text-red-600"></i>
                                    </buton>
                            </td>
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