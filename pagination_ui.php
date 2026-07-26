<!-- Pagination Links -->
<div class="flex flex-row justify-center space-x-3">
    <?php
    for ($link = 1; $link <= $totalPages; $link++) {
        $activeClass = ($link == $page) ? 'bg-[#7B5D01] text-white' : 'bg-[#D1D5DB] text-[#7B5D01]';
        $source = "?page=" . $link; ?>
        <a href="<?php echo $source; ?>"
            class="<?php echo $activeClass; ?> px-5 py-2 rounded-md text-xs"><?php echo $link; ?></a>
    <?php } ?>
</div>