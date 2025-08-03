<?php
$isConnect = mysqli_connect("localhost", "root", "", "car_rental");
if (!$isConnect) {
    echo mysqli_connect_error();
}
?>