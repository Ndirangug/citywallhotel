<?php
    require("../conn.php");
    extract($_GET);

    $reservations = $database->select("reservations", [
	"customer_ID",
	"date"
    ], [
        "reservation_ID" => $reservationID
    ]);

   

     $database->pdo->beginTransaction();

        
        $database->delete("reservations", [
            "reservation_ID" => $reservationID
        ]);

        $database->delete("payments", [
            "AND" =>[
                "customer_ID" => $reservations[0]['customer_ID'],
                "time" => $reservations[0]['date']
            ]
            
        ]);

 
  
        $database->update("rooms", [
            "occupancy" => "empty" 
        ],
        [
            "room_ID" => $room_ID
        ]

        );
  
        $database->pdo->commit();

        echo json_encode(['result' => "success"]);
?>