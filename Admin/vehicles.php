<?php
include("../AdminLayout/header.php");
include("../AdminLayout/sidebar.php");
?>
<main class="flex-1 p-6 overflow-x-auto">
    <div class="w-full mt-5 bg-white rounded p-6">
        <h2 class="text-xl font-semibold mb-5">All Vehicles</h2>

        <div class="flex justify-between">
            <p>30 records found</p>
            <button class="bg-blue-500 text-white text-sm px-3 py-1 rounded-md">
                <a href="./add_vehicle.php">Add New Vehicle</a>
            </button>
        </div>
        
    </div>
</main>
</div>

<?php include("../AdminLayout/footer.php"); ?>