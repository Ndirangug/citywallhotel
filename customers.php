<?php
    /**
     * This script is primarily to manage customer data
     * It queries the db for a customer with the specified email
     * if the record exists, it is updated
     * else a new record is inserted
     */
    require "conn.php";

    extract($_POST);

    //query the db for record with specified email
    $data = $database->select("customers", [
	"customer_ID"
    ], [
        "OR" => [
		"email" => $email,
		"phone" => $phone
	    ]
    ]);
    
    //if the result is 0, 
    if (count($data) < 1) {
        # insert a new record
        $database->pdo->beginTransaction();
 
        $database->insert("customers", [
            "first_name" => $first_name,
            "last_name" => $last_name,
            "email" => $email,
            "phone" => $phone
        ]);
        
        /* Commit the changes */
        $database->pdo->commit();
    }else {
        # else update existing record with given details.
         $database->pdo->beginTransaction();
 
        $database->update("customers", [
            "first_name" => $first_name,
            "last_name" => $last_name,
            "email" => $email,
            "phone" => $phone
        ],
        [
            "OR" => [
            "email" => $email,
            "phone" => $phone
            ]
        ]);
        
        /* Commit the changes */
        $database->pdo->commit();
    }

    $customer = $database->select("customers", [
	"customer_ID"
    ], [ 
		"email" => $email,
    ]);
   
    //Encode POST array into a json string encoded base64 and pass it as a get variable to the url /reservation.php
   $reservation_details = base64_encode(json_encode($_POST));
   
   header("location:reservation.php?d=$reservation_details&customer_ID=".$customer[0]['customer_ID']);
   
    
    
  
?>