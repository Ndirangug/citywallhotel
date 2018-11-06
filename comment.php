<?php
    extract($_POST);
    require("mail.php");

    sendMail("CityWall", "$name\r\n$email\r\n$phone\r\n$message");
?>