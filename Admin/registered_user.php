<?php
include("../AdminLayout/header.php");
include("../AdminLayout/sidebar.php");

require_once "../DB/db_connection.php";
require_once "../utilities.php";

$fetchUserQry = "SELECT * FROM users LIMIT 10";
$allUserRes = mysqli_query($isConnect, $fetchUserQry);

?>
<main class="flex-1 p-6 overflow-x-auto">
    <div class="w-full mt-5 bg-white rounded p-6">
        <h2 class="text-xl font-semibold">Registered Users</h2>
        <p class="text-xs md:text-sm mb-5" id="record-stats"><?php echo $allUserRes->num_rows; ?> records found</p>

        <!-- Added search filter here -->
        <div class="flex space-x-3">
            <input type="search" id="search_val" class="w-full border text-sm p-2 rounded-md focus:outline-none"
                placeholder="Search by name or email">
            <!-- <button id="search_btn" class="border text-sm p-2 rounded-md w-1/5 bg-blue-500 text-white"><i class="fa fa-search"></i> Search</button> -->
        </div>

        <div id="pswd_notification" class="text-sm my-3"></div>
        <!-- Table responsive won't work if you remove 'whitespace-nowrap' class -->
        <div class="overflow-x-auto relative my-3">
            <table class="w-full">
                <thead class="text-xs md:text-sm text-left whitespace-nowrap bg-gray-300">
                    <tr class="border-b-2 border-gray-900 text-center">
                        <th class="p-3">#</th>
                        <th class="p-3">Full Name</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">Phone</th>
                        <th class="p-3">Account Creation Datetime</th>
                        <th class="p-3">Account Activated</th>
                        <th class="p-3">Reset Password</th>
                    </tr>
                </thead>

                <tbody class="text-xs whitespace-nowrap" id="reg_user_data">
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($allUserRes)) {
                        // echo "<pre>";
                        // print_r($row);
                        ?>
                        <tr
                            class="border-b border-gray-600 hover:bg-gray-200 <?php echo ($i % 2 == 0) ? 'bg-gray-100' : '' ?>">
                            <td class="p-2 border-x"><?php echo $i++; ?></td>
                            <td class="p-2 border-x"><?php echo $row['full_name']; ?></td>
                            <td class="p-2 border-x"><?php echo $row['email_address']; ?></td>
                            <td class="p-2 border-x"><?php echo $row['phone']; ?></td>
                            <td class="p-2 border-x"><?php echo displayDate($row['created_at']); ?></td>
                            <td class="p-2 border-x text-center">
                                <button class="active_deactive_account" value="<?php echo $row['id']; ?>">
                                    <?php echo ($row['is_account_activated'] == 1) ? '<i class="fa-solid fa-user-check text-green-500"></i>' : '<i class="fa-solid fa-user-xmark text-red-500"></i>'; ?>
                                </button>
                            </td>
                            <td class="p-2 border-x text-center">
                                <button class="reset_pswd" value="<?php echo $row['id']; ?>">
                                    <i class="fa-solid fa-key text-blue-500"></i>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</main>
</div>

<?php include("../AdminLayout/footer.php"); ?>

<script>
    // Added feature: Reset password, active account, deactivate account.
    $(document).ready(function () {
        $(document).on("click", ".reset_pswd", function () {
            var user_id = $(this).val();

            $.ajax({
                url: 'admin_process_ajax.php',
                dataType: "json",
                data: { 'user_id': user_id, 'submit_mode': 'reset_password' },
                success: function (data) {
                    // console.log("AJAX res : " + data)

                    if (data.query_result == 1) {
                        $("#pswd_notification").slideDown('slow')
                        $("#pswd_notification").html(`<p class='w-80 md:w-full mx-auto bg-green-500 text-white p-2 rounded-md'><i class='fa-solid fa-circle-check'></i> ` + data.query_msg + '</p>')
                        $("#pswd_notification").delay(2000).slideUp('slow');
                    } else {
                        $("#pswd_notification").html(`<p class='w-80 md:w-full mx-auto bg-yellow-500 text-white p-2 rounded-md'><i class='fa-solid fa-triangle-exclamation'></i> ` + data.query_msg + '</p>')
                    }
                }
            })
        })

        $(document).on("click", ".active_deactive_account", function () {
            var account_id = $(this).val();

            $.ajax({
                url: 'admin_process_ajax.php',
                dataType: "json",
                data: { 'account_id': account_id, 'submit_mode': 'upd_account_status' },
                success: function (data) {
                    // console.log("AJAX Response: " + data)

                    if (data.query_result == 1) {
                        $("#pswd_notification").slideDown('slow')
                        $("#pswd_notification").html(`<p class='w-80 md:w-full mx-auto bg-green-500 text-white p-2 rounded-md'><i class='fa-solid fa-circle-check'></i> ` + data.query_msg + '</p>')
                        $("#pswd_notification").delay(3000).slideUp('slow', function () {
                            location.reload()
                        });
                    } else {
                        $("#pswd_notification").html(`<p class='w-80 md:w-full mx-auto bg-yellow-500 text-white p-2 rounded-md'><i class='fa-solid fa-triangle-exclamation'></i> ` + data.query_msg + '</p>')
                    }
                }
            })
        })

        // Live Search
        $("#search_val").on("keyup", function () {
            var search_val = $(this).val();
            console.log(search_val)

            $.ajax({
                url: "admin_process_ajax.php",
                type: "GET",
                data: {
                    submit_mode: "live_search",
                    channel: "admin",
                    search_param: search_val
                },
                success: function (res) {
                    if (res == "<tr><td class='text-xs md:text-sm mb-5'>No record found.</td></tr>") {
                        // $("#record-stats").addClass("none");
                        $("#record-stats").html(res);
                        $("#reg_user_data").html("");
                    } else {
                        $("#reg_user_data").html(res)
                    }

                }
            })
        })
    })
</script>