<?php
    require("../conn.php");

    extract($_GET);

    $customerID_array = $database->select("reservations", [
	"customer_ID",
	"room_ID",
	
    ], [
        "reservation_ID" => $reservationID
    ]);

   

    $name_array =  $database->select("customers", [
	"first_name",
	"last_name",
	
    ], [
        "customer_ID" => $customerID_array[0]['customer_ID']
    ]);

    echo json_encode(array_merge($name_array[0], ["reservationID" => $reservationID], $customerID_array[0]));
?>