<?php
$servername = "www.db4free.net";
$username = "gusade";
$password = "gusade09";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

mysqli_select_db($conn,"db_resource");

?>