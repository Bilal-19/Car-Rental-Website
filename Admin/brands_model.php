<?php
include("../AdminLayout/header.php");
include("../AdminLayout/sidebar.php");

require_once "../DB/db_connection.php";
require_once "../utilities.php";


$vehicleBrandsQry = "SELECT * FROM vehicle_brands LIMIT 10";
$vehicleBrandsRes = mysqli_query($isConnect, $vehicleBrandsQry);


$vehicleModelQry = "SELECT
                    a.id,
                    b.brand_name,
                    a.model_name
                    FROM
                        vehicle_models a
                    INNER JOIN vehicle_brands b ON
                        a.brand_id = b.id";
$vehicleModelRes = mysqli_query($isConnect, $vehicleModelQry);        
?>
<main class="flex-1 p-6 overflow-x-auto">
    <div class="flex flex-col md:flex-row md:space-x-10 bg-white rounded p-6">
        <div class="md:w-1/2">
            <form class="bg-gray-300 p-5 md:p-8 my-3" id="add_edit_vehicle_brands">
                <input type="hidden" name="rec_id" id="rec_id">
                <h2 class="text-md md:text-lg font-semibold mb-5">Add / Edit Vehicle Brands</h2>

                <div class="flex flex-col md:flex-row md:space-x-5 space-y-5 md:space-y-0">
                    <input id="brand_name" name="brand_name" type="text" placeholder="Ex. Hyundai"
                        class="text-xs border p-2 rounded-md md:w-3/4 focus:outline-none">
                    <button class="bg-blue-500 hover:bg-blue-700 p-2 rounded-md md:w-1/4 text-white"
                        id="add_brands">Submit</button>
                </div>
            </form>
            <div id="notification" class="text-sm my-3"></div>
        </div>

        <div class="md:w-1/2">
            <!-- Table responsive won't work if you remove 'whitespace-nowrap' class -->
            <div class="overflow-x-auto relative my-3">
                <table class="w-full">
                    <thead class="text-xs md:text-sm text-left whitespace-nowrap bg-gray-300">
                        <tr class="border-b-2 border-gray-900 text-center">
                            <th class="p-2">#</th>
                            <th class="p-2" align="left">Brand Name</th>
                            <th class="p-2">No of Associated Models</th>
                            <th class="p-2">Edit</th>
                            <th class="p-2">Delete</th>
                        </tr>
                    </thead>

                    <tbody class="text-xs whitespace-nowrap text-center">
                        <?php
                        if (mysqli_num_rows($vehicleBrandsRes) > 0) {
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($vehicleBrandsRes)) { ?>
                                <tr
                                    class="border-b border-gray-600 hover:bg-gray-200 <?php echo ($i % 2 == 0) ? 'bg-gray-100' : '' ?>">
                                    <td class="p-2"><?php echo $i; ?></td>
                                    <td class="p-2" align="left"><?php echo $row['brand_name']; ?></td>
                                    <td class="p-2"><?php echo 5; ?></td>
                                    <td class="p-2">
                                        <button class="edit_brand" value="<?php echo $row['id']; ?>"><i
                                                class="fa-regular fa-pen-to-square text-blue-700"></i></button </td>
                                    <td class="p-2">
                                        <button class="del_brand" value="<?php echo $row['id']; ?>"><i
                                                class="fa-solid fa-trash-arrow-up text-red-700"></i></button>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add / Edit Vehicle Model -->
    <div class="flex flex-col md:flex-row md:space-x-10 bg-white rounded p-6 my-5">
        <div class="md:w-1/2">
            <form class="bg-gray-300 p-5 md:p-8 my-3" id="add_edit_vehicle_model">
                <input type="hidden" name="rec_id" id="rec_id">
                <h2 class="text-md md:text-lg font-semibold mb-5">Add / Edit Vehicle Models</h2>

                <div class="flex flex-col md:flex-row md:space-x-5 space-y-5 md:space-y-0">
                    <select name="brand_id" id="brand_id"
                        class="text-xs border p-2 rounded-md md:w-1/2 appearance-none focus:outline-none">
                        <option value="">Select Brand</option>
                        <?php
                        $brandNameQry = "SELECT id, brand_name FROM vehicle_brands";
                        $brandNameRes = mysqli_query($isConnect, $brandNameQry);
                        while ($res = mysqli_fetch_assoc($brandNameRes)) { ?>
                            <option value="<?php echo $res['id']; ?>" class="capitalize"><?php echo $res['brand_name']; ?>
                            </option>
                        <?php }
                        ?>
                    </select>
                    <input id="model_name" name="model_name" type="text" placeholder="Sonata N-Line"
                        class="text-xs border p-2 rounded-md md:w-1/2 focus:outline-none">
                    <button class="bg-blue-500 hover:bg-blue-700 p-2 rounded-md md:w-1/4 text-white"
                        id="add_brands">Submit</button>
                </div>
            </form>
            <div id="notification_model" class="text-sm my-3"></div>
        </div>

        <div class="md:w-1/2">
            <!-- Table responsive won't work if you remove 'whitespace-nowrap' class -->
            <div class="overflow-x-auto relative my-3">
                <table class="w-full">
                    <thead class="text-xs md:text-sm text-left whitespace-nowrap bg-gray-300">
                        <tr class="border-b-2 border-gray-900 text-center">
                            <th class="p-2">#</th>
                            <th class="p-2" align="left">Brand</th>
                            <th class="p-2" align="left">Model</th>
                            <th class="p-2">Edit</th>
                            <th class="p-2">Delete</th>
                        </tr>
                    </thead>

                    <tbody class="text-xs whitespace-nowrap text-center">
                        <?php
                        if (mysqli_num_rows($vehicleModelRes) > 0) {
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($vehicleModelRes)) { ?>
                                <tr
                                    class="border-b border-gray-600 hover:bg-gray-200 <?php echo ($i % 2 == 0) ? 'bg-gray-100' : '' ?>">
                                    <td class="p-2"><?php echo $i; ?></td>
                                    <td class="p-2" align="left"><?php echo $row['brand_name']; ?></td>
                                    <td class="p-2" align="left"><?php echo $row['model_name']; ?></td>
                                    <td class="p-2">
                                        <button class="edit_model" value="<?php echo $row['id']; ?>"><i
                                                class="fa-regular fa-pen-to-square text-blue-700"></i></button </td>
                                    <td class="p-2">
                                        <button class="del_model" value="<?php echo $row['id']; ?>"><i
                                                class="fa-solid fa-trash-arrow-up text-red-700"></i></button>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
</div>

<?php include("../AdminLayout/footer.php"); ?>


<script>
    $(document).ready(function () {

        // Create a single ajax to add / edit vehicle brands
        $("#add_edit_vehicle_brands").submit(function (e) {
            e.preventDefault();

            var action = $("#add_brands").text(); //Submit or Update
            var dispatchData = $("#add_edit_vehicle_brands").serialize() + "&submit_mode=add_edit_brands&action=" + action;

            $.ajax({
                url: 'admin_process_ajax.php',
                data: dispatchData,
                type: "POST",
                dataType: "json",
                success: function (data) {
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

        $(".edit_brand").on("click", function () {
            var rec_id = $(this).val()

            $.ajax({
                url: 'admin_process_ajax.php',
                data: { 'submit_mode': 'edit_brand_form', 'rec_id': rec_id },
                dataType: 'json',
                success: function (res) {
                    if (res.query_result == 1) {
                        $("#brand_name").val(res.brand_name)
                        $("#rec_id").val(res.id)
                        $("#add_brands").text("Update")
                    }
                }
            })
        })

        $(".del_brand").on("click", function () {
            var rec_id = $(this).val()

            $.ajax({
                url: 'admin_process_ajax.php',
                data: { 'submit_mode': 'delete_brand', 'rec_id': rec_id },
                dataType: 'json',
                success: function (data) {
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


        // Add / Edit Model using AJAX
        $("#add_edit_vehicle_model").submit(function (e) {
            e.preventDefault();

            var action = $("#add_brands").text(); //Submit or Update
            var dispatchData = $("#add_edit_vehicle_model").serialize() + "&submit_mode=add_edit_model&action=" + action;

            // Send AJAX req only when both values are filled
            if ($("#brand_id").val() != "" && $("#model_name").val() != "") {
                $.ajax({
                    url: 'admin_process_ajax.php',
                    data: dispatchData,
                    type: "POST",
                    dataType: "json",
                    success: function (data) {
                        if (data.query_result == 1) {
                            $("#notification_model").slideDown('slow')
                            $("#notification_model").html(`<p class='w-80 md:w-full mx-auto bg-green-500 text-white p-2 rounded-md'><i class='fa-solid fa-circle-check'></i> ` + data.query_msg + '</p>')
                            $("#notification_model").delay(2000).slideUp('slow', function () {
                                location.reload()
                            })
                        } else {
                            $("#notification_model").html(`<p class='w-80 md:w-full mx-auto bg-yellow-500 text-white p-2 rounded-md'><i class='fa-solid fa-triangle-exclamation'></i> ` + data.query_msg + '</p>')
                        }
                    }
                })
            } else {
                $("#notification_model").slideDown('slow')
                $("#notification_model").html(`<p class='w-80 md:w-full mx-auto bg-red-500 text-white p-2 rounded-md'><i class='fa-solid fa-triangle-exclamation'></i> Please filled all the required fields.</p>`);
            };
        })
    })
</script>