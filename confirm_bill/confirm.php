
<?php
	require('../conn.php');
	extract($_GET);

	$reservation_details = ["customer_ID" => $customer_ID, "total" => $total, "roomIDs" => $roomIds, "checkin" => $check_in, "checkout" => $check_out];
	$reservation_details_str = base64_encode(json_encode($reservation_details));
	
	
	$description = "Payment for reservation of  $rooms $room_type rooms";
	$ref = date("YmdHms").random_int(0, 99);
	
	
	
	
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Confirm Bill</title>
<!-- Meta tags -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //Meta tags -->
<!-- font-awesome-icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome-icons -->
<!-- Stylesheet -->
<link rel="stylesheet" href="../css/bootstrap.css">
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- //Stylesheet -->
<!--fonts--> 
<link href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Love+Ya+Like+A+Sister" rel="stylesheet">
<!--//fonts--> 
</head>
<body>
<!--background-->

    <div class="bg-agile">
	<div class="book-appointment">
	<h2>Confirm Reservation</h2>
	<p>Double and Twin Rooms only take a <span class="text-warning">maximum of two adults</span>. A single room <span class="text-warning">can only hold <strong> one adult</strong>.</span></p>
	<p>Confirm whether the summary is accurate and click 'PROCEED' to move on to payment or 'CANCEL' to go back.</p>
						<div class="book-form agileits-login">
							<div class="row">
								<div class="col-md-6">
									<h4>Room Type: <span> <?php echo $room_type; ?></span></h4>
									<h4>Number of Adults: <span><?php echo $adults; ?></span></h4>
									<h4>Number of Rooms: <span><?php echo $rooms; ?></span></h4>
									<h4>Charge per room: <span>Kshs <?php echo $charge_per_room; ?></span></h4>
									<h4>Total Charge: <span>Kshs <?php echo $total; ?></span></h4>
								</div>
								<div class="col-md-6">
									<h4>Check in date: <span> <?php echo $check_in; ?>h</span></h4>
									<h4>Check out date: <span> <?php echo $check_out; ?>h</span></h4>
									
								</div>
							</div>
							<a class="btn btn-danger" href="../index.html">CANCEL</a>
							<a id="submit-cg" target="_blank" class="btn btn-success navbar-right checkout" href="pay.php?description=<?php echo $description; ?>&amount=<?php echo $total; ?>&ref=<?php echo $ref; ?>&phone=<?php echo $phone; ?>&email=<?php echo $email; ?>&reservation_details_str=<?php echo $reservation_details_str; ?>">MAKE RESERVATION</a>
							
						</div>
		<p>For enquiries or issues get to us at <a href="tel:+254720753744"> +254720753744</a> or <a href="+254732457741">+254732457741</a> or <a href="mailto:info@citywallhotel.co.ke"> info@citywallhotel.co.ke</a></p>
		</div>
   </div>
  <!--copyright-->
	<div class="copy w3ls">
		<p>&copy; 2018 CityWall Hotel .   | Design by <a href="http://ndirangug.github.com/" target="_blank">George Ndirangu</a> </p>
	</div>
<!--//copyright-->
		<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
		<!-- Calendar -->
				<link rel="stylesheet" href="css/jquery-ui.css" />
				<script src="js/jquery-ui.js"></script>
				  <script>
						  $(function() {
							$( "#datepicker,#datepicker1,#datepicker2,#datepicker3" ).datepicker();
						  });
				  </script>
			<!-- //Calendar -->

</body>
</html>

<?php
	
	
	

