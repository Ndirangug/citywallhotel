<?php
    require("../conn.php");

    extract($_GET);

     $database->pdo->beginTransaction();
 
  
        $database->insert("checkin", [
            "customer_ID" => $customer_ID,
            "room_ID" => $room_ID,
        ]);

         
 
  
        $database->update("rooms", [
            "occupancy" => "occupied" 
        ],
        [
            "room_ID" => $room_ID
        ]

        );
  
        $database->pdo->commit();

      echo json_encode(['result' => "success"]);
?>