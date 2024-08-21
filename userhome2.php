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

    .bg {
      position: relative;
      margin: 10px auto;
      width: 90%;
      /* Default width for small screens */
      max-width: 600px;
      /* Restrict maximum width */
    }

    .bg img {
      width: 100%;
      height: auto;
      /* Maintain aspect ratio */
    }

    .countdown {
      width: 45%;
      max-width: 300px;
      padding: 5px 0;
      background: black;
      color: white;
      font-size: 18px;
      border-radius: 4px;
      position: absolute;
      top: 15%;
      left: 56%;
      transform: translateX(-50%);
      text-align: center;
    }

    #comprobar_btn a {
      padding: 10px 20px;
      background: #2c97c3;
      color: white;
      text-decoration: none;
      font-size: 16px;
      text-shadow: 1px 1px 2px black;
      border-radius: 4px;
      display: inline-block;
      margin-bottom: 20px;
    }

    .alert {
      background: #900000;
      color: white;
      padding: 15px;
      text-align: center;
      font-weight: 600;
    }

    /* Medium Devices (Tablets, 768px and up) */
    @media (min-width: 768px) {
      .countdown {
        font-size: 24px;
        padding: 15px 0;
      }
    }

    /* Large Devices (Desktops, 992px and up) */
    @media (min-width: 992px) {
      .bg {
        width: 70%;
        max-width: 800px;
      }
      .countdown {
        font-size: 28px;
        width: 60%;
        max-width: 400px;
        top: 15%;
      }
    }

    /* Extra Large Devices (Large Desktops, 1200px and up) */
    @media (min-width: 1200px) {
      .bg {
        width: 60%;
        height: auto; /* Adjust height if needed */
      }
      .countdown {
        font-size: 32px;
        width: 45%;
        max-width: 500px;
        top: 16%;
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
    <img src="lotter_image.jpeg" style="width: 100%;">
    <div class="countdown" id="countdown">Loading...</div>
  </div>

  <?php
    if($settings['comprobar_status']){
  ?>
  <div id="comprobar_btn" style="width: 100%; text-align:center; display: none">
    <a href="lotterySuccess.php">Comprobar</a>
  </div>
  <?php } ?>

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

        // document.getElementById("checkLotteryForm").style.display = "flex";
        var element = document.getElementById("comprobar_btn");
        if (element) {
          element.style.display = "block";
        }

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