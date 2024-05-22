<?php
// Database variables
$host = "localhost"; //database location
$user = "root"; //database username
$pass = ""; //database password
$db_name = "paypal"; //database name

$con=mysqli_connect("localhost","Africaglobalnetw","Africaglobalnetwork","Africaglobalnetwork");
session_start();

$cra=mysqli_query($con,"SELECT * FROM `account` WHERE id='1'");
$resumecra=mysqli_fetch_array($cra);

$paypalURL = $resumecra['paypal_url']; //Test PayPal API URL
$paypalID = $resumecra['paypal_id']; //Business Email

// PayPal settings
$paypal_email = $paypalID;
$return_url = 'http://africaglobalnetwork.com/payment-successful.html';
$cancel_url = 'http://africaglobalnetwork.com/payment-cancelled.html';
$notify_url = 'http://africaglobalnetwork.com/demo2/payments.php';

$item_name = $_POST['item_name'];
$item_amount = $_POST['amount'];

$sdate=$_POST['sdate'];
$edate=$_POST['edate'];
$banner_size=$_POST['banner_size'];
$payoption=$_POST['amount'];
$pay_by=$_POST['pay_by'];
$comp_website=$_POST['comp_website'];
$ad_title=$_POST['ad_title'];
$ad_desc=$_POST['ad_desc'];
$ps_date=date("Y-m-d h:i:sa");
$session_id=$_SESSION['member_id'];

$img = $_FILES['ad_img']['name'];
$tmp = $_FILES['ad_img']['tmp_name'];
$size = $_FILES['ad_img']['size'];
$type = $_FILES['ad_img']['type'];

$rnd = mt_rand(1,99999);
$fnm = "img". $rnd . $img;
$ad_img = str_replace(' ','_',$fnm);
move_uploaded_file($tmp,'upload/'.$ad_img);

mysqli_query($con,"INSERT INTO `comp_ad`(`sdate`,`edate`,`banner_size`,`payoption`,`pay_by`,`comp_website`,`ad_title`,`ad_desc`,`ad_img`,`ps_date`,`ad_by`) VALUES ('$sdate','$edate','$banner_size','$payoption','$pay_by','$comp_website','$ad_title','$ad_desc','$ad_img','$ps_date','$session_id')");

$notify="Request for create ad";
$type="user";
$link="ad";
$jct=date('Y-m-d H:i:s');

$query=mysqli_query($con,"insert into notification(user_id,notify,type,link,noti_time) values('$session_id','$notify','$type','$link','$jct')");

// Include Functions
include("functions.php");
if($pay_by=="Pay by Card")
{
// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])){
	$querystring = '';
	
	// Firstly Append paypal account to querystring
	$querystring .= "?business=".urlencode($paypal_email)."&";
	
	// Append amount& currency (£) to quersytring so it cannot be edited in html
	
	//The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
	$querystring .= "item_name=".urlencode($item_name)."&";
	$querystring .= "amount=".urlencode($item_amount)."&";
	
	//loop for posted values and append to querystring
	foreach($_POST as $key => $value){
		$value = urlencode(stripslashes($value));
		$querystring .= "$key=$value&";
	}
	
	// Append paypal return addresses
	$querystring .= "return=".urlencode(stripslashes($return_url))."&";
	$querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
	$querystring .= "notify_url=".urlencode($notify_url);
	
	// Append querystring with custom field
	//$querystring .= "&custom=".USERID;
	
	// Redirect to paypal IPN
	header('location:'.$paypalURL.''.$querystring);
	exit();
} else {
	//Database Connection
	$link = mysql_connect($host, $user, $pass);
	mysql_select_db($db_name);
	
	// Response from Paypal

	// read the post from PayPal system and add 'cmd'
	$req = 'cmd=_notify-validate';
	foreach ($_POST as $key => $value) {
		$value = urlencode(stripslashes($value));
		$value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i','${1}%0D%0A${3}',$value);// IPN fix
		$req .= "&$key=$value";
	}
	
	// assign posted variables to local variables
	$data['item_name']			= $_POST['item_name'];
	$data['item_number'] 		= $_POST['item_number'];
	$data['payment_status'] 	= $_POST['payment_status'];
	$data['payment_amount'] 	= $_POST['mc_gross'];
	$data['payment_currency']	= $_POST['mc_currency'];
	$data['txn_id']				= $_POST['txn_id'];
	$data['receiver_email'] 	= $_POST['receiver_email'];
	$data['payer_email'] 		= $_POST['payer_email'];
	$data['custom'] 			= $_POST['custom'];
		
	// post back to PayPal system to validate
	$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
	
	$fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);
	
	if (!$fp) {
		// HTTP ERROR
		
	} else {
		fputs($fp, $header . $req);
		while (!feof($fp)) {
			$res = fgets ($fp, 1024);
			if (strcmp($res, "VERIFIED") == 0) {
				
				// Used for debugging
				// mail('user@domain.com', 'PAYPAL POST - VERIFIED RESPONSE', print_r($post, true));
						
				// Validate payment (Check unique txnid & correct price)
				$valid_txnid = check_txnid($data['txn_id']);
				$valid_price = check_price($data['payment_amount'], $data['item_number']);
				// PAYMENT VALIDATED & VERIFIED!
				if ($valid_txnid && $valid_price) {
					
					$orderid = updatePayments($data);
					
					if ($orderid) {
						// Payment has been made & successfully inserted into the Database
					} else {
						// Error inserting into DB
						// E-mail admin or alert user
						// mail('user@domain.com', 'PAYPAL POST - INSERT INTO DB WENT WRONG', print_r($data, true));
					}
				} else {
					// Payment made but data has been changed
					// E-mail admin or alert user
				}
			
			} else if (strcmp ($res, "INVALID") == 0) {
			
				// PAYMENT INVALID & INVESTIGATE MANUALY!
				// E-mail admin or alert user
				
				// Used for debugging
				//@mail("user@domain.com", "PAYPAL DEBUGGING", "Invalid Response<br />data = <pre>".print_r($post, true)."</pre>");
			}
		}
	fclose ($fp);
	}
}
}
else
{
	?>
	<script>
		alert("Successfully Created");
	</script>
   <?php
	
	echo "<script type='text/javascript'>";
	echo "window.location='create_ad'";
	echo "</script>";
}
?>
