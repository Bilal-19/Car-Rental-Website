<?php
include("../AdminLayout/header.php");
include("../AdminLayout/sidebar.php");

require_once "../DB/db_connection.php";

$listVehiclesQry = "SELECT * FROM vehicles LIMIT 10";
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

        <!-- Table responsive won't work if you remove 'whitespace-nowrap' class -->
        <div class="overflow-x-auto relative">
            <table class="w-full">
                <thead class="text-xs md:text-sm text-left whitespace-nowrap">
                    <tr class="border-b-2 border-gray-900">
                        <th class="p-3">ID</th>
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
                    while ($row = mysqli_fetch_assoc($listVehiclesRes)) { ?>
                        <!-- echo "<pre>"; -->
                        <!-- print_r($row); -->
                        <tr class="border-b border-gray-600 hover:bg-gray-300">
                            <td class="p-2 border-x"><?php echo $row['id'] ?></td>
                            <td class="p-2 border-x"><?php echo $row['make']; ?></td>
                            <td class="p-2 border-x"><?php echo $row['model']; ?></td>
                            <td class="p-2 border-x"><?php echo $row['category']; ?></td>
                            <td class="p-2 border-x"><?php echo $row['transmission']; ?></td>
                            <td class="p-2 border-x"><?php echo $row['engine_capacity'] . " CC"; ?></td>
                            <td class="p-2 border-x"><?php echo floor($row['per_day_cost']) . " AED / day"; ?></td>
                            <td class="p-2 border-x text-center">
                                <a href="<?php echo $row['id']; ?>"><i class="fa-regular fa-pen-to-square text-blue-600"></i></a>
                                &nbsp;&nbsp;
                                <a href="<?php echo $row['id']; ?>"><i class="fa-solid fa-trash-arrow-up text-red-600"></i></a>
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