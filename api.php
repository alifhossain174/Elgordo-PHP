<?php 
 
    //getting database connection
    require_once 'includes/connection.php';
  	include("includes/function.php");
  	include("includes/data.php");
  	$settings = getById("tbl_settings","1");
    
    $imagepath = getBaseUrl();
    
    //array to show the response
    $response = array();
    $key_get = $_GET['key'];
    $getChannelsByCat = $_GET['getChannelsByCat'];
    $slider = $_GET['slider'];
    $byid = $_GET['byid'];
    $get_latest = $_GET['latest'];
    $get_mostview = $_GET['mostview'];
    
    $lineid = $_GET['lineid'];
    
  if($key_get == $settings['api_key']){  
    
    if(isset($_GET['apicall'])){
		
		switch($_GET['apicall']){
            
        case 'category':
                if(isset($get_latest)){ 
                    $query = "SELECT
             cat_id, category_name, category_image FROM tbl_category WHERE status = '1' ORDER BY cat_id DESC LIMIT $get_latest";
                }
                else{
                    $query = "SELECT
             cat_id, category_name, category_image FROM tbl_category WHERE status = '1' ORDER BY cat_id";
                }
                $stmt = $mysqli->prepare($query);
                $stmt->execute();
                $stmt->bind_result($cat_id, $category_name,$category_image);
                
                while($stmt->fetch()){
                    $data = array(); 
                    $data['cat_id'] = $cat_id; 
                    $data['category_name'] = $category_name; 
                    $data['category_image'] = $imagepath.'images/'.$category_image; 
                    array_push($response, $data);
                }
                
            break;
            
            
            
        case 'AllChannel':
                  $query = "SELECT id, cid, channel_name, description, channel_icon, channel_banner, c.category_name as category_name, source_type, source_url, views, channel_status, slider_status
                    FROM tbl_channels
                        LEFT JOIN
                            tbl_category c
                                ON cid = c.cat_id WHERE
                        channel_status = '1' ORDER BY id ASC";
                        
                        $stmt = $mysqli->prepare($query);
                $stmt->execute();
                $stmt->bind_result($id, $cid, $channel_name, $description, $channel_icon, $channel_banner, $category_name, $source_type, $source_url, $views, $channel_status, $slider_status);
                
                while($stmt->fetch()){
                    $data = array(); 
                    $data['id'] = $id; 
                    $data['cid'] = $cid; 
                    $data['channel_name'] = $channel_name; 
                    $data['description'] = $description; 
                    $data['channel_icon'] = $imagepath.'images/'.$channel_icon; 
                    $data['channel_banner'] = $imagepath.'images/'.$channel_banner; 
                    $data['category_name'] = $category_name;
                    $data['source_type'] = $source_type;
                    $data['source_url'] = $source_url;
                    $data['views'] = $views;
                    $data['channel_status'] = $channel_status;
                    $data['slider_status'] = $slider_status;
                    array_push($response, $data);
                }
                
     
            break;
            
            
             case 'setting':
                    $query = "SELECT new_connection_link, billing_link FROM tbl_settings";
                         
                    $stmt = $mysqli->prepare($query);
                    $stmt->execute();
                    $stmt->bind_result($new_connection_link, $billing_link);
                
                    while($stmt->fetch()){
                        $data = array(); 
                        $data['new_connection_link'] = $new_connection_link; 
                        $data['billing_link'] = $billing_link; 
                        
                    }
           
                    $response['data'] = $data;
                
                
            break;
            
            
            
             case 'userVerification':
                    $query = "SELECT lineid, status FROM tbl_users WHERE lineid=$lineid";
                         
                    $stmt = $mysqli->prepare($query);
                    $stmt->execute();
                    $stmt->bind_result($lineid, $status);
                
                    while($stmt->fetch()){
                        $data = array(); 
                        $data['lineid'] = $lineid; 
                        $data['status'] = $status; 
                        
                    }
           
                    $response['data'] = $data;
                
                
            break;

            
				default: 
				$response['error'] = true; 
				$response['message'] = 'Invalid Operation Called';
		}
		
	}
	
 }
        else{
            	$response['error'] = true; 
				$response['message'] = 'Invalid Api Key';
        }
 
    function getBaseURL2(){
        $url  = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
        $url .= $_SERVER['SERVER_NAME'];
        $url .= $_SERVER['REQUEST_URI'];
        return dirname($url) . '/';
    }
    
 if(isset($_GET['apicall'])){
    header('Content-Type: application/json; charset=utf-8');
    echo $response= str_replace('\\/', '/', json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }
    
?>
   