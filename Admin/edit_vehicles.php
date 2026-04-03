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

    // die();
}

?>


<main class="flex-1 p-6 overflow-x-auto">
    <div class="w-full mt-5 bg-white rounded p-6">
        <h2 class="text-xl font-semibold mb-5">Edit Vehicle Information</h2>

        <form class="text-gray-600" id="update_vehicle" name="update_vehicle" enctype="multipart/form-data">
            <!-- <input type="hidden" name="add_new_vehicle" value="Yes"> -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="flex flex-col">
                    <label for="car_maker" class="font-medium">Make:</label>
                    <select name="car_maker" id="car_maker"
                        class="required p-2.5 text-sm text-gray-600 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200 appearance-none">
                        <option value="">Select Maker</option>
                        <option <?php echo ($fetchVehicleArr['make'] == 'Mercedes-Benz' ? 'selected' : '') ?>
                            value="Mercedes-Benz">Mercedes-Benz</option>
                        <option <?php echo ($fetchVehicleArr['make'] == 'Toyota' ? 'selected' : '') ?> value="Toyota">
                            Toyota</option>
                        <option <?php echo ($fetchVehicleArr['make'] == 'BMW' ? 'selected' : '') ?> value="BMW">BMW
                        </option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="car_model">Model:</label>
                    <select name="car_model" id="car_model"
                        class="required p-2.5 text-sm text-gray-600 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200 appearance-none">
                        <option value="">Select Model</option>
                        <option value="<?php echo ($fetchVehicleArr['model']) ?>" selected>
                            <?php echo ($fetchVehicleArr['model']) ?></option>
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
                    <input type="text" name="car_trim" id="car_trim"
                        value="<?php echo ($fetchVehicleArr['TRIM']); ?>" placeholder="G 63 AMG"
                        class="required p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <label for="car_hp">Horsepower:</label>
                    <input type="text" name="car_hp" value="<?php echo ($fetchVehicleArr['horsepower']); ?>"  id="car_hp" placeholder="500 - 599 HP"
                        class="required p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <label for="car_doors">Doors:</label>
                    <input type="text" name="car_doors" value="<?php echo ($fetchVehicleArr['doors']); ?>"  id="car_doors" placeholder="4 door"
                        class="required p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <label for="car_fuel_type">Fuel Type:</label>
                    <select name="car_fuel_type" id="car_fuel_type"
                        class="required p-2.5 text-sm text-gray-600 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200 appearance-none">
                        <option value="">Select Fuel Type</option>
                        <option <?php echo ($fetchVehicleArr['fuel_type'] == 'Petrol' ? 'selected' : '') ?> value="Petrol">Petrol</option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="car_cylinders">No of Cylinders:</label>
                    <input type="text" name="car_cylinders" value="<?php echo ($fetchVehicleArr['no_of_cylinders']); ?>"  id="car_cylinders" placeholder="8"
                        class="required p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <label for="interior_color">Interior Color:</label>
                    <input type="text" name="interior_color" value="<?php echo ($fetchVehicleArr['interior_color']); ?>"  id="interior_color" placeholder="Red"
                        class="required p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <label for="exterior_color">Exterior Color:</label>
                    <input type="text" name="exterior_color" value="<?php echo ($fetchVehicleArr['exterior_color']); ?>"  id="exterior_color" placeholder="Silver"
                        class="required p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <label for="car_drive_type">Drive Type:</label>
                    <select name="car_drive_type" id="car_drive_type"
                        class="required p-2.5 text-sm text-gray-600 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200 appearance-none">
                        <option value="">Select Drive Type</option>
                        <option <?php echo ($fetchVehicleArr['drive_type'] == 'AWD' ? 'selected' : '') ?> value="AWD">AWD</option>
                        <option <?php echo ($fetchVehicleArr['drive_type'] == 'RWD' ? 'selected' : '') ?> value="RWD">RWD</option>
                        <option <?php echo ($fetchVehicleArr['drive_type'] == 'FWD' ? 'selected' : '') ?> value="FWD">FWD</option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="seating_capacity">Seating Capacity:</label>
                    <input type="text" name="seating_capacity" value="<?php echo ($fetchVehicleArr['seating_capacity']); ?>"  id="seating_capacity" placeholder="2"
                        class="required p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <label for="per_day_cost">Per Day Cost:</label>
                    <input type="text" name="per_day_cost" value="<?php echo ($fetchVehicleArr['per_day_cost']); ?>"  id="per_day_cost" placeholder="250 AED"
                        class="required p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <label for="registration_number">Registration Number:</label>
                    <input type="text" name="registration_number" value="<?php echo ($fetchVehicleArr['registration_number']); ?>"  id="registration_number" placeholder="PK-753"
                        class="required p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>


                <div class="flex flex-col md:col-span-4">
                    <label for="preview_img">Thumbnail Image:</label>
                    <input type="file" name="preview_img" id="preview_img" class="required p-1.5 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200 file:mr-5 file:py-1 file:px-3 file:border-[1px]
                        file:text-xs file:font-medium file:bg-stone-50 file:text-stone-700
                        hover:file:cursor-pointer hover:file:bg-blue-50
                        hover:file:text-blue-700">
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
                            class="fa fa-paper-plane"> </i> Update</button>
                </div>

                <div class="flex flex-col col-span-1 md:col-span-4">
                    <div id="form_msg">
                    </div>
                </div>


            </div>
        </form>

    </div>
</main>
</div>

<?php include("../AdminLayout/footer.php");
print_r($fetchVehicleArr); ?>

<script>
    $(document).ready(function () {
        $("#car_maker").on("change", function () {
            let carManufacturer = $("#car_maker").val() //first dropdown value
            let carModel = $("#car_model"); //second dropdown

            var toyotaModels = ['Fortuner', 'Yaris', 'Innova', 'Supra', 'Camry', 'Corolla', 'Raize']
            var mercedesModels = ['G-Class', 'A-Class', 'S-Class', 'E-Class', 'CLA']
            var bmwModels = ['5-Series', '7-Series', 'M3', '2-Series . 218i', 'CLA']

            carModel.html('<option>Select Model</option>')
            if (carManufacturer === "Toyota") {
                toyotaModels.forEach((val, index) => { carModel.append(`<option value=${val}>${val}</option>`); })
            } else if (carManufacturer === "Mercedes-Benz") {
                mercedesModels.forEach((val, index) => { carModel.append(`<option value=${val}>${val}</option>`); })
            } else if (carManufacturer === "BMW") {
                bmwModels.forEach((val, index) => { carModel.append(`<option value=${val}>${val}</option>`); })
            }
        });

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
                            $("#update_vehicle").trigger("reset") // reset form fields
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
    })

</script>