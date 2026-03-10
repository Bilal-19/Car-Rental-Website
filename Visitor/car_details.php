<?php
$titleTag = "Elite Auto Motors | Car Details";
require_once "../VisitorLayout/header.php";
require_once "../DB/db_connection.php";

// Find car information
$vehicleQry = "SELECT * FROM vehicles WHERE id = " . $_GET['id'];
$vehicleRes = mysqli_query($isConnect, $vehicleQry);
$vehicleResArr = mysqli_fetch_assoc($vehicleRes);
// print_r($vehicleResArr);
?>

<div class="w-full my-20">
    <img src="<?php echo "http://" . $_SERVER['HTTP_HOST'] . "/Assets/Ferrari.png"; ?>" alt="thumbnail"
        class="md:w-4/5 object-fit mx-auto mt-20">
    <h3 class="md:w-4/5 mx-auto my-5 text-xl md:text-4xl text-[#7B5D01] font-medium">
        <?php echo $vehicleResArr['make'] . " . " . $vehicleResArr['model']; ?>
    </h3>
    <h5 class="md:w-4/5 mx-auto my-5 text-md md:text-2xl">Vehicle <span class="text-[#7B5D01] font-medium">Overview</span></h5>
    <table class="md:w-4/5 text-left mx-auto">
        <tr class="border-b">
            <th class="py-2 font-medium">Make & Model</th>
            <td class="font-light"><?php echo $vehicleResArr['make'] . " . " . $vehicleResArr['model']; ?></td>
        </tr>

        <tr class="border-b">
            <th class="py-2 font-medium">Engine Capacity</th>
            <td class="font-light"><?php echo $vehicleResArr['engine_capacity'] . " CC"; ?></td>
        </tr>

        <tr class="border-b">
            <th class="py-2 font-medium">Category</th>
            <td class="font-light"><?php echo $vehicleResArr['category']; ?></td>
        </tr>

        <tr class="border-b">
            <th class="py-2 font-medium">Transmision</th>
            <td class="font-light"><?php echo $vehicleResArr['transmission']; ?></td>
        </tr>

        <tr class="border-b">
            <th class="py-2 font-medium">Trim</th>
            <td class="font-light"><?php echo $vehicleResArr['TRIM']; ?></td>
        </tr>

        <tr class="border-b">
            <th class="py-2 font-medium">Horsepower</th>
            <td class="font-light"><?php echo $vehicleResArr['horsepower'] . " hp"; ?></td>
        </tr>

        <tr class="border-b">
            <th class="py-2 font-medium">Doors</th>
            <td class="font-light"><?php echo $vehicleResArr['doors']; ?></td>
        </tr>

        <tr class="border-b">
            <th class="py-2 font-medium">Fuel Type</th>
            <td class="font-light"><?php echo $vehicleResArr['fuel_type']; ?></td>
        </tr>

        <tr class="border-b">
            <th class="py-2 font-medium">No of Cylinders</th>
            <td class="font-light"><?php echo $vehicleResArr['no_of_cylinders']; ?></td>
        </tr>

        <tr class="border-b">
            <th class="py-2 font-medium">Interior Color</th>
            <td class="font-light"><?php echo $vehicleResArr['interior_color']; ?></td>
        </tr>

        <tr class="border-b">
            <th class="py-2 font-medium">Exterior Color</th>
            <td class="font-light"><?php echo $vehicleResArr['exterior_color']; ?></td>
        </tr>

        <tr class="border-b">
            <th class="py-2 font-medium">Per Day Cost</th>
            <td class="font-light"><?php echo floor($vehicleResArr['per_day_cost']) . " AED / day"; ?></td>
        </tr>

        <tr class="border-b">
            <th class="py-2 font-medium">Drive Type</th>
            <td class="font-light"><?php echo $vehicleResArr['drive_type']; ?></td>
        </tr>

        <tr class="border-b">
            <th class="py-2 font-medium">Seating Capacity</th>
            <td class="font-light"><?php echo $vehicleResArr['seating_capacity']; ?></td>
        </tr>

        <tr class="border-b">
            <th class="py-2 font-medium">Registration Number</th>
            <td class="font-light"><?php echo $vehicleResArr['registration_number']; ?></td>
        </tr>
    </table>
</div>

<?php
require_once "../VisitorLayout/footer.php";
?>