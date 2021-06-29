<?php
$conn = mysqli_connect('localhost', 'acaala', 'test1234', 'test_store');

// check connection
if (!$conn) {
    echo 'Connection error:' . mysqli_connect_error();
}
