<!-- Main Layout -->
    <div class="flex flex-1">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="bg-[#7B5D01] text-black w-64 space-y-4 py-6 px-4 absolute md:relative z-10 top-16 left-0 md:top-0 md:flex md:flex-col transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out h-min-screen">
            <nav class="space-y-10 text-sm">
                <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/Admin/dashboard.php'; ?>"
                    class="flex items-center space-x-2 px-4 py-2 border-b bg-white text-black rounded hover:bg-gray-200">
                    <i class="fa-solid fa-house"></i>
                    <span class="inline">Dashboard</span>
                </a>
                <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/Admin/registered_user.php'; ?>"
                    class="flex items-center space-x-2 px-4 py-2 border-b bg-white text-black rounded hover:bg-gray-200">
                    <i class="fa-solid fa-users"></i>
                    <span class="inline">Registered Users</span>
                </a>
                <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/Admin/vehicles.php'; ?>"
                    class="flex items-center space-x-2 px-4 py-2 border-b bg-white text-black rounded hover:bg-gray-200">
                    <i class="fa-solid fa-car"></i>
                    <span class="inline">All Vehicles</span>
                </a>
                <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/Admin/booked_vehicles.php'; ?>"
                    class="flex items-center space-x-2 px-4 py-2 border-b bg-white text-black rounded hover:bg-gray-200">
                    <i class="fas fa-car-side"></i>
                    <span class="inline">Booked Vehicles</span>
                </a>
                <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/Admin/brands_model.php'; ?>"
                    class="flex items-center space-x-2 px-4 py-2 border-b bg-white text-black rounded hover:bg-gray-200">
                    <i class="fa-solid fa-taxi"></i>
                    <span class="inline">Brands & Model</span>
                </a>
                <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/Admin/user_enquiries.php'; ?>"
                    class="flex items-center space-x-2 px-4 py-2 border-b bg-white text-black rounded hover:bg-gray-200">
                    <i class="fa-solid fa-question"></i>
                    <span class="inline">Customer Enquiries</span>
                </a>
                <a href="#"
                    class="flex items-center space-x-2 px-4 py-2 border-b bg-white text-black rounded hover:bg-gray-200">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span class="inline">Log Out</span>
                </a>
            </nav>
        </aside>