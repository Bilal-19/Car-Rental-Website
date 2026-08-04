<style>
    label,
    input,
    select {
        font-size: 14px;
    }
</style>

<?php
require_once '../DB/db_connection.php';

include("../AdminLayout/header.php");
include("../AdminLayout/sidebar.php");

$vehicle_id = $_GET['id'];
if (isset($vehicle_id)) {
    $fetchVehicleQry = "SELECT * FROM vehicles WHERE id = $vehicle_id";
    $fetchVehicleRes = mysqli_query($isConnect, $fetchVehicleQry);
    $fetchVehicleArr = mysqli_fetch_assoc($fetchVehicleRes);

    // Fetch Vehicle Images
    $fetchVehImgs = mysqli_query($isConnect, "SELECT * FROM vehicle_images WHERE enabled = 1 AND vehicle_id = $vehicle_id");
    //$fetchVehImgsRes    = mysqli_fetch_assoc($fetchVehImgs);
    // die();
}


$vehicleMakers = fetchVehicleMakers($isConnect);
$vehicleModels = fetchVehicleModels($isConnect);

// print_r($fetchVehImgsRes); die;
?>


<main class="flex-1 p-6 overflow-x-auto">
    <div class="w-full mt-5 bg-white rounded p-6">
        <h2 class="text-xl font-semibold mb-5">Edit Vehicle Information</h2>
        <h2 class="text-md font-semibold mb-5">Vehicle Details:</h2>
        <form class="text-gray-600" id="update_vehicle" name="update_vehicle" enctype="multipart/form-data">
            <!-- <input type="hidden" name="add_new_vehicle" value="Yes"> -->
            <input type="hidden" name="vehicle_id" value="<?php echo $fetchVehicleArr['id']; ?>">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="flex flex-col">
                    <label for="car_maker" class="font-medium">Make:</label>
                    <select name="car_maker" id="car_maker"
                        class="required p-2.5 text-sm text-gray-600 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200 appearance-none">
                        <option value="">Select Maker</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($vehicleMakers)) {
                            $x = getVehicleMaker($fetchVehicleArr['make'], $isConnect);
                            ?>
                            <option value="<?php echo $row['id']; ?>" <?php echo ($x == $row['brand_name']) ? 'selected' : '' ?>>
                                <?php echo $row['brand_name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="car_model">Model:</label>
                    <select name="car_model" id="car_model"
                        class="required p-2.5 text-sm text-gray-600 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200 appearance-none">
                        <option value="">Select Model</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($vehicleModels)) {
                            $y = getVehicleModel($fetchVehicleArr['model'], $isConnect); ?>
                            <option value="<?php echo $row['id']; ?>" <?php echo ($y == $row['model_name']) ? 'selected' : '' ?>>
                                <?php echo $row['model_name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="car_engine">Engine Capacity:</label>
                    <input type="text" name="car_engine" id="car_engine"
                        value="<?php echo ($fetchVehicleArr['engine_capacity']); ?>" placeholder="4000+ cc"
                        class="required p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <label for="car_category">Category:</label>
                    <select name="car_category" id="car_category"
                        class="required p-2.5 text-sm text-gray-600 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200 appearance-none">
                        <option value="">Select Category</option>
                        <option <?php echo ($fetchVehicleArr['category'] == 'Sedan' ? 'selected' : '') ?> value="Sedan">
                            Sedan</option>
                        <option <?php echo ($fetchVehicleArr['category'] == 'SUV' ? 'selected' : '') ?> value="SUV">SUV
                        </option>
                        <option <?php echo ($fetchVehicleArr['category'] == 'Hatchback' ? 'selected' : '') ?>
                            value="Hatchback">Hatchback</option>
                        <option <?php echo ($fetchVehicleArr['category'] == 'Luxury' ? 'selected' : '') ?> value="Luxury">
                            Luxury</option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="car_transmission">Transmission:</label>
                    <select name="car_transmission" id="car_transmission"
                        class="required p-2.5 text-sm text-gray-600 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200 appearance-none">
                        <option value="">Select Transmission</option>
                        <option <?php echo ($fetchVehicleArr['transmission'] == 'Automatic Transmission (AT)' ? 'selected' : '') ?> value="Automatic Transmission (AT)">Automatic Transmission (AT)</option>
                        <option <?php echo ($fetchVehicleArr['transmission'] == 'Manual Transmission (MT)' ? 'selected' : '') ?> value="Manual Transmission (MT)">Manual Transmission (MT)</option>
                        <option <?php echo ($fetchVehicleArr['transmission'] == 'Automated Manual Transmission (AM)' ? 'selected' : '') ?> value="Automated Manual Transmission (AM)">Automated Manual Transmission
                            (AM)</option>
                        <option <?php echo ($fetchVehicleArr['transmission'] == 'Continuously Variable Transmission (CVT)' ? 'selected' : '') ?> value="Continuously Variable Transmission (CVT)">Continuously Variable
                            Transmission
                            (CVT)</option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="car_trim">Trim:</label>
                    <input type="text" name="car_trim" id="car_trim" value="<?php echo ($fetchVehicleArr['TRIM']); ?>"
                        placeholder="G 63 AMG"
                        class="required p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <label for="car_hp">Horsepower:</label>
                    <input type="text" name="car_hp" value="<?php echo ($fetchVehicleArr['horsepower']); ?>" id="car_hp"
                        placeholder="500 - 599 HP"
                        class="required p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <label for="car_doors">Doors:</label>
                    <input type="text" name="car_doors" value="<?php echo ($fetchVehicleArr['doors']); ?>"
                        id="car_doors" placeholder="4 door"
                        class="required p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <label for="car_fuel_type">Fuel Type:</label>
                    <select name="car_fuel_type" id="car_fuel_type"
                        class="required p-2.5 text-sm text-gray-600 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200 appearance-none">
                        <option value="">Select Fuel Type</option>
                        <option <?php echo ($fetchVehicleArr['fuel_type'] == 'Petrol' ? 'selected' : '') ?>
                            value="Petrol">Petrol</option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="car_cylinders">No of Cylinders:</label>
                    <input type="text" name="car_cylinders" value="<?php echo ($fetchVehicleArr['no_of_cylinders']); ?>"
                        id="car_cylinders" placeholder="8"
                        class="required p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <label for="interior_color">Interior Color:</label>
                    <input type="text" name="interior_color" value="<?php echo ($fetchVehicleArr['interior_color']); ?>"
                        id="interior_color" placeholder="Red"
                        class="required p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <label for="exterior_color">Exterior Color:</label>
                    <input type="text" name="exterior_color" value="<?php echo ($fetchVehicleArr['exterior_color']); ?>"
                        id="exterior_color" placeholder="Silver"
                        class="required p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <label for="car_drive_type">Drive Type:</label>
                    <select name="car_drive_type" id="car_drive_type"
                        class="required p-2.5 text-sm text-gray-600 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200 appearance-none">
                        <option value="">Select Drive Type</option>
                        <option <?php echo ($fetchVehicleArr['drive_type'] == 'AWD' ? 'selected' : '') ?> value="AWD">AWD
                        </option>
                        <option <?php echo ($fetchVehicleArr['drive_type'] == 'RWD' ? 'selected' : '') ?> value="RWD">RWD
                        </option>
                        <option <?php echo ($fetchVehicleArr['drive_type'] == 'FWD' ? 'selected' : '') ?> value="FWD">FWD
                        </option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="seating_capacity">Seating Capacity:</label>
                    <input type="text" name="seating_capacity"
                        value="<?php echo ($fetchVehicleArr['seating_capacity']); ?>" id="seating_capacity"
                        placeholder="2"
                        class="required p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <label for="per_day_cost">Per Day Cost:</label>
                    <input type="text" name="per_day_cost"
                        value="<?php echo floor($fetchVehicleArr['per_day_cost']); ?>" id="per_day_cost"
                        placeholder="250 AED"
                        class="required p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <label for="registration_number">Registration Number:</label>
                    <input type="text" name="registration_number"
                        value="<?php echo ($fetchVehicleArr['registration_number']); ?>" id="registration_number"
                        placeholder="PK-753"
                        class="required p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <!--
                <div class="flex flex-col md:col-span-2">
                    <label for="multiple_files">Upload multiple
                        files</label>
                    <input class="required p-1.5 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200 file:mr-5 file:py-1 file:px-3 file:border-[1px]
                        file:text-xs file:font-medium file:bg-stone-50 file:text-stone-700
                        hover:file:cursor-pointer hover:file:bg-blue-50
                        hover:file:text-blue-700" name="vehicle_imgs[]" id="vehicle_imgs" id="multiple_files"
                        type="file" multiple>
                </div>
                -->

                <div class="flex flex-col col-span-1 md:col-span-4">
                    <button type="submit" name="submit" id="submit"
                        class="p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-[#7b5d01] text-white"><i
                            class="fa fa-paper-plane"> </i> Save Details</button>
                </div>

                <div class="flex flex-col col-span-1 md:col-span-4">
                    <div id="form_msg">
                    </div>
                </div>


            </div>
        </form>

    </div>


    <div class="w-full mt-5 bg-white rounded p-6">
        <form class="text-gray-600" id="update_thumbnail_img" name="update_thumbnail_img" enctype="multipart/form-data">
            <input type="hidden" name="vehicle_id" value="<?php echo $fetchVehicleArr['id']; ?>">
            <h2 class="text-md font-semibold mb-5">Thumbnail:</h2>
            <div class="w-full flex flex-col md:flex-row md:items-center space-y-5 md:space-y-0 md:space-x-5 mb-5">
                <div class="w-3/4 md:w-1/2">
                    <label for="preview_img" class="mb-2">Current Thumbnail: </label>
                    <img src="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/Assets/uploads/' . $fetchVehicleArr['thumbnail_image'] ?>"
                        alt="img" class="rounded-md w-full h-64 object-cover shadow-md">
                </div>


                <div class="w-3/4 md:w-1/2 md:space-y-4">
                    <label for="preview_img" class="font-bold">Select New Thumbnail:</label>
                    <input type="file" name="preview_img" id="preview_img" class="block p-1.5 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200 file:mr-5 file:py-1 file:px-3 file:border-[1px] file:text-xs file:font-medium file:bg-stone-50 file:text-stone-700
                    hover:file:cursor-pointer hover:file:bg-blue-50 hover:file:text-blue-700">
                    <span class="text-xs">Accepted: JPG, JPEG, PNG | Maximum size: 2 MB</span>
                </div>
            </div>

            <button type="submit" name="submit" id="submit"
                class="w-full p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-[#7b5d01] text-white"><i
                    class="fa fa-replace"> </i> Replace Thumbnail</button>

            <div class="flex flex-col col-span-1 md:col-span-4 mt-5">
                <div id="form_msg_thumbnail">
                </div>
            </div>
        </form>
    </div>


    <!-- Vehicle Multiple Images -->
    <div class="w-full mt-5 bg-white rounded p-6">
        <form class="text-gray-600" id="update_thumbnail_img" name="update_thumbnail_img" enctype="multipart/form-data">
            <input type="hidden" name="vehicle_id" id="vehicle_id" value="<?php echo $fetchVehicleArr['id']; ?>">
            <h2 class="text-md font-semibold mb-5">Gallery Images:</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <!-- Loop through the vehcile images -->
                <?php
                while ($row = mysqli_fetch_assoc($fetchVehImgs)) { ?>
                    <div>
                        <div class="relative">
                            <img src="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/Assets/uploads/' . $row['image_path']; ?>"
                                alt="img" class="rounded-md w-full h-64 object-cover shadow-md">
                            <button data-vehicle-img-id="<?php echo $row['id']; ?>"
                                class="del_veh_img absolute top-3 right-2 text-white bg-red-500 px-2 py-1 text-xs rounded-sm"><i
                                    class="fa-solid fa-trash"></i> Delete</button>
                        </div>
                    </div>
                <?php }
                ?>
            </div>



            <div class="w-full my-4">
                <label for="preview_img" class="font-bold">Add New Images:</label>
                <input type="file" name="preview_img" id="preview_img" class="w-80 block p-1.5 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200 file:mr-5 file:py-1 file:px-3 file:border-[1px] file:text-xs file:font-medium file:bg-stone-50 file:text-stone-700
                    hover:file:cursor-pointer hover:file:bg-blue-50 hover:file:text-blue-700">
                <span class="text-xs">Accepted: JPG, JPEG, PNG | Maximum size: 2 MB</span>
            </div>

            <button type="submit" name="submit" id="submit"
                class="w-full p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-[#7b5d01] text-white"><i
                    class="fa fa-save"> </i> Upload Images</button>

            <div class="flex flex-col col-span-1 md:col-span-4 mt-5">
                <div id="form_msg_del_img">
                </div>
            </div>
        </form>
    </div>
</main>
</div>

<?php include("../AdminLayout/footer.php"); ?>

<script>
    $(document).ready(function () {
        // Add vehicle form submission
        // serialize() does not include file inputs
        // processData: false (send data as it is, do not convert it into query string)
        // contentType: false (Let the browser automatically set the correct Content-Type (multipart/form-data with boundary))
        $("#update_vehicle").submit(function (e) {
            //prevent default form submission behavior    
            e.preventDefault()

            let isValid = true;

            $(".required").each(function () {
                if ($(this).val().trim() == "") {
                    $(this).css({ 'border': '1px solid red' })
                    isValid = false;
                } else {
                    $(this).css({ 'border': '' })
                }
            })


            // Remove the border on typing
            $(".required").on("input change", function () {
                if ($(this).val().trim() != "") {
                    $(this).css({ 'border': '2px solid green' })
                }
            })
            if (!isValid) {
                $("#form_msg").html("<p class='w-80 md:w-full mx-auto bg-red-500 text-white p-2 rounded-md'><i class='fa-solid fa-triangle-exclamation'></i> Please fill all required fields</p>").slideDown()
                return;
            } else {

                var form_data = new FormData(document.getElementById("update_vehicle"))
                form_data.append("submit_mode", "update_vehicle")

                $.ajax({
                    url: "admin_process_ajax.php",
                    data: form_data,
                    type: "POST",
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        console.log("AJAX Response : ", res.query_result);
                        if (res.query_result == 1) {
                            $("#form_msg").html("<p class='w-80 md:w-full mx-auto bg-green-500 text-white p-2 rounded-md'><i class='fa-solid fa-circle-check'></i> " + res.query_msg + "</p>").slideDown()
                            setTimeout(function () {
                                location.reload()
                            }, 2000)
                        } else {
                            $("#form_msg").html("<p class='w-80 md:w-full mx-auto bg-yellow-500 text-white p-2 rounded-md'><i class='fa-solid fa-triangle-exclamation'></i> " + res.query_msg + "</p>").slideDown()
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log("Error: ", xhr.responseText)
                    }
                })
            }
        })

        // Update thumbnail image
        $("#update_thumbnail_img").submit(function (e) {
            e.preventDefault()

            var form_data = new FormData(document.getElementById("update_thumbnail_img"))
            form_data.append("submit_mode", "update_thumbnail_img")

            $.ajax({
                url: "admin_process_ajax.php",
                data: form_data,
                type: "POST",
                dataType: "json",
                contentType: false,
                processData: false,
                success: function (res) {
                    console.log("AJAX Response : ", res.query_result);
                    if (res.query_result == 1) {
                        $("#form_msg_thumbnail").html("<p class='w-80 md:w-full mx-auto bg-green-500 text-white p-2 rounded-md'><i class='fa-solid fa-circle-check'></i> " + res.query_msg + "</p>").slideDown()
                        setTimeout(function () {
                            location.reload()
                        }, 2000)
                    } else if (res.query_result == 0) {
                        $("#form_msg_thumbnail").html("<p class='w-80 md:w-full mx-auto bg-red-500 text-white p-2 rounded-md'><i class='fa-solid fa-triangle-exclamation'></i> " + res.query_msg + "</p>").slideDown()
                    }
                },
                error: function (xhr, status, error) {
                    console.log("Error: ", xhr.responseText)
                }
            })
        })

        //Delete vehicle image
        $(document).on("click", ".del_veh_img", function (e) {
            e.preventDefault();

            var vehicle_image_id = $(this).data("vehicle-img-id");
            var vehicle_id = $("#vehicle_id").val();

            $.ajax({
                url: 'admin_process_ajax.php',
                type: 'POST',
                dataType: "json",
                // contentType: false,
                // processData: false,
                data: {
                    vehicle_id: vehicle_id,
                    vehicle_image_id: vehicle_image_id,
                    submit_mode: 'del_vehicle_img'
                }, 
                success: function (res) {
                    console.log("AJAX Response : ", res.query_result);
                    if (res.query_result == 1) {
                        $("#form_msg_del_img").html("<p class='w-80 md:w-full mx-auto bg-green-500 text-white p-2 rounded-md'><i class='fa-solid fa-circle-check'></i> " + res.query_msg + "</p>").slideDown()
                        setTimeout(function () {
                            location.reload()
                        }, 2000)
                    } else if (res.query_result == 0) {
                        $("#form_msg_del_img").html("<p class='w-80 md:w-full mx-auto bg-red-500 text-white p-2 rounded-md'><i class='fa-solid fa-triangle-exclamation'></i> " + res.query_msg + "</p>").slideDown()
                    }
                },
            })
        })
    })

</script>