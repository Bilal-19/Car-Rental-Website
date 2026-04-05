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
        <p class="text-xs md:text-sm mb-5"><?php echo $allUserRes->num_rows; ?> records found</p>

        <div id="notification" class="text-sm my-3"></div>
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

                <tbody class="text-xs whitespace-nowrap">
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($allUserRes)) {
                        // echo "<pre>";
                        // print_r($row);
                        ?>
                        <tr class="border-b border-gray-600 hover:bg-gray-200">
                            <td class="p-2 border-x"><?php echo $i++; ?></td>
                            <td class="p-2 border-x"><?php echo $row['full_name']; ?></td>
                            <td class="p-2 border-x"><?php echo $row['email_address']; ?></td>
                            <td class="p-2 border-x"><?php echo $row['phone']; ?></td>
                            <td class="p-2 border-x"><?php echo displayDate($row['created_at']); ?></td>
                            <td class="p-2 border-x text-center"><?php echo ($row['is_account_activated'] == 1) ? '<i class="fa-solid fa-user-check text-green-500"></i>' : '<i class="fa-solid fa-user-xmark text-red-500"></i>'; ?></td>
                            <td class="p-2 border-x text-center"><i class="fa-solid fa-key text-blue-500"></i></td>
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
</script>