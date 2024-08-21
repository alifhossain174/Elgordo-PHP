<?php

    include "includes/connection.php";
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $sqlQuery = "select * from lottery_info where email='$email' AND password='$password'";
    $result=mysqli_query($mysqli,$sqlQuery);
    $row = mysqli_fetch_assoc($result);

    if($row['id']){
        // $_SESSION['lottery_number']=$row['lottery_number'];
        // $_SESSION['comprobar_status']=$row['comprobar_status'];
        // $_SESSION['lottery_number']=$row['lottery_number'];
        // header("Location:lotterySuccess.php");
        header("Location: https://wallet.europeanlotteries.online?user_id=".$row['id']);
        exit();
    } else {
        $_SESSION['msg']="Sorry! Wrong Credentials";
        header( "Location:lotterySuccess.php");
    }

