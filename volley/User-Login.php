<?php
include 'DatabaseConfig.php';
$con = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);

if ($_SERVER['REQUEST_METHOD']=='POST') {
    
    $Email = $_POST['email'];
    $Password = $_POST['password'];
    
    $sql_Query = "SELECT * FROM pengguna WHERE email='$Email' and password='$Password'";
    $check = mysqli_fetch_array(mysqli_query($con, $sql_Query));

    if (isset($check)) {
        echo "Data Matched";
    }else {
        echo "Invalid Username or Password!";
    }
    mysqli_close($con);
}
?>