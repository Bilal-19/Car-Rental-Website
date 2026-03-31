<?php
include("../AdminLayout/header.php");
include("../AdminLayout/sidebar.php");

require_once "../DB/db_connection.php";

$listVehiclesQry = "SELECT * FROM vehicles";
$listVehiclesRes = mysqli_query($isConnect, $listVehiclesQry);

?>
<main class="flex-1 p-6 overflow-x-auto">
    <div class="w-full mt-5 bg-white rounded p-6">
        <h2 class="text-xl font-semibold mb-5">All Vehicles</h2>

        <div class="flex justify-between">
            <p><?php echo $listVehiclesRes->num_rows; ?> records found</p>
            <button class="bg-blue-500 text-white text-sm px-3 py-1 rounded-md">
                <a href="./add_vehicle.php">Add New Vehicle</a>
            </button>
        </div>

        <table class="w-full mt-5">
            <thead class="text-sm text-left">
                <tr class="border-b border-gray-900">
                    <th>ID</th>
                    <th>Make / Model</th>
                    <th>Category / Transmission</th>
                    <th>Engine Capacity</th>
                    <th>Per Day Cost</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody class="text-xs">
                <?php
                while ($row = mysqli_fetch_assoc($listVehiclesRes)) { ?>
                    <!-- echo "<pre>"; -->
                    <!-- print_r($row); -->
                    <tr class="border-b border-gray-500 py-4 h-4 hover:bg-gray-300">
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['make'] . '&nbsp|&nbsp' . $row['model']; ?></td>
                        <td><?php echo $row['category'] . '<br>' . $row['transmission']; ?></td>
                        <td><?php echo $row['engine_capacity'] . " CC"; ?></td>
                        <td><?php echo floor($row['per_day_cost']) . " AED / day"; ?></td>
                        <td>
                            <a href="<?php echo $row['id']; ?>">Edit</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>


    </div>
</main>
</div>

<?php include("../AdminLayout/footer.php"); ?>