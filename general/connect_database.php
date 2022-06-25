<?php
$link = @mysqli_connect("localhost","ergasiaEPDmerosB","csd2022");

if (!$link) {
    echo '<p> Error connecting to the server! <br>';
    echo 'Please try again.</p>';
    exit();
}

$result_of_connection = @mysqli_select_db($link, 'ergasiaepdmerosb');

mysqli_set_charset($link, "utf8");

if (!$result_of_connection) {
    echo '<p> Error connecting to the database! <br>';
    echo 'Please try again.</p>';
    exit();
}
?>
