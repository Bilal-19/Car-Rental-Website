<?php
include("../AdminLayout/header.php");
include("../AdminLayout/sidebar.php");

require_once "../DB/db_connection.php";
require_once "../utilities.php";


$vehicleBrandsQry = "SELECT * FROM vehicle_brands LIMIT 10";
$vehicleBrandsRes = mysqli_query($isConnect, $vehicleBrandsQry);

?>
<main class="flex-1 p-6 overflow-x-auto">
    <div class="w-full mt-5 bg-white rounded p-6">
        <h2 class="text-xl font-semibold mb-5">Vehicle Brands</h2>

        <form class="bg-gray-300 p-5 md:p-8" id="add_edit_vehicle_brands">
            <h2 class="text-md md:text-lg font-semibold mb-5">Add / Edit Vehicle Brands</h2>

            <div class="flex flex-col md:flex-row md:space-x-5 space-y-5 md:space-y-0">
                <input id="brand_name" name="brand_name" type="text" placeholder="Ex. Hyundai"
                    class="text-xs border p-2 rounded-md md:w-3/4">
                <button class="bg-blue-500 p-2 rounded-md md:w-1/4 text-white" id="add_brands">Submit</button>
            </div>
        </form>

        <div id="notification" class="text-sm my-3"></div>
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
                        while ($row = mysqli_fetch_assoc($vehicleBrandsRes)) { ?>
                            <tr class="border-b border-gray-600 hover:bg-gray-200">
                                <td class="p-2"><?php echo $row['id']; ?></td>
                                <td class="p-2" align="left"><?php echo $row['brand_name']; ?></td>
                                <td class="p-2"><?php echo 5; ?></td>
                                <td class="p-2">
                                    <button class="edit_brand" value="<?php echo $row['id']; ?>"><i class="fa-regular fa-pen-to-square text-blue-700"></i></button
                                </td>
                                <td class="p-2">
                                    <button class="del_brand" value="<?php echo $row['id']; ?>"><i class="fa-solid fa-trash-arrow-up text-red-700"></i></button>
                                </td>
                            </tr>

                        <?php }
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
</main>
</div>

<?php include("../AdminLayout/footer.php"); ?>


<script>
    $(document).ready(function () {

        $("#add_edit_vehicle_brands").submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: 'admin_process_ajax.php',
                data: $("#add_edit_vehicle_brands").serialize() + "&submit_mode=add_edit_brands",
                type: "POST",
                dataType: "json",
                success: function (data) {
                    console.log("AJAX res: " + data.query_result + "--" + data.query_msg)
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

        
    })
</script>