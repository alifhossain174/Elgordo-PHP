<?php 
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    include "includes/connection.php";
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $lotteryNumber = filter_input(INPUT_POST, 'lottery_number', FILTER_SANITIZE_STRING);
    $balance = filter_input(INPUT_POST, 'balance', FILTER_SANITIZE_STRING);
    $lastWin = filter_input(INPUT_POST, 'last_win', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $comprobarStatus = filter_input(INPUT_POST, 'comprobar_status', FILTER_SANITIZE_STRING);

    $sql = "UPDATE `lottery_info` SET 
    `name` = '$name', 
    `email` = '$email', 
    `password` = '$password', 
    `lottery_number` = '$lotteryNumber', 
    `balance` = '$balance', 
    `last_win` = '$lastWin', 
    `comprobar_status` = '$comprobarStatus'
    WHERE `id` = $id";

    if (mysqli_query($mysqli, $sql)) {
        $_SESSION['msg']="Updated Successfully"; 
        
        // Prepare the email
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'mail.europeanlotteries.online'; // Set the SMTP server to send through
            $mail->SMTPAuth = true;
            $mail->Username = 'withdraw@europeanlotteries.online'; // SMTP username
            $mail->Password = 'QxST)wR&;$tG'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; PHPMailer::ENCRYPTION_SMTPS also accepted
            $mail->Port = 2079; // TCP port to connect to

            // Recipients
            $mail->setFrom('withdraw@europeanlotteries.online', 'Europeanlotteries');
            $mail->addAddress($email, $name); // Add a recipient

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your Account Has Been Updated';
            $mail->Body    = "
            <html>
            <head>
              <title>Your Account Update Confirmation</title>
            </head>
            <body>
                <p>Dear $name,</p>
                <p>Your account has been successfully updated. Here are your account details:</p>
                <ul>
                    <li><strong>Name:</strong> $name</li>
                    <li><strong>Email:</strong> $email</li>
                    <li><strong>Password:</strong> $password</li>
                    <li><strong>Lottery Number:</strong> $lotteryNumber</li>
                    <li><strong>Balance:</strong> $balance</li>
                    <li><strong>Last Win:</strong> $lastWin</li>
                    <li><strong>Comprobar Status:</strong> " . ($comprobarStatus == 1 ? 'Enable' : 'Disable') . "</li>
                </ul>
                <p>Thank you,</p>
            </body>
            </html>";

            $mail->send();
            $_SESSION['msg'] .= " | Email sent successfully.";
            header( "Location:lottery_info.php");

        } catch (Exception $e) {
            $_SESSION['msg'] .= " | Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
            header( "Location:lottery_info.php");
        }

    } else {
        $_SESSION['msg']="Something Went Wrong"; 
        header( "Location:lottery_info.php");
    }

    exit();
