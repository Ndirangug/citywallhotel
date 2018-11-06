<?php

    require("conn.php");
    extract($_POST);
    extract($_GET);

    //json decode reservtion details to assoc array

    //add record to reservations
    $database->pdo->beginTransaction();
 
   foreach ($roomsIDs as $roomID) {
        $database->insert("reservations", [
        "expected_checkin_date" => date("Y-m-d H:m:s"),
        "expected_checkout_date" => date("Y-m-d H:m:s"),
        "room_ID" => $roomID,
        "customer_ID" => $customerID,
      
    ]);
   }
    
    /* Commit the changes */
   

    //add record to rooms
   foreach ($roomsIDs as $roomID) {
        $database->update("rooms", [
            "occupancy" => "booked"
        ],
        [
            "room_ID" => $roomID
        ]
      
    );
   }

    $database->pdo->commit();

    //email user with room details

    //email hotel with notification




?>
