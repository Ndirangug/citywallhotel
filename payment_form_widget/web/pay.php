<?php
	session_start();
	require("../../conn.php");
	extract($_GET);
	$get = json_encode($_GET);
	
	
?>

<!DOCTYPE html>
<html>
<head>
<title>Payment Form </title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href='//fonts.googleapis.com/css?family=Fugaz+One' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Alegreya+Sans:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
	<div class="main">
		<h1>Complete Payment </h1>
		<div class="content">
			
			<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
					<script type="text/javascript">
						$(document).ready(function () {
							$('#horizontalTab').easyResponsiveTabs({
								type: 'default', //Types: default, vertical, accordion           
								width: 'auto', //auto or any width like 600px
								fit: true   // 100% fit in a container
							});
						});
						
					</script>
						<div class="sap_tabs">
							<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
								<div class="pay-tabs">
									<h2>Select Payment Method</h2>
									  <ul class="resp-tabs-list">
										  <li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span><label class="pic1"></label>Credit/Debit Card</span></li>
										  <!-- <li class="resp-tab-item" aria-controls="tab_item-1" role="tab"><span><label class="pic3"></label>Net Banking</span></li>
										  <li class="resp-tab-item" aria-controls="tab_item-2" role="tab"><span><label class="pic4"></label>PayPal</span></li>  -->
										  <li class="resp-tab-item" aria-controls="tab_item-3" role="tab"><span><label class="pic2"></label>Mpesa</span></li>
										  <div class="clear"></div>
									  </ul>	
								</div>
								<div class="resp-tabs-container">
									<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
										<div class="payment-info">
											<h3 class="pay-title">Credit Card Info</h3>
											<p id="card_desc">Enter details of the cardholder. If any aren't correct, change</p>
											<form method="POST" action="pay.php">
												<div class="tab-for">
													<h5>NAME ON CARD</h5>
														<input name="name" type="text" value="">
													<h5>EMAIL</h5>
														<input name="email" type="text" value="<?php echo $email ?>">
													<h5>PHONE NUMBER</h5>
														<input name="mobile_number" type="text" value="<?php echo $phone ?>">
													<h5>ADDRESS LINE 1</h5>
														<input required name="address1" type="text" value="">
													<h5>ADDRESS LINE 2</h5>
														<input name="address2" type="text" value="">
													<h5>COUNTRY</h5>
														<input name="country" type="text" value="Kenya">
													<h5>STATE</h5>
														<input name="state" type="text" value="">
													<h5>ZIP</h5>
														<input name="zip" type="text" value="">
													<h5>CARD NUMBER</h5>													
														<input required name="card_number" class="pay-logo" type="text" value="0000-0000-0000-0000" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '0000-0000-0000-0000';}" >
														<input hidden type="text" name="get" value="<?php echo $get; ?>">
													</div>	
												<div class="transaction">
													<div class="tab-form-left user-form">
														<h5>EXPIRATION</h5>
															<!-- <ul>
																<li>
																	<input name="month" type="number" class="text_box" type="text" value="6" min="1" />	
																</li>
																<li>
																	<input name="year" type="number" class="text_box" type="text" value="1988" min="1" />	
																</li>
																
															</ul> -->
															<input name="expiry" type="date" value="">
													</div>
													<div class="tab-form-right user-form-rt">
														<h5>CVV NUMBER</h5>													
														<input name="security_code" type="text" value="xxxx" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'xxxx';}" required="">
													</div>
													<div class="clear"></div>
												</div>
												<input type="text" value="card" name="mode" hidden>
												<input type="submit" value="SUBMIT">
											</form>
											
										</div>
									</div>
									<div id="mpesa" class="tab-1 resp-tab-content" aria-labelledby="tab_item-1">
										<div class="payment-info">
										<h3 class="pay-title">Mpesa Number</h3>
										<p>Confirm your phone number</p>
										<form method="POST" action="pay.php">
											<div class="tab-for">
												<h5>PHONE NUMBER</h5>
												<input type="tel" value="<?php if (isset($phone)) {
													echo $phone;
												}  ?>">
												<input type="text" value="mpesa" name="mode" hidden>
												<input hidden type="text" name="get" value="<?php echo $get; ?>">
											</div>
										
											<input type="submit" value="SUBMIT">
										</form>
									
										</div>
									</div>
									<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-2">
										<div class="payment-info">
											<h3>PayPal</h3>
											<h4>Already Have A PayPal Account?</h4>
											<div class="login-tab">
												<div class="user-login">
													<h2>Login</h2>
													
													<form>
														<input type="text" value="name@email.com" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'name@email.com';}" required="">
														<input type="password" value="PASSWORD" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'PASSWORD';}" required="">
															<div class="user-grids">
																<div class="user-left">
																	<div class="single-bottom">
																			<ul>
																				<li>
																					<input type="checkbox"  id="brand1" value="">
																					<label for="brand1"><span></span>Remember me?</label>
																				</li>
																			</ul>
																	</div>
																</div>
																<div class="user-right">
																	<input type="submit" value="LOGIN">
																</div>
																<div class="clear"></div>
															</div>
													</form>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-3">	
										<div class="payment-info">
											
											<h3 class="pay-title">Mpesa Number</h3>
											<p>Confirm your phone number</p>
											<form>
												<div class="tab-for">				
													<h5>PHONE NUMBER</h5>
														<input type="tel" value="">
												</div>	
												
												<input type="submit" value="SUBMIT">
											</form>
											<div class="single-bottom">
													<ul>
														<li>
															<input type="checkbox"  id="brand" value="">
															<label for="brand"><span></span>By checking this box, I agree to the Terms & Conditions & Privacy Policy.</label>
														</li>
													</ul>
											</div>
										</div>	
									</div>
								</div>	
							</div>
						</div>	

		</div>
		<p class="footer">Copyright © 2016 Payment Form Widget. All Rights Reserved | Template by <a href="https://w3layouts.com/" target="_blank">w3layouts</a></p>
	</div>
</body>
</html>

<?php
	if (isset($_POST['mode'])) {
		$get = json_decode($_POST['get'], true);
		show($get);
		die();

		
		if ($_POST['mode'] == "mpesa") {
			
			$curl = curl_init("http://developer.lipisha.com/index.php/v2/api/request_money");
    		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/x-www-form-urlencoded'));

			$fields = [
				"api_key" => "d326d9359f151e5aa9b858e6abbbddb1",
				"api_signature" => "nG/4nNTFKjdN/1bNQj0SnpFycYk+RUET1IPsJRkbBjGCUe13z7+uSizR4K15SNLkprhvazbuqRXdbOktL6nZGCKnQy8w2PEbFOOgF+KqiXro1FN5OU11EpctL3ns0cGQFGbrBx60hzv830+WprZK3J7lVNGbaeNH1pQnvUslGe4=", 
				"account_number" => "05830", 
				"mobile_number" => $_POST['mobile_number'], 
				"method" => "Paybill (M-Pesa)",
				"amount" => $amount,
				"currency" => "KES",
				"reference" => $ref

			];

			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($fields));
			$curl_response = curl_exec($curl);
			echo $curl_response;
		}
		else{
			$curl = curl_init("http://developer.lipisha.com/index.php/v2/api/authorize_card_transaction");
    		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/x-www-form-urlencoded'));

			$fields = [
				"api_key" => "d326d9359f151e5aa9b858e6abbbddb1",
				"api_signature" => "nG/4nNTFKjdN/1bNQj0SnpFycYk+RUET1IPsJRkbBjGCUe13z7+uSizR4K15SNLkprhvazbuqRXdbOktL6nZGCKnQy8w2PEbFOOgF+KqiXro1FN5OU11EpctL3ns0cGQFGbrBx60hzv830+WprZK3J7lVNGbaeNH1pQnvUslGe4=", 
				"api_version" => "1.3",
				"api_type" => "Callback",
				"account_number" => "00500", 
				"card_number" => $_POST['card_number'], 
				"address1" => $_POST['address1'], 
				"address2" => $_POST['address2'], 
				"expiry" => $_POST['expiry'], 
				"name" => $_POST['name'], 
				"email" => $_POST['email'], 
				"mobile_number" => $_POST['mobile_number'], 
				"country" => $_POST['country'], 
				"state" => $_POST['state'], 
				"zip" => $_POST['zip'], 
				"security_code" => $_POST['security_code'],  
				"amount" => $amount,
				"currency" => "KES",
				"reference" => $ref

			];

			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($fields));
			$curl_response = curl_exec($curl);
			echo $curl_response;
		}
	}
?>