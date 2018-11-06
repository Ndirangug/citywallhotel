<?php
    require("../conn.php");
    extract($_GET);
    

    //ipay
    $fields = [
        "live" => 0,
        "mpesa" => 1,
        "airtel" => 1,
        "equity" => 1,
        "mobilebanking" => 1,
        "debitcard" => 1,
        "creditcard" => 1,
        "autopay" => 1,
        "oid" => $ref,
        "inv" => $ref,
        "ttl" => $amount,
        "tel" => $phone,
        "eml" => $email,
        "vid" => "demo",
        "curr" => "KES",
        "p1" => $reservation_details_str,
        "p2" => "",
        "p3" => "",
        "p4" => "",
        "cbk" => "https://artscircle.co.ke",
        "lbk" => "https://artscircle.co.ke",
        "cst" => 1,
        "crl" => 0,   
    ];
    
    $hashkey = "demo";
    $datastring = "";

    foreach ($fields as $key => $value) {
      $datastring.=$value;
    }
    $hashid = hash_hmac("sha1", $datastring, $hashkey);
    $hsh = ["hsh" => $hashid];
    $post_fileds = array_merge($fields, $hsh);
    show($post_fileds);

    $curl = curl_init("https://payments.ipayafrica.com/v3/ke");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post_fileds));
    $curl_response = curl_exec($curl);
    echo curl_error($curl);
    echo $curl_response;
    curl_close($curl);

    // //jengapgw
    // $expiry = "2025-02-17T19:00:00";
	// $customer_name = "George";
	// $account = "0000000";
    // $merchant_code = "058291086";

    // $curl = curl_init("https://sandbox.jengahq.io/identity-test/v2/token");
    // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/x-www-form-urlencoded', 'Authorization:Basic QWEzY0dxRVpWOVo5dDFVSnhTR3BwZUF4WEZrcFFyYUk6cU5BYWs5YXcyVDNtSW1uMg=='));
    // curl_setopt($curl, CURLOPT_POST, true);
    // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($curl, CURLOPT_POSTFIELDS, "username=058291086&password=vLcQDQwDYF1hOU9Xiq3O16DGtJgBlIcT");
    // $response = json_decode(curl_exec($curl), true);
    
    
   

    // $fields = [
    //     "token" => $response['access_token'],
    //     "description" => "fdf",
    //     "merchant" => "fdf",
    //     "custName" => $customer_name,
    //     "currency" => "KES",
    //     "amount" => $amount,
    //     "orderReference" => $ref,
    //     "orderID" => $ref,
    //     "merchantCode" => $merchant_code,
    //     "outletCode" => "000000000000",
    //     "popupLogo" => "https://www.jambopay.com/jambohelp/jambo/rsc/checkout.png",
    //     "ez1_callbackurl" => "https://artscircle.co.ke",
    //     "expiry" => $expiry,
    //     "website" => "artscircle.co.ke",
    //     "extraData" => "fsdgsg"

    // ];

    // curl_setopt($curl, CURLOPT_URL, "https://api-test.equitybankgroup.com/v2/checkout/launch");
    // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($curl, CURLOPT_POST, true);
    // curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($fields));
    // $curl_response = curl_exec($curl);
    // echo $curl_response;

    // //lipisha
    // //mpesa
    // $curl = curl_init("http://developer.lipisha.com/index.php/v2/api/request_money");
    // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/x-www-form-urlencoded'));

    // $fields = [
    //     "api_key" => "d326d9359f151e5aa9b858e6abbbddb1",
    //     "api_signature" => "nG/4nNTFKjdN/1bNQj0SnpFycYk+RUET1IPsJRkbBjGCUe13z7+uSizR4K15SNLkprhvazbuqRXdbOktL6nZGCKnQy8w2PEbFOOgF+KqiXro1FN5OU11EpctL3ns0cGQFGbrBx60hzv830+WprZK3J7lVNGbaeNH1pQnvUslGe4=", 
    //     "account_number" => "00100", 
    //     "mobile_number" => $phone, 
    //     "method" => "Paybill (M-Pesa)",
    //     "amount" => $amount,
    //     "currency" => "KES",
    //     "reference" => $ref

    // ];

    // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($curl, CURLOPT_POST, true);
    // curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($fields));
    // $curl_response = curl_exec($curl);
    // echo $curl_response;

    

?>










