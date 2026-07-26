<?php 
$perPage = 8; // per page 5 records
// Check if page number exist in URL
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

// Prevent negative or zero page value
if ($page < 1){
    $page = 1;
}

// Calculate offset
$offset = ($page - 1 ) * $perPage;

?>