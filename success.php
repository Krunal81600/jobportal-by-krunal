<?php
include 'dbConfig.php';
include 'config.php';
session_start();

//Get payment information from PayPal
$item_number = $_GET['item_number']; 
$txn_id = $_GET['tx'];
$payment_gross = $_GET['amt'];
$currency_code = $_GET['cc'];
$payment_status = $_GET['st'];

//Get product price from database
$productResult = $db->query("SELECT price FROM products WHERE id = ".$item_number);
$productRow = $productResult->fetch_assoc();
$productPrice = $productRow['price'];

if(!empty($txn_id) && $payment_gross == $productPrice){
	//Check if payment data exists with the same TXN ID.
    $prevPaymentResult = $db->query("SELECT payment_id FROM payments WHERE txn_id = '".$txn_id."'");

    if($prevPaymentResult->num_rows > 0){
        $paymentRow = $prevPaymentResult->fetch_assoc();
        $last_insert_id = $paymentRow['payment_id'];
    }else{
        //Insert tansaction data into the database
        $insert = $db->query("INSERT INTO payments(item_number,txn_id,payment_gross,currency_code,payment_status) VALUES('".$item_number."','".$txn_id."','".$payment_gross."','".$currency_code."','".$payment_status."')");
        $last_insert_id = $db->insert_id;
		
		$usid=$_SESSION['member_id'];
		$jdate=date('Y-m-d H:i:s');
		
		mysqli_query($con,"INSERT INTO `make_resume`(`jdate`, `user_id`) VALUES ('$jdate','$usid')");
		
		mysqli_query($con,"UPDATE `user` SET `make_pay`='1' WHERE id='$usid'");
		
		$notify="Request for make resume";
		$type="user";
		$link="make_resume";
		$jct=date('Y-m-d H:i:s');
		
		$query=mysqli_query($con,"insert into notification(user_id,notify,type,link,noti_time) values('$session_id','$notify','$type','$link','$jct')");
		
		?>
		<script>
			alert("Payment Successfully,The resume will be posted as soon as the payment is processed");
		</script>
		<?php
		
		echo "<script type='text/javascript'>";
		echo "window.location='create_resume'";
		echo "</script>";
    }
?>
	<h1>Your payment has been successful.</h1>
    <h1>Your Payment ID - <?php echo $last_insert_id; ?>.</h1>
<?php }else{ ?>
	<h1>Your payment has failed.</h1>
<?php } ?>