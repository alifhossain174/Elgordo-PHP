<?php 

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    include "includes/connection.php";
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $lotteryNumber = filter_input(INPUT_POST, 'lottery_number', FILTER_SANITIZE_STRING);
    $balance = filter_input(INPUT_POST, 'balance', FILTER_SANITIZE_STRING);
    $lastWin = filter_input(INPUT_POST, 'last_win', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $comprobarStatus = filter_input(INPUT_POST, 'comprobar_status', FILTER_SANITIZE_STRING);

    $sql = "INSERT INTO lottery_info (name, email, password, lottery_number, balance, last_win, comprobar_status)
            VALUES ('$name', '$email', '$password', '$lotteryNumber', '$balance', '$lastWin', '$comprobarStatus')";

    if (mysqli_query($mysqli, $sql)) {
        $_SESSION['msg']="Saved Successfully";

        // Prepare the email
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth = true;
            $mail->Username = 'alifhossain174@gmail.com'; // SMTP username
            $mail->Password = 'ypxgjekdynddzyoj'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; PHPMailer::ENCRYPTION_SMTPS also accepted
            $mail->Port = 587; // TCP port to connect to

            // Recipients
            $mail->setFrom('alifhossain174@gmail.com', 'Company Ltd.');
            $mail->addAddress($email, $name); // Add a recipient

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your Account Has Been Created';
            $mail->Body    = "
            <html>
            <head>
              <title>Your Account Creation Confirmation</title>
            </head>
            <body>
                <p>Dear $name,</p>
                <p>Your account has been successfully created. Here are your new account details:</p>
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