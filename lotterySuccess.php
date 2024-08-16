<?php
    date_default_timezone_set('Asia/Dhaka');
    include("includes/connection.php");
    include("includes/session_check_user.php");
    include("includes/data.php");
    require("alert/alert.php");
    $settings = getById("tbl_settings","1");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styled Centered Box</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
            max-width: 300px;
            width: 100%;
        }

        .number {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 30px;
            color: #333;
        }

        .button {
            padding: 10px 20px;
            font-size: 1.2rem;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="number">
        <?= isset($_SESSION['lottery_number']) ? $_SESSION['lottery_number'] : ''; ?> 
    </div>
    
    <?php if(isset($_SESSION['comprobar_status']) && $_SESSION['comprobar_status'] == 1){ ?>
    <button class="button">Comprobar</button>
    <?php } ?>
</div>

</body>
</html>
