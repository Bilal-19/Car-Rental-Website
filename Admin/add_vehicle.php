<style>
    label, input, select {
        font-size: 14px;
    }
</style>

<?php
include("../AdminLayout/header.php");
include("../AdminLayout/sidebar.php");
?>

<main class="flex-1 p-6 overflow-x-auto">
    <div class="w-full mt-5 bg-white rounded p-6">
        <h2 class="text-xl font-semibold mb-5">Add New Vehicle</h2>

        <form action="" class="text-gray-600">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="flex flex-col">
                    <label for="" class="font-medium">Make:</label>
                    <select name="car_maker" id="car_maker"
                        class="p-2.5 text-sm text-gray-600 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200 appearance-none">
                        <option value="">Select Maker</option>
                        <option value="Mercedes-Benz">Mercedes-Benz</option>
                        <option value="Toyota">Toyota</option>
                        <option value="BMW">BMW</option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="">Model:</label>
                    <select name="car_model" id="car_model"
                        class="p-2.5 text-sm text-gray-600 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200 appearance-none">

                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="">Engine Capacity:</label>
                    <input type="text" name="car_engine" id="car_engine" placeholder="4000+ cc"
                        class="p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <label for="">Category:</label>
                    <select name="car_category" id="car_category"
                        class="p-2.5 text-sm text-gray-600 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200 appearance-none">
                        <option value="">Select Category</option>
                        <option value="Sedan">Sedan</option>
                        <option value="SUV">SUV</option>
                        <option value="Hatchback">Hatchback</option>
                        <option value="Luxury">Luxury</option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="">Transmission:</label>
                    <select name="car_transmission" id="car_transmission"
                        class="p-2.5 text-sm text-gray-600 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200 appearance-none">
                        <option value="">Select Transmission</option>
                        <option value="Automatic Transmission (AT)">Automatic Transmission (AT)</option>
                        <option value="Manual Transmission (MT)">Manual Transmission (MT)</option>
                        <option value="Automated Manual Transmission (AM)">Automated Manual Transmission (AM)</option>
                        <option value="Continuously Variable Transmission (CVT)">Continuously Variable Transmission
                            (CVT)</option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="">Trim:</label>
                    <input type="text" name="car_trim" id="car_trim" placeholder="G 63 AMG"
                        class="p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <label for="">Horsepower:</label>
                    <input type="text" name="car_hp" id="car_hp" placeholder="500 - 599 HP"
                        class="p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <label for="">Doors:</label>
                    <input type="text" name="car_doors" id="car_doors" placeholder="4 door"
                        class="p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <label for="">Fuel Type:</label>
                    <select name="car_fuel_type" id="car_fuel_type"
                        class="p-2.5 text-sm text-gray-600 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200 appearance-none">
                        <option value="">Select Fuel Type</option>
                        <option value="Petrol">Petrol</option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="">No of Cylinders:</label>
                    <input type="text" name="car_cylinders" id="car_cylinders" placeholder="8"
                        class="p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <label for="">Interior Color:</label>
                    <input type="text" name="interior_color" id="interior_color" placeholder="Red"
                        class="p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <label for="">Exterior Color:</label>
                    <input type="text" name="exterior_color" id="exterior_color" placeholder="Silver"
                        class="p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <button type="submit" name="submit" id="submit" placeholder="Silver"
                        class="p-2 rounded-md focus:outline-none border-1 border-gray-900 bg-[#7b5d01] text-white"><i class="fa fa-paper-plane"> </i> Submit</button>
                </div>
            </div>
        </form>

    </div>
</main>
</div>

<?php include("../AdminLayout/footer.php"); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                toyotaModels.forEach((val, index) => { carModel.append(`<option>${val}</option>`); })
            } else if (carManufacturer === "Mercedes-Benz") {
                mercedesModels.forEach((val, index) => { carModel.append(`<option>${val}</option>`); })
            } else if (carManufacturer === "BMW") {
                bmwModels.forEach((val, index) => { carModel.append(`<option>${val}</option>`); })
            }

        })
    })

</script>