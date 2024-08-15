<?php 
  include("includes/header.php");
  require("includes/function.php");
  require("alert/alert.php");
  require_once("thumbnail_images.class.php");

  $qry="SELECT * FROM tbl_settings where id='1'";
  $result=mysqli_query($mysqli,$qry);
  $settings_row=mysqli_fetch_assoc($result);
  
   if(isset($_POST['submit']))
   {

    if($_FILES['app_logo']['name']!="")
    {
      unlink('images/'.$settings_row['app_logo']);   
      $app_logo=$_FILES['app_logo']['name'];
      $pic1=$_FILES['app_logo']['tmp_name'];
      $tpath1='images/'.$app_logo;      
      copy($pic1,$tpath1);
    } else {
      $app_logo = $settings_row['app_logo'];
    }
    
    
    if($_FILES['variable_image']['name']!="")
    {
      unlink('images/variable/'.$settings_row['variable_image']);   
      $variable_image=$_FILES['variable_image']['name'];
      $pic2=$_FILES['variable_image']['tmp_name'];
      $tpath2='images/variable/'.$variable_image;      
      copy($pic2,$tpath2);
    }
    else
    {
      $variable_image = $settings_row['variable_image'];
    } 
    
    
    $data = array(
      'app_name' => $_POST['app_name'],
      'time_limit' => date("Y-m-d H:i:s", strtotime($_POST['time_limit'])),
      'access' => $_POST['access'],
      'app_logo' => $app_logo,
      'variable_image' => $variable_image,
      'name' => $_POST['name'],
      'username' => $_POST['username'],
      'password' => $_POST['password'],
      'user_otp' => $_POST['user_otp'],
      'header_title' => $_POST['header_title'],
      'variable_link' => $_POST['variable_link']
    );


    $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
    $_SESSION['msg']="11";
    header( "Location:settings.php");
    exit;
 

   }
   
    if(isset($_POST['notification_submit']))
  {
   

          $data = array(
                'fcm_server_key' => $_POST['fcm_server_key'],
                  );


          $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");

          $_SESSION['msg']="11";
          header( "Location:settings.php");
          exit;
      
 
  } 
  
  
  if(isset($_POST['otp_submit']))
  {
    $data = array(
      'otp' => $_POST['otp']
    );

    $qry = Insert('user_otp',$data);     
    $_SESSION['msg']="11";
    header( "Location:settings.php");
    exit;
  }  
  
  
  
  if(isset($_POST['user_delete_submit']))
  {
            $lineid = $_POST['lineid'];
            $data = array(
                'status' => 0,
                  );


          $settings_edit=Update('tbl_users', $data, "WHERE lineid=$lineid");
          
           $_SESSION['msg']="21";
               header( "Location:settings");
               exit;
          
          /*$settings_edit = "UPDATE tbl_users SET status='0' WHERE lineid=$lineid";

            $result = mysqli_query($mysqli, $settings_edit);

            $row_cnt = mysqli_num_rows($result);
            
            
            $result = $mysqli->query($settings_edit);

            $row_cnt = $result->num_rows;


              if ($row_cnt >= 1)  {
                  $_SESSION['msg']="21";
                  header( "Location:settings");
                  exit;
              }else{
                  $_SESSION['msg']="22";
              }*/



       
  } 
  
  
    
  if(isset($_POST['user_reactive_submit']))
  {
            $lineid = $_POST['lineid'];
            $data = array(
                'status' => 1,
                  );


          $settings_edit=Update('tbl_users', $data, "WHERE lineid=$lineid");
          
           $_SESSION['msg']="23";
               header( "Location:settings.php");
               exit;
 
  } 
  
  
  if(isset($_POST['youtube_submit']))
  {
      

/*          $data = array(
                'youtube_api_key' => $_POST['youtube_api_key'],
                  );


          $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");

          $_SESSION['msg']="11";
          header( "Location:settings");
          exit;*/
      
 
  } 

    
?>
<div class="main-content">
  <section class="section">
    <div class="section-body">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <legend class="hidden-first">Settings</legend>
            </div>
            <div class="card-body">
              <div class="col-md-12 col-sm-12">
                <?php if(isset($_SESSION['msg'])){?>
                <div class="alert alert-primary alert-dismissible" role="alert"> <button type="button" class="close"
                    data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <?php echo $alert_msg[$_SESSION['msg']] ; ?></a> </div>
                <?php unset($_SESSION['msg']);}?>
              </div>

              <div class="card-body">
                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#Main" role="tab"
                      aria-controls="home" aria-selected="true">Main</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" id="contact-tab2" data-toggle="tab" href="#userotp" role="tab"
                      aria-controls="contact" aria-selected="false">User OTP</a>
                  </li>


                  <!--<li class="nav-item">
                        <a class="nav-link" id="contact-tab2" data-toggle="tab" href="#useradd" role="tab"
                          aria-controls="contact" aria-selected="false">User Add</a>
                      </li>
                      
                      
                      <li class="nav-item">
                        <a class="nav-link" id="contact-tab2" data-toggle="tab" href="#userdelete" role="tab"
                          aria-controls="contact" aria-selected="false">Inactive User</a>
                      </li>
                      
                       <li class="nav-item">
                        <a class="nav-link" id="contact-tab2" data-toggle="tab" href="#userreactive" role="tab"
                          aria-controls="contact" aria-selected="false">Reactive User</a>
                      </li>-->

                </ul>
                <div class="tab-content tab-bordered" id="myTab3Content">
                  <div class="tab-pane fade show active" id="Main" role="tabpanel" aria-labelledby="home-tab2">
                    <form action="" name="settings" method="post" class="form form-horizontal"
                      enctype="multipart/form-data">
                      <fieldset>
                        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">App Name</label>
                          <div class="col-sm-12 col-md-7">
                            <input class="form-control" type="text" name="app_name" id="app_name"
                              value="<?php echo $settings_row['app_name'];?>" />
                          </div>
                        </div>

                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                          <div class="col-sm-12 col-md-7">
                            <input class="form-control" type="text" name="name" id="name"
                              value="<?php echo $settings_row['name'];?>" />
                          </div>
                        </div>

                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Time Limit</label>
                          <div class="col-sm-12 col-md-7">
                            <input class="form-control" type="datetime-local" name="time_limit" id="time_limit"
                              value="<?php echo $settings_row['time_limit'];?>" />
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">New UI Access</label>
                          <div class="col-sm-12 col-md-7">
                            <select name="access" class="form-control" required>
                              <option value="1" <?= $settings_row['access'] == 1 ? 'selected' : ''?>>Enable</option>
                              <option value="0" <?= $settings_row['access'] == 0 ? 'selected' : ''?>>Disable</option>
                            </select>
                          </div>
                        </div>

                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">username</label>
                          <div class="col-sm-12 col-md-7">
                            <input class="form-control" type="text" name="username" id="username"
                              value="<?php echo $settings_row['username'];?>" />
                          </div>
                        </div>

                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
                          <div class="col-sm-12 col-md-7">
                            <input class="form-control" type="password" name="password" id="password"
                              value="<?php echo $settings_row['password'];?>" />
                          </div>
                        </div>

                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">User OTP</label>
                          <div class="col-sm-12 col-md-7">
                            <input class="form-control" type="text" name="user_otp" id="user_otp"
                              value="<?php echo $settings_row['user_otp'];?>" />
                          </div>
                        </div>

                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Header Title</label>
                          <div class="col-sm-12 col-md-7">
                            <input class="form-control" type="text" name="header_title" id="header_title"
                              value="<?php echo $settings_row['header_title'];?>" />
                          </div>
                        </div>

                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Variable Link</label>
                          <div class="col-sm-12 col-md-7">
                            <input class="form-control" type="text" name="variable_link" id="variable_link"
                              value="<?php echo $settings_row['variable_link'];?>" />
                          </div>
                        </div>



                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Variable Image</label>
                          <div class="col-sm-12 col-md-7">
                            <input class="form-control" type="file" name="variable_image" value="fileupload"
                              id="fileupload" />
                          </div>
                        </div>


                        <?php if($settings_row['variable_image']!="") {?>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Variable Image
                            Preview</label>
                          <div class="col-sm-12 col-md-7">
                            <img style="max-width: 60%; object-fit: cover;"
                              src="images/variable/<?php echo $settings_row['variable_image'];?>" alt="">
                          </div>
                        </div>





                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">App Icon</label>
                          <div class="col-sm-12 col-md-7">
                            <input class="form-control" type="file" name="app_logo" value="fileupload"
                              id="fileupload" />
                          </div>
                        </div>

                        <?php if($settings_row['app_logo']!="") {?>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Icon Preview</label>
                          <div class="col-sm-12 col-md-7">
                            <img style="max-width: 60%; object-fit: cover;"
                              src="images/<?php echo $settings_row['app_logo'];?>" alt="">
                          </div>
                        </div>

                        <div class="card-footer text-right">
                          <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                              <button type="submit" name="submit" class="btn btn-lg btn-primary">Submit</button>
                            </div>
                          </div>
                        </div>
                        <?php } ?>
                        <?php } ?>

                      </fieldset>
                    </form>
                  </div>



                  <div class="tab-pane fade" id="userotp" role="tabpanel" aria-labelledby="profile-tab2">
                    <form action="" name="otp" method="post" class="form form-horizontal" enctype="multipart/form-data">
                      <fieldset>
                        <!--<input  type="hidden" name="id" value="<?php echo $_GET['id'];?>" />-->

                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">User OTP</label>
                          <div class="col-sm-12 col-md-7">
                            <input class="form-control" type="text" name="otp" id="otp" placeholder="OTP" required />
                          </div>
                        </div>


                        <div class="card-footer text-right">
                          <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                              <button type="submit" name="otp_submit" class="btn btn-lg btn-primary">Submit</button>
                            </div>
                          </div>
                        </div>

                      </fieldset>
                    </form>
                  </div>


                  <!-- <div class="tab-pane fade" id="useradd" role="tabpanel" aria-labelledby="profile-tab2">
                       <form action="" name="settings" method="post" class="form form-horizontal" enctype="multipart/form-data">
					<fieldset>
						<input  type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
						
				    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Customer Line ID</label>
                      <div class="col-sm-12 col-md-7">
                        <input class="form-control" type="text" name="lineid" id="lineid" placeholder="Line ID" required/>
                      </div>
                    </div>-->

                  <!--         <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Customer Name</label>
                      <div class="col-sm-12 col-md-7">
                        <input class="form-control" type="text" name="name" id="name" placeholder="Full Name" required/>
                      </div>
                    </div>
                    
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Phone Number</label>
                      <div class="col-sm-12 col-md-7">
                        <input class="form-control" type="text" name="phone" id="phone" placeholder="Phone Number" required/>
                      </div>
                    </div>
                    
               
                    
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
                      <div class="col-sm-12 col-md-7">
                        <input class="form-control" type="text" name="password" id="password" placeholder="Password" required/>
                      </div>
                    </div>
                    
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Address</label>
                      <div class="col-sm-12 col-md-7">
                        <input class="form-control" type="text" name="address" id="address" placeholder="Address" />
                      </div>
                    </div>-->


                  <!--<div class="card-footer text-right">
					<div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-sm-12 col-md-7">
                        <button type="submit" name="user_add_submit" class="btn btn-lg btn-primary">Submit</button>
                      </div>
                    </div>
                     </div>
							
                     </fieldset>
					</form>
                      </div>-->








                  <div class="tab-pane fade" id="userdelete" role="tabpanel" aria-labelledby="profile-tab2">
                    <form action="" name="settings" method="post" class="form form-horizontal"
                      enctype="multipart/form-data">
                      <fieldset>
                        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />


                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Customer Line ID</label>
                          <div class="col-sm-12 col-md-7">
                            <input class="form-control" type="text" name="lineid" id="lineid" placeholder="Line ID"
                              required />
                          </div>
                        </div>



                        <div class="card-footer text-right">
                          <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                              <button type="submit" name="user_delete_submit"
                                class="btn btn-lg btn-primary">Submit</button>
                            </div>
                          </div>
                        </div>

                      </fieldset>
                    </form>
                  </div>





                  <div class="tab-pane fade" id="userreactive" role="tabpanel" aria-labelledby="profile-tab2">
                    <form action="" name="settings" method="post" class="form form-horizontal"
                      enctype="multipart/form-data">
                      <fieldset>
                        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />


                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Customer Line ID</label>
                          <div class="col-sm-12 col-md-7">
                            <input class="form-control" type="text" name="lineid" id="lineid" placeholder="Line ID"
                              required />
                          </div>
                        </div>



                        <div class="card-footer text-right">
                          <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                              <button type="submit" name="user_reactive_submit"
                                class="btn btn-lg btn-primary">Submit</button>
                            </div>
                          </div>
                        </div>

                      </fieldset>
                    </form>
                  </div>





                </div>
              </div>





            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include("includes/footer.php");?>