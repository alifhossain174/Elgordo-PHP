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
      margin: 10px auto;
      text-align: center;
    }

    .checkLotteryForm{
      width: 60%;
      margin: auto;
      display: flex;
      border: 2px solid skyblue;
      padding: 20px 0px;
      background-color: white;
    }
    .checkLotteryForm .form-group{
      padding: 0px 20px;
    }

    .checkLotteryForm input{
      padding: 5px;
      font-size: 14px;
      margin-right: 20px;
    }

    .checkLotteryForm button{
      padding: 0px 15px;
      background: green;
      border: none;
      border-radius: 4px;
      color: white;
      font-weight: 600;
      box-shadow: 2px 2px 5px black inset;
      cursor: pointer;
    }

    .alert{
      background: #900000;
      color: white;
      padding: 15px;
      text-align: center;
      font-weight: 600;
    }

    @media only screen and (max-width: 600px) {
      .checkLotteryForm{
        width: 90%;
        display: block !important;
      }

      .checkLotteryForm .form-group label{
        display: block;
        margin-bottom: 5px;
        margin-top: 5px;
      }
      .checkLotteryForm .form-group input{
        width: 95%;
      }
      .checkLotteryForm button{
        padding: 5px 15px;
        margin-top: 10px;
        margin-left: 20px;
      }
    }
  </style>
</head>

<body>
    <div class="bg">
      <img style="max-width: 60%; object-fit: cover;" src="images/<?php echo $settings['lottery_image'];?>" alt="">
    </div>

    <?php if(isset($_SESSION['msg'])){?>
        <div class="alert alert-primary alert-dismissible" role="alert"> 
            <?php echo $_SESSION['msg']; ?> 
        </div>
    <?php unset($_SESSION['msg']);}?>

    <form class="checkLotteryForm" id="checkLotteryForm" action="checkLotteryInfo.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" placeholder="email@sample.com" required>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" placeholder="*******" required>
        </div>
        <button type="submit">Continue</button>
    </form>

</body>

</html>