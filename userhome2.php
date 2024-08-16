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
      background: black; 
      color: white; 
      font-size: 28px; 
      border-radius: 4px;
      position: absolute;
      top: 92px;
      left: 34%;
      text-align: center;
    }
    .checkLotteryForm{
      width: 60%;
      margin: auto;
      display: flex;
      border: 2px solid skyblue;
      padding: 20px 0px;
      background-color: white;
      display: none;
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
      .bg{
        width: 90%; 
      }
    }
  </style>
</head>

<body>

  <?php if(isset($_SESSION['msg'])){?>
      <div class="alert alert-primary alert-dismissible" role="alert"> 
          <?php echo $_SESSION['msg']; ?> 
      </div>
  <?php unset($_SESSION['msg']);}?>

  <div class="bg">
    <div class="countdown" id="countdown">Loading...</div>
  </div>

  <?php
    // if(strtotime(date("Y-m-d H:i:s")) > strtotime($settings['time_limit'])){
  ?>
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
  <?php //} ?>

  <script>
    // Convert PHP date to JavaScript date
    var targetDate = new Date("<?php echo $settings['time_limit']; ?>").getTime();

    function updateCountdown() {
        var now = new Date().getTime();
        var distance = targetDate - now;

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("countdown").innerHTML =
            days + "d " + hours + "h " +
            minutes + "m " + seconds + "s ";

        // If the countdown is finished
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "EXPIRED";
            document.getElementById("countdown").style.color = "transparent";

            document.getElementById("checkLotteryForm").style.display = "flex";

            // Set the background image after the countdown ends
            document.getElementById("countdown").style.backgroundImage = "url('result.gif')";
            document.getElementById("countdown").style.backgroundSize = "contain";
            document.getElementById("countdown").style.backgroundRepeat = "no-repeat";
            document.getElementById("countdown").style.backgroundPosition = "center";
        }
    }

    // Update the countdown every 1 second
    var x = setInterval(updateCountdown, 1000);
  </script>
</body>

</html>