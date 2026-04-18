<script>
    const toggleBtn = document.getElementById("toggleBtn")
    const menus = document.getElementById("toggleMenus");
    toggleBtn.addEventListener("click", () => {
        menus.classList.toggle("hidden")
    })

    $(document).ready(function () {
        $("#log-in-out").on("click", function () {
            window.location.href = "<?php echo $redirectTo; ?>"
        })
    })
</script>

<?php $path = "http://" . $_SERVER['HTTP_HOST']; ?>


<div
    class="w-full bg-[#1E1E1E] text-white flex flex-col md:flex-row justify-between items-start md:text-xl p-5 md:p-15 space-y-10 md:space-y-0">
    <div>
        <a href="<?php echo $path; ?>">
            <img src="<?php echo $path . '/Assets/logo.png'; ?>" alt="logo" class="h-12 ml-3">
        </a>
    </div>
    <div>
        <h5 class="font-medium">Quick Links</h5>
        <div class="font-extralight flex flex-col text-sm space-y-1">
            <a class="hover:text-[#FFD43B]" href="<?php echo $path; ?>">Home</a>
            <a class="hover:text-[#FFD43B]" href="<?php echo $path . "/Visitor/car_listing.php"; ?>">Car Listing</a>
            <a class="hover:text-[#FFD43B]" href="<?php echo $path . "/Visitor/about_us.php"; ?>">About Us</a>
            <a class="hover:text-[#FFD43B]" href="<?php echo $path . "/Visitor/contact_us.php"; ?>">Contact Us</a>
        </div>
    </div>
    <div>
        <h5>Contact Us</h5>
        <div class="font-extralight flex flex-col text-sm space-y-1">
            <a class="hover:text-[#FFD43B] cursor-pointer">+971-50-1234567</a>
            <a class="hover:text-[#FFD43B] cursor-pointer">support@eliteautomotors.com</a>
            <a class="hover:text-[#FFD43B] cursor-pointer">Dubai Marina, UAE</a>
        </div>
    </div>
</div>
</body>

</html>