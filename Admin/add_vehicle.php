<style>
    label {
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
                    <label for="">Vehicle Name:</label>
                    <input type="text" name="car_name" id="car_name" placeholder="Ex. Toyota Corolla"
                        class="px-3 md:px-6 py-3 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <label for="">Model:</label>
                    <input type="text" name="car_model" id="car_model" placeholder="Ex. Lamborghini Huracán EVO"
                        class="px-3 md:px-6 py-3 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <label for="">Engine:</label>
                    <input type="text" name="car_engine" id="car_engine" placeholder="Ex. 5.2L V10, 610 HP"
                        class="px-3 md:px-6 py-3 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200">
                </div>

                <div class="flex flex-col">
                    <label for="">Category:</label>
                    <select name="car_category" id="car_category"
                        class="p-3 text-sm text-gray-600 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200 appearance-none">
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
                        class="p-3 text-sm text-gray-600 rounded-md focus:outline-none border-1 border-gray-900 bg-gray-200 appearance-none">
                        <option value="">Select Transmission</option>
                        <option value="Automatic Transmission (AT)">Automatic Transmission (AT)</option>
                        <option value="Manual Transmission (MT)">Manual Transmission (MT)</option>
                        <option value="Automated Manual Transmission (AM)">Automated Manual Transmission (AM)</option>
                        <option value="Continuously Variable Transmission (CVT)">Continuously Variable Transmission
                            (CVT)</option>
                    </select>
                </div>
            </div>
        </form>

    </div>
</main>
</div>

<?php include("../AdminLayout/footer.php"); ?>