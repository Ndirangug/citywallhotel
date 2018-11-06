<?php

    require 'vendor/autoload.php';
    use Medoo\Medoo;

   
    $database = new Medoo([
        // required
        'database_type' => 'mysql',
        'database_name' => 'citywall_reservations_mis',
        'server' => 'localhost',
        'username' => 'root',
        'password' => '',
        
    ]);


    //just a small function to show preformatted output..for testing purposes
    function show($foo)
    {
        echo "<pre>";
        print_r($foo);
        echo "</pre>";
    }

?>