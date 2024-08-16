<?php

    include "includes/connection.php";
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $sqlQuery = "select * from lottery_info where email='$email' AND password='$password'";
    $result=mysqli_query($mysqli,$sqlQuery);
    $row = mysqli_fetch_assoc($result);
    echo $row['id'];

    if($row['id']){
        $_SESSION['lottery_number']=$row['lottery_number'];
        $_SESSION['comprobar_status']=$row['comprobar_status'];

        echo $_SESSION['comprobar_status'];
        header( "Location:lotterySuccess.php");
    } else {
        $_SESSION['msg']="Sorry! Wrong Credentials";
        header( "Location:userhome2.php");
    }

