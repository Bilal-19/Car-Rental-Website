<?php 
include("../AdminLayout/header.php");
include("../AdminLayout/sidebar.php");
 ?>
<main class="flex-1 p-6 overflow-x-auto">
    <div class="w-full mt-5 bg-white rounded p-6">
        <h2 class="text-xl font-semibold mb-5">Admin Dashboard</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div class="bg-gray-200 rounded-md p-5 text-center border-x-1 border-b-4 border-gray-900">
                <h3 class="font-medium text-xl">Total Visa Applicants</h3>
                <p class="md:text-lg">
                    <i class="fa-solid fa-users-between-lines text-blue-700"></i> {{ $countApplicants }}
                </p>
            </div>

            <div class="bg-gray-200 rounded-md p-5 text-center border-x-1 border-b-4 border-gray-900">
                <h3 class="font-medium text-xl">Approved Applicants</h3>
                <p class="md:text-lg">
                    <i class="fa-solid fa-users-line text-green-700"></i> {{ $approvedApplicants }}
                </p>
            </div>

            <div class="bg-gray-200 rounded-md p-5 text-center border-x-1 border-b-4 border-gray-900">
                <h3 class="font-medium text-xl">Reject Applicants</h3>
                <p class="md:text-lg">
                    <i class="fa-solid fa-users-slash text-red-700"></i> {{ $rejectedApplicants }}
                </p>
            </div>
        </div>

        <div class="w-full flex flex-col md:flex-row md:justify-between my-3">
            <div id="nationality-pie-chart" class="w-76 md:w-1/2"></div>
            <div id="gender-bar-chart" class="w-76 md:w-1/2"></div>
        </div>
    </div>
</main>
</div>

<?php include("../AdminLayout/footer.php"); ?>
