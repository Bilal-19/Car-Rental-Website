<script>
    const toggleBtn = document.getElementById("toggleBtn")
    const menus = document.getElementById("toggleMenus");
    toggleBtn.addEventListener("click", () => {
        menus.classList.toggle("hidden")
    })
</script>

<div class="w-full bg-[#1E1E1E] text-white flex flex-col md:flex-row justify-between items-start md:text-xl p-5 md:p-15 space-y-10 md:space-y-0">
    <div>
        <img src="../Assets/logo.png" alt="logo" class="h-12">
    </div>
    <div>
        <h5 class="font-medium">Quick Links</h5>
        <div class="font-extralight flex flex-col">
            <a href="">Home</a>
            <a href="">Car Listing</a>
            <a href="">About Us</a>
            <a href="">Contact Us</a>
        </div>
    </div>
    <div>
        <h5>Contact Us</h5>
        <div class="font-extralight flex flex-col">
            <a href="">+971-50-1234567</a>
            <a href="">support@eliteautomotors.com</a>
            <a href="">Dubai Marina, UAE</a>
        </div>
    </div>
</div>
</body>

</html>