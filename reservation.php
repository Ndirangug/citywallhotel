<?php

    /**
     * This script gets details of the user and the reservation,
     * Checks availability of requested room
     * Computes the bill 
     * Takes the customer to jenga payment gateway
     * waits for payment confirmation
     */
    require "conn.php";
    extract($_GET);
    //get number 
    function required_rooms($number_of_adults, $room_type){
       

        //if type is double, rooms required is adults / 2....if room is single then adults = rooms
        if ($room_type == "single") {
            $number_of_rooms_required = $number_of_adults;

        } else {
            $number_of_rooms_required = round($number_of_adults / 2, 0, PHP_ROUND_HALF_UP);
            
        }

        return $number_of_rooms_required;

        
       
    }

    function bill($no_of_rooms, $room_type) {
       if ($room_type == "twin") {
          return 3000 * $no_of_rooms;
       }

       else{
           return 2000 * $no_of_rooms;
       }
    }

    function expected_to_be_empty($room_type, $target_date, $database){
        
        $datee = strtotime($target_date);
        $dateee = date("Y-m-d H:m:s ", $datee);
         $allrooms = $database->select("reservations", [
                "room_ID",
            ], [
                "expected_checkout_date[<]" => $dateee
            ]);
               
           
        if ($room_type == "all") {
            //return ids of all rooms of all types expected to be empty
            if(count($allrooms) > 0){
                return $allrooms;
            }else{
                return [];
            }
            
           

        } else{
            //retrieve rooms of preferred type and expected to be epmty by time of prospective check in
           if(count($allrooms) > 0){
            $roomIds;
            $index = 0;
            foreach ($allrooms as $room) {
               $roomIds[$index] = $room['room_ID'];
               $index++;
            }
            $rooms = $database->select("rooms", [
                "room_ID",
            ], [
                "AND" => [
                    "type" => $room_type,
                    "room_ID" => $roomIds,
                    
	            ]
            ]);
                   
            return $rooms;
           }else{
            return [];
           }
        }

    }

    // $_GET['d] holds reservation details from the customers.php 
    if (isset($_GET['d'])) {
        $reservation_details =  json_decode(base64_decode($_GET['d']), true);

        // single double or twin 
        $room_prefered = trim(strtolower($reservation_details['room_type']), " \t\n\r\0\x0Broom");
        
        
        //check if there is an empty room of specified preference and return its roomID
        $rooms_empty = $database->select("rooms", [
                "room_ID",
                "room_no",
                "type",
                "occupancy"
            ], [
                
                "AND" => [
                    "type" => $room_prefered,
                    "occupancy" => "empty",
                    
	            ]
            ]);
                
            $number_of_empty_rooms = count($rooms_empty);
            $date_time_concat = $reservation_details['expected_checkin_date']." ".$reservation_details['expected_checkin_time'];
            $rooms_expected_to_be_empty = expected_to_be_empty($room_prefered, $date_time_concat, $database);
            $rooms_required = required_rooms($reservation_details['adults'], $room_prefered);

            $all_available_rooms = array_merge($rooms_empty, $rooms_expected_to_be_empty); //$rooms_expected_to_be_empty + $rooms_empty;   
            $no_of_available_rooms = count($all_available_rooms);
            //if available are enough
            if ($no_of_available_rooms >= $rooms_required ) {
                # compute bill
                # show summary and ask to confirm
               $adults = $reservation_details['adults'];
               $bill = bill($rooms_required, $room_prefered);
               $charge_per_room = $bill/$rooms_required;
                
               $roomIds;
               for ($i=0; $i < $rooms_required; $i++) { 
                  $roomIds[$i] = $all_available_rooms[$i]['room_ID'];
               }           
               $roomIds_str = json_encode($roomIds);
               header("location:confirm_bill/confirm.php?email=".$reservation_details['email']."&phone=".$reservation_details['phone']."&customer_ID=$customer_ID&roomIds=$roomIds_str&room_type=$room_prefered&adults=$adults&rooms=$rooms_required&charge_per_room=$charge_per_room&total=$bill&check_in=$date_time_concat&check_out=".$reservation_details['expected_checkout_date']."   ".$reservation_details['expected_checkout_time']);
            }
            else {
                # there is no empty room...check for any room that is expected to be empty by the time 
                # requesting customer is to check in and tell the customer that though his choice is not available, he could go for the available ones
                # show summary of all other available rooms and ask to book again
                $available_rooms_all = expected_to_be_empty("all", $date_time_concat, $database);
                $adults = $reservation_details['adults'];
                 
                
                header("location:confirm_bill/unsuccessful.php?room_type=$room_prefered&adults=$adults&rooms_required=$rooms_required&rooms_available=$no_of_available_rooms");
                
            }
    }
    
    
    
?>