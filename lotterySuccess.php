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
  <title><?php echo $settings['app_name']?></title>
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f0f0f0;
    }
    .bg{
      height: 547px; 
      width: 60%; 
      background: url('lotter_image.jpeg'); 
      background-size: contain; 
      background-repeat: no-repeat;
      position: relative;
      margin: 10px auto;
    }
    .countdown{
      width: 45%; 
      padding: 15px 0px; 
      background: #E0E9F8; 
      color: #1e1e1e; 
      font-size: 30px; 
      font-weight: 600;
      border-radius: 4px;
      position: absolute;
      top: 92px;
      left: 34%;
      text-align: center;
    }

    .button{
        display: inline-block;
        padding: 10px 25px;
        margin-bottom: 20px;
        background: skyblue;
        border-radius: 4px;
        border: none;
        font-size: 16px;
        font-weight: 600;
        color: #1e1e1e;
        box-shadow: 2px 2px 5px black;
        cursor: pointer;
    }

    @media only screen and (max-width: 600px) {
      .bg{
        width: 90%; 
      }
    }
  </style>
</head>

<body>
    <div class="bg">
        <div class="countdown" id="countdown"><?= isset($_SESSION['lottery_number']) ? $_SESSION['lottery_number'] : ''; ?> </div>
    </div>

    <div style="width: 100%; text-align:center">
        <?php if(isset($_SESSION['comprobar_status']) && $_SESSION['comprobar_status'] == 1){ ?>
            <a href="https://wallet.europeanlotteries.online?lotter_no=<?=$_SESSION['lottery_number'];?>" class="button">Comprobar</a>
        <?php } ?>
    </div>

</body>

</html>