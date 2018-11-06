
<?php
	extract($_GET);
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Reservation Unsuccessful</title>
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
	<h1><i class="fa fa-warning text-danger"></i></h1>
	<h2>Oh Darn! Looks like we're fully booked</h2>
	<p style="color:red;font-weight:600; font-size:1.2em;">We're afraid all our <?php echo $room_type; ?> rooms are either occupied or booked. </p>
						<div class="book-form agileits-login">
							
							<p>We highly regret the inconvinience. However, you could book a differnet type of room. Click 'OK' to go back to the reservation page. Or get to us at <a href="tel:+254720753744"> +254720753744</a> or <a href="+254732457741">+254732457741</a> or <a href="mailto:info@citywallhotel.co.ke"> info@citywallhotel.co.ke</a> .</p>
	
							<a class="btn btn-success navbar-right" href="../index.html">OK</a>
						</div>
	
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