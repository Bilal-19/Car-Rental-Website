<?php
$titleTag = "Elite Auto Motors | Car Details";
require_once "../VisitorLayout/header.php";
require_once "../DB/db_connection.php";

$vehicleID = $_GET['id'];

// Find car information
$vehicleQry = "SELECT * FROM vehicles WHERE id = " . $vehicleID;
$vehicleRes = mysqli_query($isConnect, $vehicleQry);
$vehicleResArr = mysqli_fetch_assoc($vehicleRes);
// print_r($vehicleResArr);

$availableLoc = array('Business Bay', 'Sheikh Zayed Road');

?>

<div class="w-full my-20">
    <img src="<?php echo "http://" . $_SERVER['HTTP_HOST'] . "/Assets/Ferrari.png"; ?>" alt="thumbnail"
        class="md:w-4/5 object-fit mx-auto mt-20">
    <h3 class="md:w-4/5 mx-auto my-5 text-xl md:text-4xl text-[#7B5D01] font-medium">
        <?php echo $vehicleResArr['make'] . " . " . $vehicleResArr['model']; ?>
    </h3>
    <h5 class="md:w-4/5 mx-auto my-5 text-md md:text-2xl">Vehicle <span
            class="text-[#7B5D01] font-medium">Overview</span></h5>
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

<div class="w-full h-200 md:h-fit bg-cover flex flex-col justify-center items-center text-white mt-30 py-10 bg-no-repeat bg-scroll"
    style="background-image:url('../Assets/contact_form_bg.png')">
    <h4 class="text-2xl md:text-[45px] font-semibold mb-2 text-center">Book This Car Now</h4>
    <div class="w-80 md:w-4/5 mx-auto md:mb-5">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) . '?id=' . $vehicleID; ?>" name="bookVehicle" id="bookVehicle" method="post" class="space-y-5">
        <input type="hidden" name="vehicle_id" value="<?php echo $vehicleID; ?>">    
        <div>
                <input type="text"
                    class="bg-white text-black px-3 md:px-6 py-3 rounded-2xl focus:outline-none block w-80 md:w-4/5 mx-auto"
                    name="pickup_date" placeholder="Select Pickup Date" onfocus="(this.type)='date'">
                <span class="text-sm font-medium w-80 md:w-4/5 mx-auto block">
                    <?php if (!empty($error["nameErr"])) {
                        echo $error["nameErr"];
                    } ?>
                </span>
            </div>

            <div>
                <input type="text"
                    class="bg-white text-black px-3 md:px-6 py-3 rounded-2xl focus:outline-none block w-80 md:w-4/5 mx-auto"
                    name="return_date" placeholder="Select Return Date" onfocus="(this.type)='date'">
                <span class="text-sm font-medium w-80 md:w-4/5 mx-auto block">
                    <?php if (!empty($error["emailErr"])) {
                        echo $error["emailErr"];
                    } ?>
                </span>
            </div>

            <div>
                <select
                    class="bg-white text-black px-3 md:px-6 py-3 rounded-2xl focus:outline-none block w-80 md:w-4/5 mx-auto appearance-none"
                    name="pickup_location">
                    <option value="">Select Pickup Location</option>
                    <?php
                    foreach ($availableLoc as $val) { ?>
                        <option value="<?php echo $val; ?>"><?php echo $val; ?></option>
                    <?php }
                    ?>
                </select>
                <span class="text-sm font-medium w-80 md:w-4/5 mx-auto block">
                    <?php if (!empty($error["phoneErr"])) {
                        echo $error["phoneErr"];
                    } ?>
                </span>
            </div>

            <div>
                <select
                    class="bg-white text-black px-3 md:px-6 py-3 rounded-2xl focus:outline-none block w-80 md:w-4/5 mx-auto appearance-none"
                    name="is_driver_needed">
                    <option value="">Need a Driver?</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
                <span class="text-sm font-medium w-80 md:w-4/5 mx-auto block">
                    <?php if (!empty($error["phoneErr"])) {
                        echo $error["phoneErr"];
                    } ?>
                </span>
            </div>

            <div>
                <textarea
                    class="bg-white text-black px-3 md:px-6 py-3 rounded-2xl focus:outline-none block w-80 md:w-4/5 mx-auto"
                    name="additional_notes" rows="5" placeholder="Additional Notes"></textarea>
                <span class="text-sm font-medium w-80 md:w-4/5 mx-auto block">
                    <?php if (!empty($error["msgErr"])) {
                        echo $error["msgErr"];
                    } ?>
                </span>
            </div>

            <div>
                <button
                    class="block bg-[#513E04] text-white rounded-2xl px-3 md:px-6 py-3 w-80 md:w-4/5 mx-auto block my-5">
                    Confirm Booking
                </button>
            </div>

            <div>
                <?php
                if (isset($notifyVisitor)) {
                    echo $notifyVisitor;
                }
                ?>
            </div>
        </form>
    </div>
</div>

<?php
require_once "../VisitorLayout/footer.php";
?>